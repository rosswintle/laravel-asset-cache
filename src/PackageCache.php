<?php

namespace RossWintle\LaravelJPM;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PackageCache
{
	public $packageName;
	public $fileName;
	public $remotePackageUrl;

	public function __construct(string $packageName, string $fileName, string $remotePackageUrl)
	{
		$this->packageName = $packageName;
		$this->fileName = trim($fileName, '/');
		$this->remotePackageUrl = $remotePackageUrl;
	}

	public function cachedUrl(): string
	{
		if (! $this->isCached()) {
			//   cache package
			$this->refreshCachedFile();
		}

		return asset('storage/' . $this->fileName);
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

		Storage::disk('public')->put($this->fileName, $contents);

		// Update cache name and timestamp
		Cache::put($this->cacheKey(), time(), now()->addHours(1));
	}
}
