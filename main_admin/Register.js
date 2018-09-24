(function() { 
//variables
//var password_length=6,
main_password=false;

 var site_name_validity ,pseudonym_validity=false
email_validity=false,
password_validity=false,
password_confirm_validity=false;

var formObject=document.getElementsByTagName('form')[0];
formObject.addEventListener("submit",function(e){e.preventDefault();},false);
var inputs_Ok=false;
//LOAD MESSAGES REGEXs FROM SERVER 
var url_loader="MessagesLoad.php?request=load_messages";
registration_Events();
function registration_Events()
{
    var site_name=document.getElementById('site_name');
    site_name.addEventListener("keyup",site_name_function,false);
    site_name.addEventListener("blur",site_name_function,false);
	site_name.addEventListener("select",site_name_function,false);
	
    var pseudonym=document.getElementById('pseudonym');
    pseudonym.addEventListener("keyup",pseudonym_function,false);
    pseudonym.addEventListener("blur",pseudonym_function,false);
	pseudonym.addEventListener("select",pseudonym_function,false);

    var email=document.getElementById('email');
    email.addEventListener("keyup",email_function,false);
    email.addEventListener("blur",email_function,false);
	email.addEventListener("select",email_function,false);

    var password=document.getElementById('password');
    password.addEventListener("keyup",password_keyup,false);
    password.addEventListener("blur",password_keyup,false);
	password.addEventListener("select",password_keyup,false);

    var password_confirm =document.getElementById('password_confirm');
    password_confirm.addEventListener("keyup",password_confirm_keyup,false);
    password_confirm.addEventListener("blur",password_confirm_keyup,false);
	password_confirm.addEventListener("select",password_confirm_keyup,false);
}

function site_name_function(e){
// site_name_Regex=/^[^\u00B2&"'()_=^$<>,;:!/*\-+.\u00A4%\u00B0?~#{}[\]|`@\\00A8]{6,}$/,
// site_name_Regex=/^([^\u0000-\u002F\u003A-\u0040\u005B-\u0060\u007B-\u00BF]){6,}$/,
 //site_name_Regex=/^([^\u0000-\u001F\u0021-\u002F\u003A-\u0040\u005B-\u0060\u007B-\u00BF]){6,}$/,
 site_name_Regex=/^([^\u0021-\u002F\u003A-\u0040\u005B-\u0060\u007B-\u00BF]){6,}$/,//*\u00AC\u00AE-*/
site_name_Value=site_name.value;
    if(site_name_Value)
	{
		if(site_name_Regex.test(site_name_Value))
    	{
    	site_name_messages.textContent='';
		site_name_messages.style.color='green';
		site_name_validity=true;
    	//var url="DoubleCheck.php?pseudoCheck="+site_name_Value;
    	//getAJAXResponse(url, pseudoCheck ) ;
    	}
    	else 
    	{
    	site_name_messages.textContent='Site name must be above 6 alphanumerics charchters with no metacharcters';
		site_name_messages.style.color='red';
		site_name_validity=false;
    	}
	}
	else
	{
	site_name_messages.textContent="Input must not be empty";	
	site_name_messages.style.color='red';				
	}
}
function pseudonym_function(e)
{
var pseudonym_Regex=/^[a-zA-Z]{5,20}[0-9]{0,20}$/,
pseudonym_Value=pseudonym.value;
    if(pseudonym_Value)
	{
		if( pseudonym_Regex.test(pseudonym_Value)  )
    	{
    	var url="DoubleCheck.php?pseudoCheck="+pseudonym_Value;
    	getAJAXResponse(url, pseudoCheck ) ;
    	}
    	else 
    	{
    	pseudonym_messages.textContent='Must contains 5 alpabetics letters or alphanumerics';
		pseudonym_messages.style.color='red';
		pseudonym_validity=false;
    	}
	}
	else
	{
	pseudonym_messages.textContent="Input must not be empty";	
	pseudonym_messages.style.color='red';				
	}
}

function pseudoCheck( xhttp )
{
	if( xhttp.responseText=='PSEUDO_NOT_DOUBLED' ) 
	{
	pseudonym_messages.textContent='';
	pseudonym_messages.style.color='green';
	pseudonym_validity=true;	}
	else if( xhttp.responseText=='PSEUDO_DOUBLED' )
	{
	pseudonym_messages.textContent='User name already exists, select other one';
	pseudonym_messages.style.color='red';
	pseudonym_validity=false;
	}
}

//AGE
function email_function(e)
{
var email_Regex=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$/,
 email_Value=email.value;
    if(email_Value)
	{
    if(email_Regex.test(email_Value))
    {
	var url="DoubleCheck.php?emailCheck="+email_Value;
    getAJAXResponse(url, emailCheck ) ;
    }
    else 
    {
    email_messages.textContent='Must be like: "EmailerMobile@gmail.com"';
	email_messages.style.color='red';
	email_validity=false;
    }
	}
	else
	{
	email_messages.textContent="Input must not be empty";	
	email_messages.style.color='red';	
	email_validity=false;		
	}
}

function emailCheck( xhttp )
{
if( xhttp.responseText=='EMAIL_NOT_DOUBLED' ) 
{
email_messages.textContent='';
email_messages.style.color='green';
email_validity=true;
}
else if( xhttp.responseText=='EMAIL_DOUBLED' )//
{
email_messages.textContent='Email already exists, select other one';
email_messages.style.color='red';
email_validity=false;
}

}
function password_keyup ()
{
var password_Regex=/^.{6,}$/ ,
 password_Value=password.value;
    if(password_Value)
	{
    if(password_Regex.test(password_Value)  )
    {
	main_password=true;
	password_messages.textContent='';
	password_messages.style.color='green';
	password_validity=true;
	password_confirm_keyup();
    }
	else
	{
	main_password=false;
	password_messages.textContent='Low password length';
	password_messages.style.color='red';
	password_confirm_messages.textContent='';
	password_validity=false;
	}
	}
	else
	{
	password_messages.textContent="Input must not be empty";	
	password_messages.style.color='red';	
	password_validity=false;		
	}
}

function password_confirm_keyup()
{
    if(main_password)
    {
        if(password_confirm.value==password.value)
        {
	    password_confirm_messages.textContent='';
	    password_confirm_messages.style.color='green';
	    password_confirm_validity=true;
		}
		else
		{
		password_confirm_messages.textContent='Password verification is different from password';
		password_confirm_messages.style.color='red';
		password_confirm_validity=false;
		}
   }
}


var information_check=document.getElementById('information_check');
register_button.addEventListener("click",function(e)
{   
    site_name_function();
    pseudonym_function();
    email_function();
    password_keyup();
    password_confirm_keyup();
	register_results.innerHTML="";
	information_check.style.display="none";	
	allTextInputs= document.getElementsByTagName('input');
	allSelects= document.getElementsByTagName('select');
	
	for(var i=0; i<allTextInputs.length; i++)
	{
		if(allTextInputs[i].type!='checkbox' && allTextInputs[i].type!='button' && allTextInputs[i].type!='submit'&& allTextInputs[i].type!='hidden' )
		{
			inputs_Ok=eval(allTextInputs[i].id+'_validity');
			if(inputs_Ok==false)
			{
			break;
			}
		}
		else if(allTextInputs[i].type=='checkbox')
		{
			if( allTextInputs[i].checked==true)	
			{
			inputs_Ok=true;
			}
			else
			{
			inputs_Ok=false;
			break;
			}
		}
	}
	
	if(inputs_Ok==true)
	{
		for(var i=0; i<allSelects.length; i++)
		{
			inputs_Ok=eval( allSelects[i].id+'_validity');
				if(inputs_Ok==false)
				{
				break;
				}
		}
	}

	if(inputs_Ok)
	{
	e.target.value="Submitting..."	;
	e.target.disabled=true;
	url="RegisterCtrl.php";
    sendAJAXForm (url,registrationResults, formObject ) ;
	information_check.style.display="none";	
	}
	else
	{
	information_check.style.display="block";	
	} 
},false);

var register_results=document.getElementById('register_results');
//formObject=document.getElementsByTagName('form')[0];
function registrationResults(xhttp) 
{
register_results.innerHTML=xhttp.responseText;
formObject.style.display='none';
register_button.value="Register"	;
register_button.disabled=false;
}
function sendAJAXForm(url,cfunc,formObject) 
{
	  var xhttp;

  xhttp=new XMLHttpRequest();
  xhttp.open("POST", url);
  xhttp.onreadystatechange = function() 
  {
    if (xhttp.readyState == 4 && (xhttp.status == 200 ||  xhttp.status == 0  ))
	{
    cfunc(xhttp);
    }
  }

form = new FormData( formObject );
 xhttp.send(form);
}

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
}
})();
