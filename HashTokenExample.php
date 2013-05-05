<?php
require('HashToken.php');
//In production, you should use internally
//generated data, for example, the username
//of the current logged in user.
//Input data is not recommended.
$username = 'JohnSmith';

//$token now contains a value that may be
//considered valid for the next for the next
//five minutes.
$token = HashToken::getToken($username, 60*5);

//We can run CheckToken with the same $username
//and it will return valid if the call is made
//within 5 minutes of generaton.
if(HashToken::checkToken($token, $username))
{
	echo "Token valid!\n";
}
else
{
	echo "Token is not valid.\n";
}

//You can also pass NULL as the first parameter.
//Since there is no secret passed in, this token
//is valid for anyone who passes it during the
//five minute timeframe.

$anonToken	= HashToken::getToken(NULL, 60*5);
if(HashToken::checkToken($anonToken, $username))
{
	echo "Token valid!\n";
}
else
{
	echo "Token is not valid.\n";
}

//Tokens may also have an "emerge" time, if this
//parameter is set, the token will be considered
//invalid for that number of seconds before becoming
//valid. The expiration time begins counting down
//at the emerge time.

//This token will be invalid for 10 minutes before
//becoming valid. It will remain valid for 5 minutes
//after that
$anonToken2	= HashToken::getToken(NULL, 60*5, 60*10);

if(HashToken::checkToken($anonToken2, $username))
{
	echo "Token valid!\n";
}
else
{
	echo "Token is not valid.\n";
}
