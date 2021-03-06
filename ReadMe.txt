HashToken is a PHP class for generating expiring tokens. The class does not
rely on the database, rather it uses simple mathematics and the current time on
the local server to work out whether a token has expired or not.

The class uses SHA256 hashing along with a secret key to keep things secure. You
should change the KEY constant before using the code.

The tokens are plaintext, and can be passed to the user for example when a form
page is generated. When the form is posted, the server may check if the token is
still valid, ensuring the form was submitted in the allotted timeframe.

This is useful for preventing web scrapers from crawling forms that are not
prudent to attach a CAPCHA to, such as an advanced search form. A token can be
created to emerge in 5 seconds and expire in 24 hours.

This all happens without any storage of tokens on the server side whatsoever.
Multiple servers can also validate eachothers keys if they share the secret key.

The class has two functions, GetToken and CheckToken:

GetToken takes 2 or 3 parameters, UserKey, ExpireTime, and EmergeTime.
GetToken returns a string representing the token.

	UserKey
		- Secret key for this particular token.
		- Necessary to determine token validity.
		- May be NULL (must then also be NULL on CheckToken)

	ExpireTime
		- Validity time of token in seconds
		- If Emerge Time is set, this begins AFTER emerge time

	EmergeTime - Time in seconds to wait before considering token valid

CheckToken takes 2 parameters, Token and UserKey
CheckToken returns a boolean indicating whether or not the token is currently valid.

	Token
		-The token string generated by GetToken

	UserKey
		-The UserKey passed into GetToken. May Be NULL.
