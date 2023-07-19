<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\Contracts;

use Illuminate\Support\Collection;
use Src\SurchargeMS\Surcharge\Domain\Entities\StandardSurchargeName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

interface StandardSurchargeNameRepositoryContract
{

    public function firstOrCreate(StandardSurchargeName $standardSurchargeName): mixed;

    public function findByName($name);
}
