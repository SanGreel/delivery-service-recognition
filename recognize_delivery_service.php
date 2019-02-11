<?php
/**
 * @author SanGreel (Andrew Kurochkin), Lviv
 * @official site https://andrewkurochkin.com
 * @copyright 2015
 */

class Tracking
{	
	
	public function getPostServiceName($track)
	{
		$service = '';
		
		if($this->isUSPSTrack($track))
		{
			$service = 'USPS';
		}
		elseif ($this->isUPSTrack($track))
		{
			$service = 'UPS';
		}
		elseif ($this->isFedExTrack($track))
		{
			$service = 'FedEx';
		}

		return $service;
	}

	private function isUSPSTrack($track)
	{
		$usps = array();
		
		$usps[0] = '^(94|93|92|94|95)[0-9]{20}$';
		$usps[1] = '^(94|93|92|94|95)[0-9]{22}$';
		$usps[2] = '^(70|14|23|03)[0-9]{14}$';
		$usps[3] = '^(M0|82)[0-9]{8}$';
		$usps[4] = '^([A-Z]{2})[0-9]{9}([A-Z]{2})$';
		
		if (preg_match('/('.$usps[0].')|('.$usps[1].')|('.$usps[2].')|('.$usps[3].')|('.$usps[4].')/', $track))
		{
			return true;
		}
		
		return false;
	}
	
	private function isUPSTrack($track)
	{
		$ups = array();
		
		$ups[0] = '^(1Z)[0-9A-Z]{16}$';
		$ups[1] = '^(T)+[0-9A-Z]{10}$';
		$ups[2] = '^[0-9]{9}$';
		$ups[3] = '^[0-9]{26}$';
		
		if (preg_match('/('.$ups[0].')|('.$ups[1].')|('.$ups[2].')|('.$ups[3].')/', $track))
		{
			return true;
		}
		
		return false;
	}
	
	private function isFedExTrack($track)
	{
		$fedex = array();
		
		$fedex[0] = '^[0-9]{20}$';
		$fedex[1] = '^[0-9]{15}$';
		$fedex[2] = '^[0-9]{12}$';
		$fedex[3] = '^[0-9]{22}$';
		
		if (preg_match('/('.$fedex[0].')|('.$fedex[1].')|('.$fedex[2].')|('.$fedex[3].')/', $track))
		{
			return true;
		}
		
		return false;
	}
}
?>
