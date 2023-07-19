<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Application;

use Src\SurchargeMS\Surcharge\Domain\Contracts\StandardSurchargeNameRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\Contracts\SurchargeRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\Entities\StandardSurchargeName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class GetStandardSurchargesCase
{
    public function __construct(private readonly SurchargeRepositoryContract $repository)
    {
    }

    public function __invoke()
    {
       return $this->repository->get();
    }
}
