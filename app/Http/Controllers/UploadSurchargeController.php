<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadSurchargeRequest;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UploadSurchargeController extends Controller
{
    public function __construct(private readonly \Src\SurchargeMS\Surcharge\Infrastructure\Controllers\UploadSurchargeController $uploadSurchargeController)
    {

    }

    public function __invoke(UploadSurchargeRequest $request)
    {
        try {

             $this->uploadSurchargeController->__invoke($request);

            // Returns the response from the infrastructure layer controller.
            return response()->json('Data processed successful',Response::HTTP_OK);
        } catch (\Exception $e) {

            // Returns a JSON response with the corresponding error message...
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getCode());
        }

    }
}
