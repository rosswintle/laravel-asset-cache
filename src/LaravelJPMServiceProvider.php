<?php

namespace RossWintle\LaravelJPM;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use RossWintle\LaravelJPM\LaravelJPM;
use RossWintle\LaravelJPM\BladeExpressionParser;

class LaravelJPMServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('laravel-jpm', function() {
			return new LaravelJPM();
		});
	}

	public function boot()
	{
		// For testing see the example at https://github.com/appstract/laravel-blade-directives/blob/master/tests/DataAttributesTest.php
		Blade::directive('jscript', function($expression) {
			return '<?php echo "<script src=\\"" . \RossWintle\LaravelJPM\Facades\LaravelJPM::cachedPackageUrl(' . $expression . ') . "\\"></script>\\n" ?>';
		});
	}
}