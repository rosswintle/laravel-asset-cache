<?php

namespace RossWintle\LaravelAssetCache\Tests;

use RossWintle\LaravelAssetCache\Tests\Concerns\CreatesApplication;
use Orchestra\Testbench\TestCase as BaseTestCase;

class BladeTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $blade;

    public function setUp(): void
    {
        parent::setUp();

        $this->blade = app('blade.compiler');
    }
}

