<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Infrastructure\Repositories;

use App\Models\Surcharge as EloquentSurchargeModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\NoReturn;
use Src\SurchargeMS\Surcharge\Domain\Contracts\SurchargeRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\Entities\CalculationType;
use Src\SurchargeMS\Surcharge\Domain\Entities\Carrier;
use Src\SurchargeMS\Surcharge\Domain\Entities\Rate;
use Src\SurchargeMS\Surcharge\Domain\Entities\StandardSurchargeName;
use Src\SurchargeMS\Surcharge\Domain\Entities\Surcharge;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CalculationTypeName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CarrierId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CurrencyName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\StandardSurchargeNameId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeAmount;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeApplyTo;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class EloquentSurchargeRepository implements SurchargeRepositoryContract
{
    private EloquentSurchargeModel $surcharge;

    public function __construct()
    {
        $this->surcharge = new EloquentSurchargeModel;
    }

    /**
     * @return mixed
     */
    public function standardize(): mixed
    {
        return $this->surcharge->get();
    }

    public function update(SurchargeId|int $surchargeId, StandardSurchargeName|Model $standardSurchargeName): void
    {
              $surchargeToUpdate = $this->surcharge;

        $data = [
            'standard_surcharge_name_id'  => $standardSurchargeName->id,

        ];

        $surchargeToUpdate
            ->findOrFail($surchargeId)
            ->update($data);
    }

    public function findByCriteria(SurchargeName $name, SurchargeApplyTo $applyTo): ?Surcharge
    {
        $findSurcharge = $this->surcharge
             ->when()
            ->where(DB::raw('LOWER(name)'), '=', strtolower($name->value()))
            ->where('apply_to', $applyTo->value())
            ->first();


        if($findSurcharge){
            // Return Domain Surcharge model
            return Surcharge::withIdNameAndStandardNameId(
                new SurchargeId($findSurcharge->id),
                new SurchargeName($findSurcharge->name),
                new StandardSurchargeNameId($findSurcharge->standard_surcharge_name_id)
            );
        }
         return null;

    }

    public function findByStandardNameId(StandardSurchargeNameId $id, SurchargeApplyTo $applyTo): ?Surcharge
    {
        $findSurcharge = $this->surcharge
            ->when()
            ->where('standard_surcharge_name_id', $id->value())
            ->where('apply_to', $applyTo->value())
            ->first();


        if($findSurcharge){
            // Return Domain Surcharge model
            return  Surcharge::withIdNameAndStandardNameId(
                new SurchargeId($findSurcharge->id),
                new SurchargeName($findSurcharge->name),
                new StandardSurchargeNameId($findSurcharge->standard_surcharge_name_id)
            );
        }
        return null;
    }

    #[NoReturn]
    public function saveRate(CarrierId $id, CurrencyName $currency, SurchargeAmount $amount, SurchargeId $surchargeId): void
    {

        $findSurcharge = $this->surcharge->find($surchargeId->value());

        $findSurcharge->rate()->create(
           [ 'carrier_id' => $id->value(),
             'amount' => $amount->value(),
             'currency' => $currency->value()
               ]
        );
    }

    public function countStandardized(): int
    {
        return DB::table('surcharges')->whereNotNull('standard_surcharge_name_id')->count();
    }

    public function get(int $page = 1, int $perPage = null)
    {
        $surchargeQuery = $this->surcharge->newQuery();


        $surchargeQuery->with(['standardSurchargeName', 'calculationType', 'rate'] )
            ->orderBy('id', 'asc'); // Ordenar por nombre ascendente

        $getSurcharge = $surchargeQuery->paginate($perPage, ['*'], 'page', $page);


        $surchargeCollection = collect();


        foreach ($getSurcharge->items() as $item) {
            $rate = $item->rate->isNotEmpty() ? $item->rate->map(function ($rateItem) {
                return new Rate(
                    new SurchargeAmount($rateItem->amount),
                    new CurrencyName($rateItem->currency),
                    new Carrier(
                        new CarrierId($rateItem->carrier->id),
                        new SurchargeName($rateItem->carrier->name)
                    )
                );
            }) : null;

            $surchargeCollection->push(
                Surcharge::withRelations(
                    new SurchargeId($item->id),
                    new SurchargeName($item->name),
                    new StandardSurchargeName(
                        new SurchargeName(optional($item->standardSurchargeName)->name),
                    ),
                    new CalculationType(
                        new CalculationTypeName(optional($item->calculationType)->name),
                    ),
                    $rate,
                    new SurchargeApplyTo($item->apply_to)
                )
            );
        }

        return $getSurcharge->setCollection($surchargeCollection);
    }

}
