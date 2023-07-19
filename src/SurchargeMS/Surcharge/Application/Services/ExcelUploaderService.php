<?php

namespace Src\SurchargeMS\Surcharge\Application\Services;

use InvalidArgumentException;
use Src\SurchargeMS\Surcharge\Domain\ValueObjects\ExcelFile;

final class ExcelUploaderService
{
    public function process(ExcelFile $file): array
    {
        if (!$file->validate()) {
            throw new InvalidArgumentException('The uploaded file is not a valid Excel file.');
        }

        return $file->process();
    }
}
