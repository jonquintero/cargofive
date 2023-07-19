<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Infrastructure\Repositories;

use App\Models\StandardSurchargeName as EloquentStandardSurchargeName;
use Illuminate\Support\Facades\DB;
use Src\SurchargeMS\Surcharge\Domain\Contracts\StandardSurchargeNameRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\Contracts\SurchargeRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\Entities\StandardSurchargeName;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\SurchargeName;

final class EloquentStandardSurchargeNameRepository implements StandardSurchargeNameRepositoryContract
{
    private EloquentStandardSurchargeName $standardSurchargeName;

    public function __construct()
    {
        $this->standardSurchargeName = new EloquentStandardSurchargeName;
    }

    public function firstOrCreate(StandardSurchargeName $standardSurchargeName): mixed
    {
        $newStandardSurchargeName = $this->standardSurchargeName;

        $data = ['name'    => $standardSurchargeName->name()->value()];

        return $newStandardSurchargeName->firstOrCreate($data);
    }

    public function findByName($name)
    {
        $newStandardSurchargeName = $this->standardSurchargeName;

        return $newStandardSurchargeName
            ->where(DB::raw('LOWER(name)'), '=', strtolower($name))
            ->first();
    }

}
