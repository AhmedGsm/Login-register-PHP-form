(function() { 
var email=document.getElementById('email'),
login_button=document.getElementById('login_button'),
formObject=document.getElementsByTagName('form')[0],
register_results=document.getElementById('register_results');
email.addEventListener("keyup",email_function,false);
email.addEventListener("blur",email_function,false);
email.addEventListener("select",email_function,false);
password_length=6;
formObject.addEventListener("submit",function(e){e.preventDefault();},false);	
	
function email_function(e) 
{
var email_Regex=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$/,
 email_Value=email.value;
    if( email_Regex.test(email_Value))
    {
    email_messages.textContent='';
	email_messages.style.color='green';
	email_validity=true;
    }
    else 
    {
    email_messages.textContent='Must be like: "EmailerMobile@gmail.com"';
	email_messages.style.color='red';
	email_validity=false;
    }
}
/*
var password=document.getElementById('password');
password.addEventListener("keyup",password_keyup,false);
password.addEventListener("blur",password_keyup,false);

var password_confirm =document.getElementById('password_confirm');
password_confirm.addEventListener("keyup",password_confirm_keyup,false);
password_confirm.addEventListener("blur",password_confirm_keyup,false);

function password_keyup() 
{
    if(password.value.length>=password_length)
    {
	main_password=true;
	password_messages.textContent='Valid password length';
	password_messages.style.color='green';
	password_validity=true;
        if(password_confirm.value==password.value)
        {
	    password_confirm_messages.textContent='Valid password verification';
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
	else
	{
	main_password=false;
	password_messages.textContent='Must be '+password_length+' minimum characters';
	password_messages.style.color='red';
	password_confirm_messages.textContent='';
	password_validity=false;
	}
}

function password_confirm_keyup()
{
    if(main_password)
    {
        if(password_confirm.value==password.value)
        {
	    password_confirm_messages.textContent='Valid password verification';
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
*/
login_button.addEventListener("click",submitting,false);

function submitting(e)
{
    email_function(e);
    //password_keyup(); 
    //password_confirm_keyup();
	
	if(  email_validity/* && password_validity && password_confirm_validity*/ )
	{
	url="RecoveryCtrl.php";
	login_button.value="Sending link...."
	sendAJAXForm(url,login_Results,formObject) 	;
	register_results.innerHTML="";
	login_button.disabled=true;
	}
	else
	{
	login_button.value="Recover password";
	register_results.innerHTML="";
	}
}

function login_Results(xhttp)
{
	login_button.value="Recover password"
	register_results.innerHTML=xhttp.responseText;
	login_button.disabled=false;
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
})();