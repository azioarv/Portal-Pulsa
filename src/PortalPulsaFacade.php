<?php 
namespace AzioArv\PortalPulsa;

use Illuminate\Support\Facades\Facade;

class PortalPulsaFacade extends Facade

{

	public static function getFacadeAccessor(){
		return 'run-portalpulsa';
	}

}