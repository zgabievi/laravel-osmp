<?php

namespace Gabievi\OSMP;

class OSMP
{
	
	public function __construct()
	{

	}
	
	/**
	 * @return bool|mixed
	 */
	public function init()
	{
		switch (request('command')) {
			case 'check':
				return $this->Check();
				break;
			
			case 'pay':
				return $this->Pay();
				break;
			
			default:
				abort(403, 'Unauthorized action.');
				
				return false;
		}
	}
	
	/**
	 * @return \Gabievi\OSMP\OSMP
	 */
	public function Check()
	{
		
		event('osmp.check', request()->all());
		
		// success
		return $this->Response(0, session()->get('osmp.check', []));
	}
	
	/**
	 * @return \Gabievi\OSMP\OSMP
	 */
	public function Pay()
	{
		
		event('osmp.pay', request()->all());
		
		// success
		return $this->Response(0, session()->get('osmp.pay', []));
	}
	
	/**
	 * @param $key
	 * @param array $info
	 *
	 * @return $this
	 */
	public function Response($key, $info = [])
	{
		return response()->view('osmp::xml', [
			'result' => $key,
			'comment' => config('osmp.errors')[$key],
			'info' => $info,
		])->header('Content-Type', 'application/xml');
	}
}