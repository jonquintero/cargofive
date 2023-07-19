<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\Entities;

use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CarrierId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CurrencyName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeAmount;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class Rate
{
    public function __construct(
        public readonly ?SurchargeAmount $amount,
        public readonly ?CurrencyName $currency,
        public readonly ?Carrier $carrier

    )
    {

    }


    public function amount(): ?SurchargeAmount
    {
        return $this->amount;
    }

    public function currency(): ?CurrencyName
    {
        return $this->currency;
    }

    public function carrier(): ?Carrier
    {
        return $this->carrier;
    }


}
