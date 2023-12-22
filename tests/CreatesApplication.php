<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Tests\Mocks\PlacetopayMock;

trait CreatesApplication
{
    public function createApplication(): Application
    {
        /** @var Application $app */
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $app->bind('client-placetopay', function () {
            return new PlacetopayMock([
                'login' => config('placetopay.login'),
                'tranKey' => config('placetopay.trankey'),
                'baseUrl' => config('placetopay.baseUrl'),
                'timeout' => 10,
            ]);
        });

        return $app;
    }
}
