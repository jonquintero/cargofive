<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Src\SurchargeMS\Surcharge\Domain\Entities\StandardSurchargeName;
use Src\SurchargeMS\Surcharge\Domain\Entities\Surcharge;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeApplyTo;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

interface CarrierRepositoryContract
{
    public function findByCriteria(SurchargeName $name);
}
