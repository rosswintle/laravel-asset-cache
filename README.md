# Laravel Asset Cache

A Laravel package that automates downloading CSS and JS assets from CDNs so that
they can be self hosted.

[Why shoud I do this?](https://rosswintle.uk/2020/02/laravel-statamic-asset-cacher-for-js-css-dependencies/) <- Long-read!

## Installation

Use the following versions:

* v1.x for Laravel 5.7, 5.8, 6.0 and 7.0 on PHP7
* v2.x for Laravel 8.x and PHP 8.0
* v3.x for Laravel 8.x/9.x and PHP 8.1/8.1

Install the package with composer:

```
composer require rosswintle/laravel-asset-cache
```

Cached assets are stored in and served from the `public` file storage "disk". You will need to have symlinked your `public/storage` directory to `storage/app/public` as per the [Laravel docs](https://laravel.com/docs/8.x/filesystem#the-public-disk) using:

```
php artisan storage:link
```

Be sure to do this in ALL environments: local, staging, and production.

## Usage

### Blade directive

If you just want a `<script>` tag for a JavaScript asset then you can use the blade directive

```
@jscript(<package>, <version>, <file>)
```

* `package` is the name of an npm package (currently only npm is supported via jsdelivr.net)
* `version` is a version constraint such as `1.9.0`. Semantic versioning is assumed. You can use `1.9` to get the latest `1.9.x` version as per the [jsdelivr docs](https://www.jsdelivr.com/features) but this is not recommended in production environments
* `file` is the path and filename (with extension) for the asset that you want relative to the package's root. For example `dist/alpine.js`

_Example_

```
@jscript('alpinejs', '1.9', 'dist/alpine.js')
```

### Method call

A more flexible way is to use the static `cachedAssetUrl()` method of the `LaravelAssetCache` class, accessible through a facade as follows:

```
<script defer src="{{ LaravelAssetCache::cachedAssetUrl(<package>, <version>, <file>) }}"></script>
```

Parameter definitions are the same as for the Blade directive, above.

This is more flexible as you can add your own attributes to the tag that refers to the asset.

```
<script defer src="{{ LaravelAssetCache::cachedAssetUrl('jquery', '3.4', 'dist/jquery.min.js') }}"></script>
```

You can also use this method for CSS:

```
<link rel="stylesheet" href="{{ LaravelAssetCache::cachedAssetUrl('tailwindcss', '1.1.4', 'dist/tailwind.min.css') }}">
```

## What does this do?

Using the Blade directive or `cachedAssetUrl` method:

* Downloads the asset from jsdelivr.net
* Caches it in your apps `public` directory
* Returns the URL of the cached, local asset

## What problem does this solve?

There's [a FULL explanation on my blog](https://rosswintle.uk/2020/02/laravel-statamic-asset-cacher-for-js-css-dependencies/).

It saves you having to manually download assets and include them in your project if you want to host them locally.

There are [various reasons](https://csswizardry.com/2019/05/self-host-your-static-assets/) why you may want to do this, such as avoiding having your users tracked, to avoid depending on third-party CDNs and there are possible performance benefits too.

I'm also on a mission to ditch npm and build process from simple projects, so this bit of automation seemed useful.

If you dare specify an imprecise version constraint such as just `1.9` you can also get latest releases of dependencies without having to do anything! But all the big CDN's advise against this as it can break your site so use with __caution__ and avoid in production environments!!

## Compatibility

This package was built for and tested with Laravel 6.x, but should work on older and newer versions.

Be aware that package auto-discovery only works in Laravel 5.5 and higher. With older versions you will have to add the service provider and alias manually. I'm not providing instructions because you should be running newer Laravel.

## Limitations

This is my first public package. All sorts of things could be wrong! Please be gentle.

I've not tested this on huge files, but it works for 73kb of compressed TailwindCSS.

Currently only works with npm packages, and pulls from cdn.jsdelivr.net

Downloads are currently synchronous so if an end user hits a cache operation they will see a slower page load.

## Testing

I'm not an expert tester, so I've tested some aspects of the package, but not the use of `Cache` and `Storage`.

Feel free to contribute tests if you know how.

## Roadmap

* Better use of Guzzle - can it send straight to the file?
* Configuration for, for example, cache duration, or use of different CDNs
* Auto-discovery of "main" file for a package
* Automatic asynchronous cache refreshing (is this possible?)
* Add some slight randomisation (plus or minus a few minutes at random) of cache times so that one person doesn't get ALL the assets re-cached in one request.
* cron job/cli for asynchronous cache refreshing

## Credits

* Thanks to [Marcel Pociot](https://twitter.com/marcelpociot) for his excellent [PHP Package Development](https://phppackagedevelopment.com/) course which helped me greatly in making this a package
* Thanks to [Ben Furfie](https://twitter.com/frontendben), [Ryan Chandler](https://twitter.com/ryangjchandler) and [Duncan McClean](https://twitter.com/damcclean) for encouragement and feedback
