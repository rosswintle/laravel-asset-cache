<?php

namespace RossWintle\LaravelJPM\Tests;

class BladeDirectivesTest extends BladeTestCase
{

	/** @test */
	public function the_blade_directive_returns_a_url()
	{
        $blade = "@jscript('jquery', '3.2.1', 'dist/jquery.min.js')";

        $expected = '"<script src=\"" . \RossWintle\LaravelJPM\Facades\LaravelJPM::cachedPackageUrl(!';

        $this->assertStringContainsString($expected, $this->blade->compileString($blade));
	}

}