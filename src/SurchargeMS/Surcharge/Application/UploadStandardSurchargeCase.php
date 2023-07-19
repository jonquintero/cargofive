<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Application;

use Src\SurchargeMS\Surcharge\Application\Services\StandardizeSurchargeNameService;

use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CarrierId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CurrencyName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\StandardSurchargeNameId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeAmount;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeApplyTo;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;
use Src\SurchargeMS\Surcharge\Infrastructure\Repositories\EloquentCarrierRepository;
use Src\SurchargeMS\Surcharge\Infrastructure\Repositories\EloquentStandardSurchargeNameRepository;
use Src\SurchargeMS\Surcharge\Infrastructure\Repositories\EloquentSurchargeRepository;

final class UploadStandardSurchargeCase
{
    public function __construct(private array $array)
    {
    }

    public function processArrayData()
    {

        unset($this->array[0]);

        foreach ($this->array as $data){

            $name  = new SurchargeName($data[0]);
            $applyTo = new SurchargeApplyTo($data[4]);

            $searchSurcharge = new EloquentSurchargeRepository();


            $surcharge = $searchSurcharge->findByCriteria($name,$applyTo);

            if(empty($surcharge)){
                $name = StandardizeSurchargeNameService::standardize($name->value());
                $findStandardName = new EloquentStandardSurchargeNameRepository();

                $getStandardName = $findStandardName->findByName($name);

                $surcharge = $searchSurcharge->findByStandardNameId(new StandardSurchargeNameId($getStandardName->id), $applyTo);

            }

            if(!empty($surcharge)){
                $searchCarrier = new EloquentCarrierRepository();

                $carrier = $searchCarrier->findByCriteria( new SurchargeName($data[1]));


                $searchSurcharge->saveRate(new CarrierId($carrier->id()->value()), new CurrencyName($data[3]), new SurchargeAmount($data[2]), new SurchargeId($surcharge->id()->value()));


            }

        }

    }
}
