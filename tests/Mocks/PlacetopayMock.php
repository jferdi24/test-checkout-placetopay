<?php

namespace Tests\Mocks;

use Dnetix\Redirection\Entities\Status;
use Dnetix\Redirection\Message\RedirectInformation;
use Dnetix\Redirection\Message\RedirectResponse;
use Dnetix\Redirection\PlacetoPay;

class PlacetopayMock extends PlacetoPay
{
    public function query(int $requestId): RedirectInformation
    {
        return new RedirectInformation([
            'requestId' => fake()->randomNumber(),
            'status' => new Status([
                'status' => 'OK',
                'reason' => 'PC',
                'message' => 'La petición se ha procesado correctamente',
                'date' => now()->toString(),
            ]),
        ]);
    }

    public function request($redirectRequest): RedirectResponse
    {
        return new RedirectResponse([
            'requestId' => fake()->randomNumber(),
            'status' => new Status([
                'status' => 'OK',
                'reason' => 'PC',
                'message' => 'La petición se ha procesado correctamente',
                'date' => now()->toAtomString(),
            ]),
        ]);
    }
}
