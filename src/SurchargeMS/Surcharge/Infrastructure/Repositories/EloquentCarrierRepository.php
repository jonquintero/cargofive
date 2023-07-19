<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Infrastructure\Repositories;

use App\Models\Carrier as EloquentCarrierModel;
use Illuminate\Support\Facades\DB;
use Src\SurchargeMS\Surcharge\Domain\Contracts\CarrierRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\Entities\Carrier;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CarrierId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class EloquentCarrierRepository implements CarrierRepositoryContract
{
    private EloquentCarrierModel $carrier;

    public function __construct()
    {
        $this->carrier = new EloquentCarrierModel;
    }

    public function findByCriteria(SurchargeName $name): Carrier
    {
        $findCarrier = $this->carrier
            ->where(DB::raw('LOWER(name)'), '=', strtolower($name->value()))
            ->firstOrCreate(['name' => strtoupper($name->value())]);


        // Return Domain Carrier model
        return new Carrier(
            new CarrierId($findCarrier->id),
            new SurchargeName($findCarrier->name),

        );
    }


}
