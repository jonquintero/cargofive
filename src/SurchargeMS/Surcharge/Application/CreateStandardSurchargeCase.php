<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Application;

use Src\SurchargeMS\Surcharge\Domain\Contracts\StandardSurchargeNameRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\Entities\StandardSurchargeName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class CreateStandardSurchargeCase
{
    public function __construct(private readonly StandardSurchargeNameRepositoryContract $repository)
    {
    }

    public function __invoke(string $name): mixed
    {
        $name   = new SurchargeName($name);

        $new = StandardSurchargeName::create($name);

        return $this->repository->firstOrCreate($new);
    }
}
