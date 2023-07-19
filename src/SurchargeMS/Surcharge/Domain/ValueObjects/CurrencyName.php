<?php

declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\ValueObjects;

final class CurrencyName
{


    public function __construct(private readonly ?string $currency)
    {

    }

    public function value(): ?string
    {
        return $this->currency;
    }
}
