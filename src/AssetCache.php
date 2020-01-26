<?php

namespace RossWintle\LaravelAssetCache;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AssetCache
{
	public $packageName;
	public $version;
	public $filename;
	public $remoteAssetUrl;

	public function __construct(string $packageName, string $filename, string $version, string $remoteAssetUrl)
	{
		$this->packageName = $packageName;
		$this->version = $version;
		$this->filename = $this->constructFilenameWithPathAndVersion($packageName, $filename, $version);
		$this->remoteAssetUrl = $remoteAssetUrl;
	}

	public function constructFilenameWithPathAndVersion(
		string $packageName,
		string $filename,
		string $version): string
	{
		// Trim the slash is there is one
		$filename = trim($filename, '/');
		// Split at dots
		$parts = explode('.', $filename);
		// Remember the extension
		$extension = array_pop($parts);
		// Add the version and extension back on
		array_push($parts, $version, $extension);
		// Construct the path and filename from the parts
		return $packageName . '/' . implode('.', $parts);
	}

	public function cachedUrl(): string
	{
		if (! $this->isCached()) {
			//   cache asset
			$this->refreshCachedFile();
		}

		return asset('storage/' . $this->filename);
	}

	public function cacheKey(): string
	{
		return 'LAC-' . $this->filename . '-cached';
	}

	public function isCached(): bool
	{
		return Cache::has($this->cacheKey());
	}

	public function refreshCachedFile(): void
	{
		$contents = file_get_contents($this->remoteAssetUrl);

		if (false === $contents) {
			// Download failed
			return;
		}

		Storage::disk('public')->put($this->filename, $contents);

		// Update cache name and timestamp
		Cache::put($this->cacheKey(), time(), now()->addHours(1));
	}
}
