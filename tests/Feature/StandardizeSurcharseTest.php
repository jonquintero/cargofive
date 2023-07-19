<?php

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

it('validates that the file field is not empty', function () {

    // Create a POST request with the file field empty
    $response = $this->post('api/upload', [
        'file' => null,
    ]);

    // Verify that the validation fails and that the file field is not present in the request
    $response->assertStatus(422);


})->uses(TestCase::class);


it('can upload and validate a file', function () {

    // Load the test file
    $filePath = storage_path('app/ChallengeRates.xlsx');
    $this->assertTrue(file_exists($filePath));
    $file = new UploadedFile($filePath, 'ChallengeRates.xlsx', null, null, true);

    // Make a POST request to the upload path
    $response = $this->post('api/upload', [
        'file' => $file,
    ]);

    // Check that the response has a 200 status
    $response->assertStatus(200);

})->uses(TestCase::class);
