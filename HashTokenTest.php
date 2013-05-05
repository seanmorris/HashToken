<?php
require('HashToken.php');

$userKey = 'userKey';

echo "Test 1:\tToken expires after 3 seconds..." . PHP_EOL . PHP_EOL;
sleep(2);

$token = HashToken::getToken($userKey, 3);

echo "\tGenerated:\t" . $token . PHP_EOL;
echo "\tWaiting 2 seconds to check token..." . PHP_EOL;

sleep(2);

echo "\tChecking:\t" . $token . PHP_EOL . "\t";
echo (HashToken::checkToken($token, $userKey) ? '!!--Valid--!!' : '!!--Invalid--!!') . PHP_EOL . PHP_EOL;

echo "Test 2: Waiting 2 seconds to recheck token..." . PHP_EOL . PHP_EOL;

sleep(2);

echo "\tChecking:\t" . $token . PHP_EOL . "\t";
echo (HashToken::checkToken($token, $userKey) ? '!!--Valid--!!' : '!!--Invalid--!!') . PHP_EOL . PHP_EOL;

echo "Test 3:\tToken does not become valid for 3 seconds, expires after 3 more seconds" . PHP_EOL . PHP_EOL;

sleep(2);

$token = HashToken::getToken($userKey, 3, 3);

echo "\tGenerated:\t" . $token . PHP_EOL;
echo "\tWaiting 2 seconds to check token..." . PHP_EOL;

sleep(2);

echo "\tChecking:\t" . $token . PHP_EOL . "\t";
echo (HashToken::checkToken($token, $userKey) ? '!!--Valid--!!' : '!!--Invalid--!!') . PHP_EOL . PHP_EOL;

echo "Test 4: Waiting 2 seconds to recheck token..." . PHP_EOL . PHP_EOL;

sleep(2);

echo "\tChecking:\t" . $token . PHP_EOL . "\t";
echo (HashToken::checkToken($token, $userKey) ? '!!--Valid--!!' : '!!--Invalid--!!') . PHP_EOL . PHP_EOL;

echo "Test 5: Waiting 2 seconds to recheck token..." . PHP_EOL . PHP_EOL;

sleep(2);

echo "\tChecking:\t" . $token . PHP_EOL . "\t";
echo (HashToken::checkToken($token, $userKey) ? '!!--Valid--!!' : '!!--Invalid--!!') . PHP_EOL . PHP_EOL;
