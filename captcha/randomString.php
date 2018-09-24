<?php
session_start();
 $alfaNumerics=array('a','b','c','d','e','f','g','h','i','j','k','l','m','0','1','2','3','4','5','6','7','8','9','n','o','p',
 'q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K',
 'L','M','0','1','2','3','4','5','6','7','8','9','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
//$randomString='65 ';
$captcha_validity=false;
function getRandomString($stringLength)
{ 
global $alfaNumerics;
//var_dump(sizeof($alfaNumerics));
    $randomString='';

    for( $i=0;$i< $stringLength;$i++)
    {
    $randomNumber= rand(0,81) ;
    $randomString.=$alfaNumerics[ $randomNumber];
    }
	return $randomString;
}

if(isset($_GET['Request']))
{
$Request=htmlspecialchars($_GET['Request'])	;
	if($Request=='get_RandomString')
	{
	//Captcha code generating & sending it to client
		$randomString=getRandomString(6);
		echo $randomString;
		$_SESSION['randomString']=$randomString;
	}
}

if(isset($_GET['Request']) && isset($_GET['captcha_code']))
{
$Request=htmlspecialchars($_GET['Request'])	;
$captcha_code=htmlspecialchars($_GET['captcha_code'])	;
	if($Request=='captcha_verification')
	{
		if(isset($_SESSION['randomString']))
		{
		$randomString=$_SESSION['randomString'];
	//Captcha code verification with PHP server
			if(preg_match("#^{$captcha_code}$#i",$randomString))
			{
			echo "RIGHT_CAPTCHA_CODE";
			$captcha_validity=true;
			$_SESSION['captcha_validity']=true;
			}
			else
			{
			echo "WRONG_CAPTCHA_CODE";
			$captcha_validity=false;
			$_SESSION['captcha_validity']=false;
			}
		}
		else
		{
		echo "SESSION_TIMEOUT";	
		}
		
	}
}
//session_destroy();

?>
