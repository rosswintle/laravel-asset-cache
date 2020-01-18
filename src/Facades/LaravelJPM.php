<?php

namespace RossWintle\LaravelJPM\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelJPM extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'laravel-jpm';
	}
}
