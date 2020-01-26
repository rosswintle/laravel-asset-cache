<?php

namespace RossWintle\LaravelAssetCache\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelAssetCache extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'laravel-asset-cache';
	}
}
