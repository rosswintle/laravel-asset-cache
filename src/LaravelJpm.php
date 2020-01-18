<?php

namespace RossWintle\LaravelJPM;

class LaravelJPM {

	/**
	 * Generate the URL for a package given its NPM package name
	 * and, optionally, a version constraint and a filename
	 */
	public function packageUrl(
		string $packageName,
		string $versionConstraint='', 
		string $file='') : string
	{
		// We will build up a pattern for use in sprintf
		$urlPattern = "https://cdn.jsdelivr.net/npm/%s";

		if (!empty($versionConstraint)) {
			$urlPattern .= '@%s';
		} else {
			// We still pass it in so the pattern needs to contain it
			// even though it's empty
			$urlPattern .= '%s';
		}

		if (!empty($file)) {
			$urlPattern .= '/%s';
		}

		return sprintf(
			$urlPattern,
			$packageName,
			$this->normaliseVersionConstraint($versionConstraint),
			$this->normaliseFilename($file));
	}

	public function normaliseVersionConstraint(string $versionConstraint) : string {
		return $versionConstraint;
	}
	
	public function normaliseFilename(string $filename) : string {
		return trim($filename, "/");
	}
	
}