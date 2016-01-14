<?php

namespace Gabievi\OSMP;

use Illuminate\Support\Facades\Facade;

class OSMPFacade extends Facade
{

	/**
	 * Get the registered name of the component.
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'osmp';
	}
}