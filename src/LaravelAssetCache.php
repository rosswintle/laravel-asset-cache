<?php

namespace RossWintle\LaravelAssetCache;

class LaravelAssetCache {

	/**
	 * Generate the URL of a cached asset (and cache it or update the cached
	 * file if necessary along the way)
	 *
	 * Note: We require a filename here because we need to cache the file with the
	 * correct filename.
	 */
	public function cachedAssetUrl(
		string $packageName,
		string $versionConstraint, 
		string $filename) : string
	{
		return (new AssetCache(
						$packageName,
						$filename,
						$versionConstraint,
						$this->remoteAssetUrl($packageName, $versionConstraint, $filename)
				))->cachedUrl();
	}

	/**
	 * Generate the URL for an asset given its NPM package name
	 * and, optionally, a version constraint and a filename
	 */
	public function remoteAssetUrl(
		string $packageName,
		string $versionConstraint='', 
		string $filename='') : string
	{
		return sprintf(
			$this->urlPattern($packageName, $versionConstraint, $filename),
			$packageName,
			$this->normaliseVersionConstraint($versionConstraint),
			$this->normaliseFilename($filename));
	}

	/**
	 * Build us a pattern for use in sprintf'ing the URL
	 */
	public function urlPattern(
		string $packageName,
		string $versionConstraint='', 
		string $filename='') : string
	{
		$urlPattern = "https://cdn.jsdelivr.net/npm/%s";

		if (!empty($versionConstraint)) {
			$urlPattern .= '@%s';
		} else {
			// We still pass it in so the pattern needs to contain it
			// even though it's empty
			$urlPattern .= '%s';
		}

		if (!empty($filename)) {
			$urlPattern .= '/%s';
		}

		return $urlPattern;
	}

	public function normaliseVersionConstraint(string $versionConstraint) : string {
		return $versionConstraint;
	}
	
	public function normaliseFilename(string $filename) : string {
		return trim($filename, "/");
	}
	
}