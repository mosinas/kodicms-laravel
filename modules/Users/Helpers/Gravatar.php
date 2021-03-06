<?php namespace KodiCMS\Users\Helpers;

class Gravatar
{

	/**
	 *
	 * @var array
	 */
	protected static $cache = [];

	/**
	 *
	 * @param string $email
	 * @param integer $size
	 * @param string $default
	 * @param array $attributes
	 * @return string
	 */
	public static function load($email, $size = 100, $default = NULL, array $attributes = NULL)
	{
		if (empty($email)) {
			$email = 'test@test.com';
		}

		if ($default === NULL) {
			$default = 'mm';
		}

		$hash = md5(strtolower(trim($email)));
		$queryParams = http_build_query([
			'd' => urlencode($default),
			's' => (int)$size
		]);

		if (!isset(self::$cache[$email][$size])) {
			self::$cache[$email][$size] = \HTML::image('http://www.gravatar.com/avatar/' . $hash . '?' . $queryParams, NULL, $attributes);
		}

		return self::$cache[$email][$size];
	}
}