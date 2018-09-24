(function() { 
var login=document.getElementById('login'),
password=document.getElementById('password');
var login_button=document.getElementById('login_button'),
 register_results=document.getElementById('register_results');
var formObject=document.getElementsByTagName('form')[0];
var password_length=6;
login.addEventListener("keyup",login_function,false);
login.addEventListener("blur",login_function,false);
login.addEventListener("select",login_function,false);

password.addEventListener("keyup",password_function,false);
password.addEventListener("blur",password_function,false);
password.addEventListener("select",password_function,false);

formObject.addEventListener("submit",function(e){e.preventDefault();	},false);

function login_function(e)
{
var login_Regex=/^[a-zA-Z]{5,20}[0-9]{0,20}$/,
login_Value=login.value;
    if( login_Regex.test(login_Value)  )
    {
		login_Validity=true;
		login_messages.innerHTML="";
	}
	else
	{
		login_Validity=false;	
		login_messages.style.color="red";
		login_messages.innerHTML="Empty or incorrect login introduced";
	}
}

function password_function(e)
{
    if(password.value.length>=password_length)
    {
	password_Validity=true;	
	password_messages.innerHTML="";
	}
	else
	{
	password_Validity=false;	
	password_messages.style.color="red";
	password_messages.innerHTML="Empty or incorrect password introduced";
	}
}
login_button.addEventListener("click",submitting,false);

function submitting(e)
{
	login_function(e);
	password_function(e);
	if(password_Validity && login_Validity)
	{
	url="LoginCtrl.php";
	login_button.value="Signing in....";
	sendAJAXForm(url,login_Results,formObject) 	;
	register_results.innerHTML="";
	login_button.disabled=true;
	}
	else
	{
		login_button.value="Sign in";
	}
}

function login_Results(xhttp)
{
	url="main_admin.php";
	login_button.value="Sign in";
	//alert(xhttp.responseText);
	if(xhttp.responseText=='LOGIN_SUCCESS')
	{
	document.location.href=url;
	}
	else
	{
	register_results.innerHTML=xhttp.responseText;
	}
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
form = new FormData(formObject);
 xhttp.send(form);
}
})();

