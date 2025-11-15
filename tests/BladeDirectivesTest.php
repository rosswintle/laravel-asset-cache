<?php

namespace RossWintle\LaravelAssetCache\Tests;

use PHPUnit\Framework\Attributes\Test;

class BladeDirectivesTest extends BladeTestCase
{

    #[Test]
    public function the_blade_directive_returns_a_url()
    {
        $blade = "@jscript('jquery', '3.2.1', 'dist/jquery.min.js')";

        $expected = '"<script src=\"" . \RossWintle\LaravelAssetCache\Facades\LaravelAssetCache::cachedAssetUrl(\'jquery\', \'3.2.1\', \'dist/jquery.min.js\') . "\"></script>';

        $this->assertStringContainsString($expected, $this->blade->compileString($blade));
    }

}
