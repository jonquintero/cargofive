<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Src\SurchargeMS\Surcharge\Domain\Entities\StandardSurchargeName;
use Src\SurchargeMS\Surcharge\Domain\Entities\Surcharge;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CarrierId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CurrencyName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\StandardSurchargeNameId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeAmount;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeApplyTo;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

interface SurchargeRepositoryContract
{
    public function standardize(): mixed;

    public function update(SurchargeId|int $surchargeId, StandardSurchargeName|Model $standardSurchargeName): void;

    public function findByCriteria(SurchargeName $name, SurchargeApplyTo $applyTo);

    public function findByStandardNameId(StandardSurchargeNameId $id, SurchargeApplyTo $applyTo);

    public function saveRate(CarrierId $id, CurrencyName $currency, SurchargeAmount $amount, SurchargeId $surchargeId):void;

    public function countStandardized(): int;

    public function get(int $page = 1, int $perPage = null);
}
