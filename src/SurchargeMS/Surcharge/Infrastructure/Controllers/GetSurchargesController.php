<?php

namespace Src\SurchargeMS\Surcharge\Infrastructure\Controllers;

use Src\SurchargeMS\Surcharge\Application\GetStandardSurchargesCase;
use Src\SurchargeMS\Surcharge\Infrastructure\Repositories\EloquentSurchargeRepository;

final class GetSurchargesController
{
    public function __construct(private readonly EloquentSurchargeRepository $repository)
    {

    }

    public function __invoke()
    {
       $getSurcharges = new GetStandardSurchargesCase($this->repository);

         return $getSurcharges->__invoke();

    }
}
