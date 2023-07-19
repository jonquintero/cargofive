<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\ValueObjects;

use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

final class ExcelFile
{
    private $file;
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function validate(): bool
    {
        $valid_extensions = ['xlsx', 'xls'];
        $extension = $this->file->getClientOriginalExtension();
        return $this->file->isValid() && in_array($extension, $valid_extensions);
    }

    public function process(): array
    {
        // Use maatwebsite/excel to process the file

        return Excel::toArray([], $this->file->getPathname())[0];


    }
}
