<?php
class HashToken
{
	const KEY			= 'CHANGE TO SECRET STRING 65453132135165513515613651'
		, STD_EXPIRY	= 300 //Standard expiration time
		, DELIMITER		= ':';

	public static function getToken($userKey = NULL, $life = self::STD_EXPIRY, $emergeTime = 0)
	{
		$time = time();

		$expiry = $time + $life + $emergeTime;
		$emerge = $time + $emergeTime;

		$source = implode(self::DELIMITER,
			array($emerge, $expiry, $time, self::KEY, $userKey)
		);

		$hash   = hash('sha256', $source);

		$token  = implode(self::DELIMITER,
			array(dechex($time), dechex($emerge), $hash, dechex($expiry))
		);

		return $token;
	}

	public static function checkToken($token, $userKey = NULL)
	{
		$time = time();
		list($baseTimeHintHex, $emgHintHex, $tokenHash, $expHintHex) = explode(self::DELIMITER, $token);

		$baseTimeHint = hexdec($baseTimeHintHex);
		$emgHint      = hexdec($emgHintHex);
		$expHint      = hexdec($expHintHex);

		$source   = implode(self::DELIMITER,
			array($emgHint, $expHint, $baseTimeHint, self::KEY, $userKey)
		);

		$testHash = hash('sha256', $source);

		return(
			($tokenHash == $testHash)
			&&
			(
				($expHint >  $time || $expHint == $baseTimeHint)
				&&
				($emgHint <= $time || $emgHint == $baseTimeHint)
			)
		);
	}
}
