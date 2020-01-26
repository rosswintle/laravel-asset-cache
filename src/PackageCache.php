<?php

namespace RossWintle\LaravelJPM;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PackageCache
{
	public $packageName;
	public $version;
	public $filename;
	public $remotePackageUrl;

	public function __construct(string $packageName, string $filename, string $version, string $remotePackageUrl)
	{
		$this->packageName = $packageName;
		$this->version = $version;
		$this->filename = $this->constructFilenameWithVersion($filename, $version);
		$this->remotePackageUrl = $remotePackageUrl;
	}

	public function constructFilenameWithVersion($filename, $version)
	{
		$parts = explode('.', $filename);
		$extension = array_pop($parts);
		array_push($parts, $version, $extension);
		return implode('.', $parts);
	}

	public function cachedUrl(): string
	{
		if (! $this->isCached()) {
			//   cache package
			$this->refreshCachedFile();
		}

		return asset('storage/' . $this->filename);
	}

	public function cacheKey(): string
	{
		return 'LaravelJPM-' . $this->packageName . '-cached';
	}

	public function isCached(): bool
	{
		return Cache::has($this->cacheKey());
	}

	public function refreshCachedFile(): void
	{
		$contents = file_get_contents($this->remotePackageUrl);

		Storage::disk('public')->put($this->filename, $contents);

		// Update cache name and timestamp
		Cache::put($this->cacheKey(), time(), now()->addHours(1));
	}
}
