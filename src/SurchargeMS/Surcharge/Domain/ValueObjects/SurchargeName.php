<?php

declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\ValueObjects;

final class SurchargeName
{


    public function __construct(private readonly string $name)
    {

    }

    public function value(): string
    {
        return $this->name;
    }
}
