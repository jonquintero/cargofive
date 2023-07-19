<?php

it('returns a valid response from the shipping surcharges endpoint', function () {
    // Make a GET request to the surcharges endpoint of the API
    $response = $this->get('/api/surcharges');

    // Assert that the response has a 200 HTTP status code
    $response->assertStatus(200);

    // Assert that the response contains an array of surcharges
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'relationships' => [
                    'standard_surcharge_name' => [
                        'name'
                    ],
                    'calculation_type' => [
                        'name'
                    ],
                    'rate'
                ],
                'apply_to'
            ]
        ],
        'links' => [
            'first',
            'last',
            'prev',
            'next'
        ],
        'meta' => [
            'current_page',
            'from',
            'last_page',
            'links' => [
                '*' => [
                    'url',
                    'label',
                    'active'
                ]
            ],
            'path',
            'per_page',
            'to',
            'total'
        ]
    ]);
});
