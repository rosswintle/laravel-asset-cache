<?php

namespace RossWintle\LaravelJPM;

class BladeExpressionParser
{
	public static function parse(string $expression) : array
	{
		return array_map(
			function($part) {
				return trim($part, ' \'"');
			}, explode(',', $expression));
	}
}
