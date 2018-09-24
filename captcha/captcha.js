//(function(){

var code     =document.getElementById('code'),
canvases_div =document.getElementById('canvases_div'),
load_captcha =document.getElementById('load_captcha'),
captcha =document.getElementById('captcha'),
messages_captcha=document.getElementById('messages_captcha');//messages

var canvases=[],
captcha_validity=false,
 alfaNumerics=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
'0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T',
'U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n',
'o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R',
'S','T','U','V','W','X','Y','Z'];
	var response='',stringCode='',responseTEXT='',captcha_verification_result=false,increm=0;
function getAJAXResponse(url,cfunc) 
{
	  var xhttp;

  xhttp=new XMLHttpRequest();
  xhttp.open("GET", url, true);
  xhttp.onreadystatechange = function() 
  {
    if (xhttp.readyState == 4 && (xhttp.status == 200 ||  xhttp.status == 0  ))
	{
    cfunc(xhttp);
    }
  }
  xhttp.send();
  //return xhttp;
}
getAJAXResponse('captcha/randomString.php?Request=get_RandomString',displayCaptcha);

function displayCaptcha(xhttp)
{
messages_captcha.innerHTML="";	
stringCode=xhttp.responseText;
createCharsBoxes(stringCode.length);
drawCaptcha(stringCode);
}

function verifyCaptcha(xhttp)
{
captcha_verification_result=xhttp.responseText;	

    if(captcha_verification_result=="RIGHT_CAPTCHA_CODE" )
	{
	// alert('true');
	// messages_captcha.innerHTML="Right Captcha code";
	//messages_captcha.style.color="green";
	messages_captcha.textContent=messages_regexes[17].right_message;//'Incorrect code introduced';
	messages_captcha.style.color='green';
	captcha_validity=true;
	}
	else if(captcha_verification_result=="WRONG_CAPTCHA_CODE" )
	{
	//alert('false');
	//messages_captcha.innerHTML="Wrong introduced code";
	//messages_captcha.style.color="red";
	messages_captcha.textContent=messages_regexes[17].wrong_message;//'Incorrect code introduced';
	messages_captcha.style.color='red';
	captcha_validity=false;
	}

}
	
	
//**FUNCTIONS
function getRandomString(stringLength)
{
var randomString='';

for(var i=0;i< stringLength;i++)
{
var randomNumber= Math.random();
randomNumber= randomNumber*100 ;
randomNumber=parseInt(randomNumber);
randomNumber=randomNumber.toString();
randomString+=alfaNumerics[ randomNumber];
}
return randomString;
}



function drawCaptcha(stringCode)
{
    for(var i=0;i<stringCode.length;i++)
    {
    var context = canvases[i].getContext('2d');
    context.font = "100px Calibri,Geneva,Arial";
    randomNumber= Math.random();
    randomNumber= randomNumber*100 ;
    charRotation=parseInt(randomNumber);
    charRotation=charRotation-50;
    canvases[i].style.transform='rotate('+ charRotation +'deg)';
    canvases[i].innerHTML= charRotation;
    context.fillText(stringCode[i], 120, 130);
    }
}

function createCharsBoxes( stringLength)
{
//check if childs exists
if(canvases_div.hasChildNodes)
{
    for(i=0;i<canvases.length;i++)
    {
    canvases_div.removeChild(canvases[i]);
    }
}
for(var i=0;i<stringCode.length;i++)
{
canvases[i]=document.createElement('canvas');
canvases_div.appendChild(canvases[i]);
}
}

load_captcha.addEventListener('click',function(e)
{
e.preventDefault();
messages_captcha.innerHTML="Generating code...";
messages_captcha.style.color="black";
captcha.value="";
captcha_validity=false;
getAJAXResponse('captcha/randomString.php?Request=get_RandomString',displayCaptcha);

},false);

captcha.addEventListener('keyup',captcha_function,false);
captcha.addEventListener("blur",captcha_function,false);
captcha.addEventListener("select",captcha_function,false);
function captcha_function(e)
{
	var entered_code=e.target.value;
	if(entered_code.length==6)
	{
	messages_captcha.innerHTML="Server code verification...";	
	getAJAXResponse('captcha/randomString.php?Request=captcha_verification&captcha_code='+entered_code,verifyCaptcha);
	}
	else
	{
	messages_captcha.innerHTML="";		
	captcha_validity=false;
	}
}
 // })();
