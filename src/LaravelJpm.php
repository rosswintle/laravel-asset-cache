<?php

namespace RossWintle\LaravelJPM;

class LaravelJPM {

// TODO: Grab files, cache, and spit out the correct URL
// Can we get correct URL in a generic PHP way? Will have to use Laravel
// Caching so we WILL be dependent on Laravel.

	public function cachedPackageUrl(
		string $packageName,
		string $versionConstraint='', 
		string $filename='') : string
	{
		return (new PackageCache(
						$packageName,
						$this->remotePackageUrl($packageName, $versionConstraint, $filename)
				))->cachedUrl();
	}

	/**
	 * Generate the URL for a package given its NPM package name
	 * and, optionally, a version constraint and a filename
	 */
	public function remotePackageUrl(
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