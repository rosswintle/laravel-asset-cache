<?php

namespace RossWintle\LaravelJPM;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PackageCache
{
	public $packageName;
	public $remotePackageUrl;

	public function __construct(string $packageName, string $remotePackageUrl)
	{
		$this->packageName = $packageName;
		$this->remotePackageUrl = $remotePackageUrl;
	}

	public function cachedUrl(): string
	{
		// If package is not cached or cache needs updating
		if (! $this->isCached()) {
			//   cache package
			$this->refreshCachedFile();
		}

		// return cached package url  
		return asset('storage/' . $this->packageName . '.js');
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

		Storage::disk('public')->put($this->packageName . '.js', $contents);

		// Update cache name and timestamp
		Cache::put($this->cacheKey(), time(), now()->addHours(1));
	}
}
