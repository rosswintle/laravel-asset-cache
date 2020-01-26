<?php

namespace RossWintle\LaravelAssetCache\Tests;

use PHPUnit\Framework\TestCase;
use RossWintle\LaravelAssetCache\LaravelAssetCache;

class RemoteAssetUrlTest extends TestCase
{

	/** @test */
	public function the_helper_returns_a_url_when_given_all_parameters()
	{
		$assetCache = new LaravelAssetCache();
		$url = $assetCache->remoteAssetUrl('jquery', '3.2.1', 'dist/jquery.min.js');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js', $url);
	}

	/** @test */
	public function the_helper_returns_a_url_when_given_no_filename()
	{
		$assetCache = new LaravelAssetCache();
		$url = $assetCache->remoteAssetUrl('jquery', '3.2.1');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery@3.2.1', $url);
	}

	/** @test */
	public function the_helper_returns_a_url_when_given_no_version()
	{
		$assetCache = new LaravelAssetCache();
		$url = $assetCache->remoteAssetUrl('jquery', '', 'dist/jquery.min.js');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js', $url);
	}

	/** @test */
	public function the_helper_returns_a_url_when_given_no_filename_or_version()
	{
		$assetCache = new LaravelAssetCache();
		$url = $assetCache->remoteAssetUrl('jquery');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery', $url);
	}

	/** @test */
	public function the_helper_returns_a_correct_url_when_slash_included_in_filename()
	{
		$assetCache = new LaravelAssetCache();
		$url = $assetCache->remoteAssetUrl('jquery', '3.2.1', '/dist/jquery.min.js');
		$this->assertSame('https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js', $url);
	}

}