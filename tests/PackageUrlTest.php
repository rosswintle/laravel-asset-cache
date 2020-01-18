<?php

namespace RossWintle\LaravelJPM\Tests;

use PHPUnit\Framework\TestCase;
use RossWintle\LaravelJPM\LaravelJPM;

class PackageUrlTest extends TestCase
{

	/** @test */
	public function the_helper_returns_a_url_when_given_all_parameters()
	{
		$jpm = new LaravelJPM();
		$url = $jpm->packageUrl('jquery', '3.2.1', 'dist/jquery.min.js');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js', $url);
	}

	/** @test */
	public function the_helper_returns_a_url_when_given_no_filename()
	{
		$jpm = new LaravelJPM();
		$url = $jpm->packageUrl('jquery', '3.2.1');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery@3.2.1', $url);
	}

	/** @test */
	public function the_helper_returns_a_url_when_given_no_version()
	{
		$jpm = new LaravelJPM();
		$url = $jpm->packageUrl('jquery', '', 'dist/jquery.min.js');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js', $url);
	}

	/** @test */
	public function the_helper_returns_a_url_when_given_no_filename_or_version()
	{
		$jpm = new LaravelJPM();
		$url = $jpm->packageUrl('jquery');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery', $url);
	}

	/** @test */
	public function the_helper_returns_a_correct_url_when_slash_included_in_filename()
	{
		$jpm = new LaravelJPM();
		$url = $jpm->packageUrl('jquery', '3.2.1', '/dist/jquery.min.js');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js', $url);
	}

}