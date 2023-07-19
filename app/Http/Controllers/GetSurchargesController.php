<?php

namespace App\Http\Controllers;

use App\Http\Resources\SurchargeResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetSurchargesController extends Controller
{
    public function __construct(private readonly \Src\SurchargeMS\Surcharge\Infrastructure\Controllers\GetSurchargesController $getSurchargesController)
    {
    }

    public function __invoke()
    {
        return SurchargeResource::collection($this->getSurchargesController->__invoke());

    }
}
