<?php

namespace RossWintle\LaravelJPM\Tests;

class BladeDirectivesTest extends BladeTestCase
{

	/** @test */
	public function the_blade_directive_returns_a_url()
	{
        $blade = "@jscript('jquery', '3.2.1', 'dist/jquery.min.js')";

        $expected = '"https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"';

        $this->assertStringContainsString($expected, $this->blade->compileString($blade));
	}

	/** @test */
	public function the_blade_directove_returns_a_url_when_given_no_filename()
	{
        $blade = "@jscript('jquery', '3.2.1')";

        $expected = '"https://cdn.jsdelivr.net/npm/jquery@3.2.1"';

        $this->assertStringContainsString($expected, $this->blade->compileString($blade));
	}

	/** @test */
	public function the_blade_directive_returns_a_url_when_given_no_version()
	{
        $blade = "@jscript('jquery', '', 'dist/jquery.min.js')";

        $expected = '"https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"';

        $this->assertStringContainsString($expected, $this->blade->compileString($blade));
	}

	/** @test */
	public function the_blade_directive_returns_a_url_when_given_no_filename_or_version()
	{
        $blade = "@jscript('jquery')";

        $expected = '"https://cdn.jsdelivr.net/npm/jquery"';

        $this->assertStringContainsString($expected, $this->blade->compileString($blade));
	}

	/** @test */
	public function the_blade_directive_returns_a_correct_url_when_slash_included_in_filename()
	{
        $blade = "@jscript('jquery', '3.2.1', '/dist/jquery.min.js')";

        $expected = '"https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"';

        $this->assertStringContainsString($expected, $this->blade->compileString($blade));
	}

}