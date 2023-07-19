<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\Entities;

use Illuminate\Support\Collection;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\StandardSurchargeNameId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeApplyTo;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class Surcharge
{

    public function __construct(
        public readonly SurchargeId              $id,
        public readonly ?SurchargeName           $name,
        public readonly ?StandardSurchargeNameId $standardSurchargeNameId,
        public readonly ?StandardSurchargeName   $standardSurchargeName,
        public readonly ?CalculationType         $calculationType,
        public readonly Rate|Collection|null     $rate,
        public readonly ?SurchargeApplyTo        $applyTo,

    )
    {

    }

    public function id(): SurchargeId
    {
        return $this->id;
    }

    public function name(): SurchargeName
    {
        return $this->name;
    }

    /**
     * @return StandardSurchargeNameId|null
     */
    public function getStandardSurchargeNameId(): ?StandardSurchargeNameId
    {
        return $this->standardSurchargeNameId;
    }

    public function getStandardSurchargeName(): ?StandardSurchargeName
    {
        return $this->standardSurchargeName;
    }

    public function applyTo(): ?SurchargeApplyTo
    {
        return $this->applyTo;
    }

    public static function withIdNameAndStandardNameId(SurchargeId $id, SurchargeName $name, StandardSurchargeNameId $standardSurchargeNameId ): Surcharge
    {
        return new self($id, $name, $standardSurchargeNameId, null,null, null, null);
    }

    public static function withRelations(SurchargeId $id, SurchargeName $name, StandardSurchargeName $standardSurchargeName, CalculationType $calculationType, Rate|Collection|null $rate, SurchargeApplyTo $applyTo): Surcharge
    {
        return new self($id, $name, null, $standardSurchargeName, $calculationType, $rate, $applyTo);
    }
}
