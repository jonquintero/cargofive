<?php

namespace Src\SurchargeMS\Surcharge\Infrastructure\Persistence;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Src\SurchargeMS\Surcharge\Domain\Entities\Surcharge;

class SurchargePaginator
{
    protected $surcharge;

    public function __construct(Surcharge $surcharge)
    {
        $this->surcharge = $surcharge;
    }

    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $surchargeQuery = $this->surcharge->newQuery();

        return $surchargeQuery->paginate($perPage);
    }
}
