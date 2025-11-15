<?php

namespace RossWintle\LaravelAssetCache;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use RossWintle\LaravelAssetCache\LaravelAssetCache;

class LaravelAssetCacheServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('laravel-asset-cache', function() {
			return new LaravelAssetCache();
		});
	}

	public function boot()
	{
		// For testing see the example at https://github.com/appstract/laravel-blade-directives/blob/master/tests/DataAttributesTest.php
		Blade::directive('jscript', function($expression) {
			return '<?php echo "<script src=\\"" . \RossWintle\LaravelAssetCache\Facades\LaravelAssetCache::cachedAssetUrl(' . $expression . ') . "\\"></script>\\n" ?>';
		});
	}
}