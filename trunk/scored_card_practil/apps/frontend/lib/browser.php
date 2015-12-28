<?php

/**
 * Class to detect which browser is currently accessing the page/site
 * This class is very loosely based on scripts by Gary White  *
 */

class browser
{
private $imgURL  	='';
	private $Agente		='';
	private $isM		='';
	public function isMobile($Agente){
		global $movilURL; global $pcURL; $isM=0;
		if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i',strtolower($Agente))){
			$isM++;
		}
		if((strpos(strtolower($Agente),'application/vnd.wap.xhtml+xml')>0) ||
		((isset($_SERVER['HTTP_X_WAP_PROFILE']) ||
		isset($_SERVER['HTTP_PROFILE'])))){
			$isM++;
		}
		$ua=strtolower(substr($Agente,0,4));
		$mobile_agents=array('w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac','blaz','brew','cell',
		'cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g',
		'lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana',
		'pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-',
		'siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-',
		'wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');
		if(in_array($ua,$mobile_agents)){
			$isM++;
		}
		if(strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0) {
			$isM++;
		}
		if(strpos(strtolower($Agente),'windows')>0) {
			$isM=0;
		}
		if($isM>0){
			return true;
		}else{
			return false;
		}
	}//fin de isMobile()
	public  function getSO($Agente){
		if      (preg_match("/Windows NT 5.1/i",  $Agente)) $SO = "Windows XP";
		elseif  (preg_match("/Windows NT 5.0/i",  $Agente)) $SO = "Windows 2000";
		elseif  (preg_match("Win98     /i",       $Agente)) $SO = "Windows 98";
		elseif  (preg_match("/Windows NT 6.0/i",  $Agente))$SO="Windows Vista";
		elseif  (preg_match("/Windows NT 6.1/i",  $Agente))$SO="Windows 7";
		elseif  (preg_match("/Win/i",             $Agente)) $SO = "Windows ??";
		elseif  ( (preg_match("/Mac/i",           $Agente)) || (preg_match("/PPC/i", $Agente))) $SO = "Macintosh";
		elseif  (preg_match("/Debian/i",          $Agente)) $SO = "Debian";
		elseif  (preg_match("/Linux/i",           $Agente)) $SO = "Linux";
		elseif  (preg_match("/FreeBSD/i",         $Agente)) $SO = "FreeBSD";
		elseif  (preg_match("/SunOS/i",           $Agente)) $SO = "SunOS";
		elseif  (preg_match("/IRIX/i",            $Agente)) $SO = "IRIX";
		elseif  (preg_match("/BeOS/i",            $Agente)) $SO = "BeOS";
		elseif  (preg_match("/OS/2/i",            $Agente)) $SO = "OS/2";
		elseif  (preg_match("/AIX/i",             $Agente)) $SO = "AIX";
		else   $SO="Desconocido";
		return $SO;
	}//fin de getSO()
	public  function getNAV($Agente){
		if    (preg_match("/Opera.([0-9]+)(\.([0-9])+)*/i",  	$Agente,$browser));
		elseif(preg_match("/Netscape .([0-9]+)(\.([0-9])+)*/i",	$Agente,$browser));
		elseif(preg_match("/MSIE ([0-9]+)(\.([0-9])+)*/i",   	$Agente,$browser));
		elseif(preg_match("/Lynx/i",                         	$Agente,$browser));
		elseif(preg_match("/WebTV/i",                           $Agente,$browser));
		elseif(preg_match("/Galeon.([0-9]+)(\.([0-9])+)*/i",    $Agente,$browser));
		elseif(preg_match("/Konqueror.([0-9]+)(\.([0-9])+)*/i", $Agente,$browser));
		elseif(preg_match("/Firefox.([0-9]+)(\.([0-9])+)*/i",	$Agente,$browser));
		elseif(preg_match("/Iceweasel.([0-9]+)(\.([0-9])+)*/i", $Agente,$browser));
		elseif(preg_match("/Firebird.([0-9]+)(\.([0-9])+)*/i",  $Agente,$browser));
		elseif(preg_match("/Chrome.([0-9]+)(\.([0-9])+)*/i",    $Agente,$browser));
		elseif(preg_match("/Safari.([0-9]+)(\.([0-9])+)*/i",    $Agente,$browser));


		elseif ((preg_match("/Gecko/i",$Agente))
			||(preg_match("/X11/i",    $Agente))
			||(preg_match("/Mozilla/i",$Agente))
			||(preg_match("/U/i",      $Agente)))               $nombre[0] = "Mozilla";
		elseif(preg_match("/WAP/i",                             $Agente,$browser));
		else $nombre[0]="Otro";
		$navegador=str_replace('/',' ',$browser[0]);
		return $navegador;
	}//fin de getNAV()
	public function getRobot($Agente){
		if     (preg_match("/Google/i",  $Agente)) $robot = "Google";
		elseif (preg_match("/Yahoo/i",   $Agente)) $robot = "Yahoo";
		elseif (preg_match("/msnbot/i",  $Agente)) $robot = "MSN";
		elseif (preg_match("/Scooter/i", $Agente)) $robot = "Bot";
		elseif (preg_match("/Spider/i",  $Agente)) $robot = "Bot";
		elseif (preg_match("/Infoseek/i",$Agente)) $robot = "Bot";
		elseif (preg_match("/Slurp/i",   $Agente)) $robot = "Bot";
		elseif (preg_match("/bot/i",     $Agente)) $robot = "Bot";
		else   $robot="Otro";
	return $robot;
	}//fin de getRobot()

}//end class
?>