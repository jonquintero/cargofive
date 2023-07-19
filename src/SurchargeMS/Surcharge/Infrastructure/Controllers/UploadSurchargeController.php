<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\RequiredIf;
use InvalidArgumentException;
use Src\SurchargeMS\Surcharge\Application\Services\ExcelUploaderService;
use Src\SurchargeMS\Surcharge\Application\UploadStandardSurchargeCase;
use Src\SurchargeMS\Surcharge\Domain\Contracts\SurchargeRepositoryContract;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\ExcelFile;

final class UploadSurchargeController
{
    private ExcelUploaderService $excelUploaderService;

    public function __construct(ExcelUploaderService $excelUploaderService)
    {
        $this->excelUploaderService = $excelUploaderService;
    }

    public function __invoke(Request $request)
    {

        $file = new ExcelFile($request->file('file'));

        try {

            $result = $this->excelUploaderService->process($file);

            $uploadProcess = new UploadStandardSurchargeCase($result);
            $uploadProcess->processArrayData();

            // Return the result...
        } catch (InvalidArgumentException $e) {

            return response()->json([
                'errors' => $e->getMessage(),
            ], 422);
        }

    }
}
