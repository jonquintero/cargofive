<?php

declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\ValueObjects;

final class SurchargeApplyTo
{


    public function __construct(private readonly string $applyTo)
    {

    }

    public function value(): string
    {
        return $this->applyTo;
    }
}
