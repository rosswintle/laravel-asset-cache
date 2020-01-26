<?php

namespace RossWintle\LaravelAssetCache\Tests\Concerns;

use Illuminate\Support\Facades\View;

trait CreatesApplication
{
    protected function getPackageProviders($app)
    {
        return [
            \RossWintle\LaravelAssetCache\LaravelAssetCacheServiceProvider::class
        ];
    }
    protected function getPackageAliases($app)
	{
    	return [
        	'LaravelAssetCache' => RossWintle\LaravelAssetCache\Facades\LaravelAssetCache::class,
    	];
	}
}

