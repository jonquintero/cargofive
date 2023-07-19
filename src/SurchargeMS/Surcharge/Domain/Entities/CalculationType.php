<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\Entities;

use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CalculationTypeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CalculationTypeName;


final class CalculationType
{
    public function __construct(

        public readonly ?CalculationTypeName            $name,

    )
    {

    }


    public function name(): CalculationTypeName
    {
        return $this->name;
    }


}
