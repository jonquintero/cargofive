<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\SurchargeMS\Surcharge\Application\CreateStandardSurchargeCase;
use Src\SurchargeMS\Surcharge\Application\Services\StandardizeSurchargeNameService;
use Src\SurchargeMS\Surcharge\Domain\Contracts\StandardSurchargeNameRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\Contracts\SurchargeRepositoryContract;
use Src\SurchargeMS\Surcharge\Infrastructure\Repositories\EloquentStandardSurchargeNameRepository;

class StandardizeSurchargeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'standardize:surcharge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Standardize surcharge';

    /**
     * Execute the console command.
     */
    public function handle(SurchargeRepositoryContract  $surchargeRepositoryContract, EloquentStandardSurchargeNameRepository $eloquentStandardSurchargeNameRepository)
    {
        $this->info('Standardization has begun');

        $surcharges = $surchargeRepositoryContract->standardize();


        foreach ($surcharges as $surcharge) {

            /* Create a static function is called because the class only has one method
            * with a match of the possible names that exist in the db and the excel
            */
            $name = StandardizeSurchargeNameService::standardize($surcharge->name);

            $firstOrCreateSurcharge = new CreateStandardSurchargeCase($eloquentStandardSurchargeNameRepository);

            $getRecord = $firstOrCreateSurcharge->__invoke($name);

            $surchargeRepositoryContract->update($surcharge->id,$getRecord);

        }

        $this->info('Surcharge names have been standardized.');

    }
}
