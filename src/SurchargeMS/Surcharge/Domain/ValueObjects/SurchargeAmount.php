<?php

declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\ValueObjects;

final class SurchargeAmount
{


    public function __construct(private readonly ?float $amount)
    {

    }

    public function value(): ?float
    {
        return $this->amount;
    }
}
