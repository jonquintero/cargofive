<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\Entities;

use Src\SurchargeMS\Surcharge\Domain\ValueObjects\CarrierId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeId;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class Carrier
{
    public function __construct(
        public readonly CarrierId               $id,
        public readonly ?SurchargeName            $name,

    )
    {

    }

    public function id(): CarrierId
    {
        return $this->id;
    }

    public function name(): SurchargeName
    {
        return $this->name;
    }


}
