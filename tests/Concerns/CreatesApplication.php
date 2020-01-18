<?php

namespace RossWintle\LaravelJPM\Tests\Concerns;

use Illuminate\Support\Facades\View;

trait CreatesApplication
{
    protected function getPackageProviders($app)
    {
        return [
            \RossWintle\LaravelJPM\LaravelJPMServiceProvider::class
        ];
    }
    protected function getPackageAliases($app)
	{
    	return [
        	'LaravelJPM' => RossWintle\LaravelJPM\Facades\LaravelJPM::class,
    	];
	}
}

