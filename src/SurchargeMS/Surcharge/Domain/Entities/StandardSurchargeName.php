<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\Entities;

use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class StandardSurchargeName
{
    public function __construct(
        private readonly SurchargeName  $name,

    )
    {

    }

    public function name(): SurchargeName
    {
        return $this->name;
    }

    public static function create(
        SurchargeName $name,

    ): StandardSurchargeName
    {
        return new self($name);

    }


}
