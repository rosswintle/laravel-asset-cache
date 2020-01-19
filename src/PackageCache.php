<?php

namespace RossWintle\LaravelJPM;

use Illuminate\Support\Facades\Storage;

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
		// if ()
			//   cache package
			$this->refreshCachedFile();
		// }

		// return cached package url  
		return asset('storage/' . $this->packageName);
	}

	public function isCached(): boolean
	{
		return true;
	}

	public function refreshCachedFile(): void
	{
		$contents = file_get_contents($this->remotePackageUrl);

		Storage::disk('local')->put($this->packageName, $contents);

		// Update cache name and timestamp
	}
}
