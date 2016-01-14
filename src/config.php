<?php

return [
	/*
	 * Distributor name to be used for Basic Auth
	 */
	'username' => 'DistributorName',

	/*
	 * Secret key to be used for Basic Auth
	 */
	'secret' => 'DistributorSecret',

	/*
	 * List of Error Messages
	 */
	'errors' => [
		0 => 'Operation was successful',
		1 => 'Server Timeout',
		4 => 'Wrong format of the user\'s account',
		5 => 'User does not exist',
		7 => 'Payments are prohibited',
		215 => 'Transaction duplication',
		275 => 'Wrong amount',
		300 => 'Fatal Error',
	],
];