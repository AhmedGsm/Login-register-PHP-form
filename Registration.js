(function(){
//variables
var password_length=6,
main_password=false,
first_name_validity=false,
register_button=document.getElementById('register_button'),
day=document.getElementById('day'),
month=document.getElementById('month'), 
year=document.getElementById('year'),
gender=document.getElementById('gender'),
country=document.getElementById('country'),
country_messages=document.getElementById('country_messages'),
time_zone=document.getElementById('time_zone'),
conditions=document.getElementById('conditions');

var formObject=document.getElementsByTagName('form')[0];
formObject.addEventListener("submit",function(e){
	e.preventDefault();
	},false);

 var conditions_validity=false,/*captcha_validity=false,*/time_zone_validity=false,
password_confirm_validity=false,password_validity=false,CSV_validity=false,
credit_card_validity=false,paypal_validity=false,post_code_validity=false,
address_validity=false,country_validity=false,telephone_validity=false,
email_validity=false,pseudonym_validity=false,gender_validity=false,
birth_validity=false,day_validity=false,month_validity =false,
	year_validity=false,age_validity=false,last_name_validity=false,first_name_validity=false;
var inputs_Ok=false;
//LOAD MESSAGES REGEXs FROM SERVER 
var url_loader="MessagesLoad.php?request=load_messages";
getAJAXResponse(url_loader, load_messages_regexes ) ;

function load_messages_regexes(xhttp)
{
eval('messages_regexes='+xhttp.responseText);
registration_Events();
}
function htmlspecialchars_decode(string) 
{
  //       discuss at: http://phpjs.org/functions/htmlspecialchars_decode/
  //      original by: Mirek Slugen
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Mateusz "loonquawl" Zalega
  //      bugfixed by: Onno Marsman
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //         input by: ReverseSyntax
  //         input by: Slawomir Kaniecki
  //         input by: Scott Cariss
  //         input by: Francois
  //         input by: Ratheous
  //         input by: Mailfaker (http://www.weedem.fr/)
  //       revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //        example 1: htmlspecialchars_decode("<p>this -&gt; &quot;</p>", 'ENT_NOQUOTES');
  //        returns 1: '<p>this -> &quot;</p>'
  //        example 2: htmlspecialchars_decode("&amp;quot;");
  //        returns 2: '&quot;'

  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === 'undefined') {
    quote_style = 2;
  }
  string = string.toString()
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>');
  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
    // string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
  }
  if (!noquotes) {
    string = string.replace(/&quot;/g, '"');
  }
  // Put this in last place to avoid escape being double-decoded
  string = string.replace(/&amp;/g, '&');

  return string;
}

function registration_Events()
{
    if(messages_regexes[0].display=='YES')
    {
    var first_name=document.getElementById('first_name');
    first_name.addEventListener("keyup",first_name_function,false);
    first_name.addEventListener("blur",first_name_function,false);
    first_name.addEventListener("select",first_name_function,false);
    }
	
	if(messages_regexes[1].display=='YES')
    {
    last_name.addEventListener("keyup",last_name_function,false);
    last_name.addEventListener("blur",last_name_function,false);
    last_name.addEventListener("select",last_name_function,false);
	}
	//*************///
	if(messages_regexes[2].display=='YES')
    {
    var  age=document.getElementById('age');
    age.addEventListener("keyup",age_function,false);
    age.addEventListener("blur",age_function,false);
    age.addEventListener("select",age_function,false);
    }
	//}
	if(messages_regexes[3].display=='YES')
    {
    day.addEventListener("change",day_function,false);  
    month.addEventListener("change",month_function,false);
    year.addEventListener("change",year_function,false);
	}
	if(messages_regexes[4].display=='YES')
    {
    gender.addEventListener("change",gender_function,false);
	}
	if(messages_regexes[5].display=='YES')
    {
    var pseudonym=document.getElementById('pseudonym');
    pseudonym.addEventListener("keyup",pseudonym_function,false);
    pseudonym.addEventListener("blur",pseudonym_function,false);
    pseudonym.addEventListener("select",pseudonym_function,false);
    }
	if(messages_regexes[6].display=='YES')
    {
    var email=document.getElementById('email');
    email.addEventListener("keyup",email_function,false);
    email.addEventListener("blur",email_function,false);
    email.addEventListener("select",email_function,false);
    // email.addEventListener("change",email_function,false);
	}
	if(messages_regexes[7].display=='YES')
    {
    var telephone=document.getElementById('telephone');
    telephone.addEventListener("keyup",telephone_function,false);
    telephone.addEventListener("blur",telephone_function,false);
    telephone.addEventListener("select",telephone_function,false);
    }
	if(messages_regexes[8].display=='YES')
    {
    country.addEventListener("change",country_function,false);
	}
	if(messages_regexes[9].display=='YES')
    {
    var address=document.getElementById('address');
    address.addEventListener("keyup",address_function,false);
    address.addEventListener("blur",address_function,false);
    address.addEventListener("select",address_function,false);
    }
	if(messages_regexes[10].display=='YES')
    {
    var post_code=document.getElementById('post_code');
    post_code.addEventListener("keyup",post_code_function,false);
    post_code.addEventListener("blur",post_code_function,false);
    post_code.addEventListener("select",post_code_function,false);
    }
	if(messages_regexes[11].display=='YES')
    {
    var  paypal=document.getElementById('paypal');
    paypal.addEventListener("keyup",paypal_function,false);
    paypal.addEventListener("blur",paypal_function,false);
    paypal.addEventListener("select",paypal_function,false);
	}
	if(messages_regexes[12].display=='YES')
    {
    var  credit_card=document.getElementById('credit_card');
    credit_card.addEventListener("keyup",credit_card_function,false);
    credit_card.addEventListener("blur",credit_card_function,false);
    credit_card.addEventListener("select",credit_card_function,false);
    }
	if(messages_regexes[13].display=='YES')
    {
    var CSV =document.getElementById('CSV');
    CSV.addEventListener("keyup",CSV_function,false);
    CSV.addEventListener("blur",CSV_function,false);
    CSV.addEventListener("select",CSV_function,false);
	}
	if(messages_regexes[14].display=='YES')
    {
    var password=document.getElementById('password');
    password.addEventListener("keyup",password_keyup,false);
    password.addEventListener("blur",password_keyup,false);
    password.addEventListener("select",password_keyup,false);
	}
	if(messages_regexes[15].display=='YES')
    {
    var password_confirm =document.getElementById('password_confirm');
    password_confirm.addEventListener("keyup",password_confirm_keyup,false);
    password_confirm.addEventListener("blur",password_confirm_keyup,false);
    password_confirm.addEventListener("select",password_confirm_keyup,false);
	}
	if(messages_regexes[16].display=='YES')
    {
    time_zone.addEventListener("change",time_zone_function,false);
	}
	if(messages_regexes[17].display=='YES')
    {
    captcha.addEventListener("keyup",captcha_function,false);
    captcha.addEventListener("blur",captcha_function,false);
    captcha.addEventListener("select",captcha_function,false);
	}
}

function first_name_function(e)
{
var first_name_Regex=eval('/'+messages_regexes[0].regex+'/'),
 first_name_Value=first_name.value
    if(first_name_Value)
	{
    if( first_name_Regex.test(first_name_Value)  )
    {
    first_name_messages.textContent=htmlspecialchars_decode(messages_regexes[0].right_message) ;
	first_name_messages.style.color='green';
	first_name_validity=true;
    }
    else 
    {
    first_name_messages.textContent=htmlspecialchars_decode(messages_regexes[0].wrong_message);
	first_name_messages.style.color='red';
	first_name_validity=false;
    }
	}
	else
	{
	first_name_messages.textContent="Input must not be empty";	
	first_name_messages.style.color='red';
	first_name_validity=false;
	}
}


function last_name_function(e)
{
var last_name_Regex=eval('/'+messages_regexes[1].regex+'/'),
 last_name_Value=last_name.value;
    if(last_name_Value)
	{
    if( last_name_Regex.test(last_name_Value)  )
    {
    last_name_messages.textContent=htmlspecialchars_decode(messages_regexes[1].right_message);
	last_name_messages.style.color='green';
	last_name_validity=true;
    }
    else 
    {
    last_name_messages.textContent=htmlspecialchars_decode(messages_regexes[1].wrong_message);
	last_name_messages.style.color='red';
	last_name_validity=false;
	  
    }
	}
	else
	{
	last_name_messages.textContent="Input must not be empty";		
	last_name_messages.style.color='red';	
	last_name_validity=false;
	}
}

function age_function(e)
{
var age_Regex=eval('/'+messages_regexes[2].regex+'/'),
 age_Value=age.value;
    if(age_Value)
	{
    if( age_Regex.test(age_Value)  )
    {
    age_messages.textContent=htmlspecialchars_decode(messages_regexes[2].right_message);
	age_messages.style.color='green';
	age_validity=true;
    }
    else 
    {
    age_messages.textContent=htmlspecialchars_decode(messages_regexes[2].wrong_message);
	age_messages.style.color='red';
	age_validity=false;
    }
	}
	else
	{
	age_messages.textContent="Input must not be empty";	
	age_messages.style.color='red';		
	age_validity=false;	
	}

}


function day_function(e)
{
    if(!day.value || !month.value || !year.value)
	{
    birth_messages.textContent=htmlspecialchars_decode(messages_regexes[3].wrong_message);
	birth_messages.style.color='red';
	day_validity=false;
	month_validity=false;
	year_validity=false;
	}
	else
	{
    birth_messages.textContent=htmlspecialchars_decode(messages_regexes[3].right_message);
	birth_messages.style.color='green';
	//birth_validity=true;
	day_validity=true;
	month_validity=true;
	year_validity=true;
	}
}
function month_function(e)
{
    if(!day.value || !month.value || !year.value)
	{
    birth_messages.textContent=htmlspecialchars_decode(messages_regexes[3].wrong_message);
	birth_messages.style.color='red';
	day_validity=false;
	month_validity=false;
	year_validity=false;
	}
	else
	{
    birth_messages.textContent=htmlspecialchars_decode(messages_regexes[3].right_message) ;
	birth_messages.style.color='green';
	day_validity=true;
	month_validity=true;
	year_validity=true;
	}
	

}
function year_function(e)
{
    if(!day.value || !month.value || !year.value)
	{
    birth_messages.textContent= htmlspecialchars_decode(messages_regexes[3].wrong_message);
	birth_messages.style.color= 'red';
	//birth_validity=false;
	day_validity=false;
	month_validity=false;
	year_validity=false;
	}
	else
	{
    birth_messages.textContent= htmlspecialchars_decode(messages_regexes[3].right_message);
	birth_messages.style.color='green';
	day_validity=true;
	month_validity=true;
	year_validity=true;
	}
	

}
function gender_function(e)
{
	if(!gender.value )
	{
    gender_messages.textContent=htmlspecialchars_decode(messages_regexes[4].wrong_message);
	gender_messages.style.color='red';
	gender_validity=false;
	}
	else
	{
    gender_messages.textContent=htmlspecialchars_decode(messages_regexes[4].right_message);
	gender_messages.style.color='green';
	gender_validity= true;
	}
}

function pseudonym_function(e)
{
var pseudonym_Regex=eval('/'+messages_regexes[5].regex+'/'),
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
    	pseudonym_messages.textContent=htmlspecialchars_decode(messages_regexes[5].wrong_message);
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
	pseudonym_messages.textContent=htmlspecialchars_decode(messages_regexes[5].right_message);
	pseudonym_messages.style.color='green';
	pseudonym_validity=true;	}
	else if( xhttp.responseText=='PSEUDO_DOUBLED' )
	{
	pseudonym_messages.textContent=htmlspecialchars_decode(messages_regexes[5].double_message);
	pseudonym_messages.style.color='red';
	pseudonym_validity=false;
	}

}

//AGE
function email_function(e)
{
var email_Regex=eval('/'+messages_regexes[6].regex+'/'),
 email_Value=email.value;
    if(email_Value)
	{
    if( email_Regex.test(email_Value)  )
    {
	var url="DoubleCheck.php?emailCheck="+email_Value;
    getAJAXResponse(url, emailCheck ) ;
    }
    else 
    {
    email_messages.textContent=htmlspecialchars_decode(messages_regexes[6].wrong_message);
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
	email_messages.innerHTML=xhttp.responseText;
if( xhttp.responseText=='EMAIL_NOT_DOUBLED' ) 
{
email_messages.textContent=htmlspecialchars_decode(messages_regexes[6].right_message);
email_messages.style.color='green';
email_validity=true;
}
else if( xhttp.responseText=='EMAIL_DOUBLED' )//
{
email_messages.textContent=htmlspecialchars_decode(messages_regexes[6].double_message);
email_messages.style.color='red';
email_validity=false;
}

}
function telephone_function(e)
{
var telephone_Regex=eval('/'+messages_regexes[7].regex+'/'),
 telephone_Value=telephone.value;
    if(telephone_Value)
	{
    if(telephone_Regex.test(telephone_Value)  )
    {
    telephone_messages.textContent=htmlspecialchars_decode(messages_regexes[7].right_message);
	telephone_messages.style.color='green';
	telephone_validity=true;
    }
    else 
    {
    telephone_messages.textContent=htmlspecialchars_decode(messages_regexes[7].wrong_message);
	telephone_messages.style.color='red';
	telephone_validity=false;
    }
	}
	else
	{
	telephone_messages.textContent="Input must not be empty";	
	telephone_messages.style.color='red';	
	telephone_validity=false;		
	}
}
function country_function(e)
{
    if(!country.value )
	{
    country_messages.textContent=htmlspecialchars_decode(messages_regexes[8].wrong_message);
	country_messages.style.color='red';
	country_validity=false;
	}
	else
	{
    country_messages.textContent=htmlspecialchars_decode(messages_regexes[8].right_message);
	country_messages.style.color='green';
	country_validity=true;
	}
}

function address_function(e)
{
var address_Regex=eval('/'+messages_regexes[9].regex+'/'),
 address_Value=address.value;
    if(address_Value)
	{
    if( address_Regex.test(address_Value)  )
    {
    address_messages.textContent=htmlspecialchars_decode(messages_regexes[9].right_message);
	address_messages.style.color='green';
	address_validity=true;
    }
    else 
    {
    address_messages.textContent=htmlspecialchars_decode(messages_regexes[9].wrong_message);
	address_messages.style.color='red';
	address_validity=false;
    }
	}
	else
	{
	address_messages.textContent="Input must not be empty";	
	address_messages.style.color='red';		
	address_validity=false;	
	}
}

function post_code_function(e)
{
var post_code_Regex=eval('/'+messages_regexes[10].regex+'/'),
 post_code_Value=post_code.value;
    if(post_code_Value)
	{
    if( post_code_Regex.test(post_code_Value)  )
    {
    post_code_messages.textContent=htmlspecialchars_decode(messages_regexes[10].right_message);
	post_code_messages.style.color='green';
	post_code_validity=true;
    }
    else 
    {
    post_code_messages.textContent=htmlspecialchars_decode(messages_regexes[10].wrong_message);
	post_code_messages.style.color='red';
	post_code_validity=false;
    }
	}
	else
	{
	post_code_messages.textContent="Input must not be empty";	
	post_code_messages.style.color='red';	
	post_code_validity=false;		
	}
}
function paypal_function(e)
{
var paypal_Regex =eval('/'+messages_regexes[11].regex+'/'),
 paypal_Value=paypal.value;
    if(paypal_Value)
	{
    if( paypal_Regex.test(paypal_Value)  )
    {
    paypal_messages.textContent=htmlspecialchars_decode(messages_regexes[11].right_message);
	paypal_messages.style.color='green';
	paypal_validity=true;
    }
    else 
    {
    paypal_messages.textContent=htmlspecialchars_decode(messages_regexes[11].wrong_message);
	paypal_messages.style.color='red';
	paypal_validity=false;
    }
	}
	else
	{
	paypal_messages.textContent="Input must not be empty";	
	paypal_messages.style.color='red';	
	paypal_validity=false;		
	}
}
function credit_card_function(e)
{
var credit_card_Regex=eval('/'+messages_regexes[12].regex+'/'),
 credit_card_Value=credit_card.value;
    if(credit_card_Value)
	{
    if( credit_card_Regex.test(credit_card_Value))
    {
    credit_card_messages.textContent=htmlspecialchars_decode(messages_regexes[12].right_message);
	credit_card_messages.style.color='green';
	credit_card_validity=true;
    }
    else 
    {
    credit_card_messages.textContent=htmlspecialchars_decode(messages_regexes[12].wrong_message);
	credit_card_messages.style.color='red';
	credit_card_validity=false;
    }
	}
	else
	{
	credit_card_messages.textContent="Input must not be empty";	
	credit_card_messages.style.color='red';	
	credit_card_validity=false;		
	}
}

function CSV_function(e)
{
var CSV_Regex=eval('/'+messages_regexes[13].regex+'/'),
 CSV_Value=CSV.value;
    if(CSV_Value)
	{
    if( CSV_Regex.test(CSV_Value)  )
    {
    CSV_messages.textContent=htmlspecialchars_decode(messages_regexes[13].right_message);
	CSV_messages.style.color='green';
	CSV_validity=true;
    }
    else 
    {
    CSV_messages.textContent=htmlspecialchars_decode(messages_regexes[13].wrong_message);
	CSV_messages.style.color='red';
	CSV_validity=false;
    }
	/*
    if(email_Value)
	{
	*/
	}
	else
	{
	CSV_messages.textContent="Input must not be empty";	
	CSV_messages.style.color='red';	
	CSV_validity=false;		
	}
}
function password_keyup ()
{
var password_Regex=eval('/'+messages_regexes[14].regex+'/'),//^[0-9]{3}$/,
 password_Value=password.value;
    if(password_Value)
	{
    if(password_Regex.test(password_Value)  )
    {
	main_password=true;
	password_messages.textContent=htmlspecialchars_decode(messages_regexes[14].right_message);
	password_messages.style.color='green';
	password_validity=true;
		password_confirm_keyup();
    }
	else
	{
	main_password=false;
	password_messages.textContent=htmlspecialchars_decode(messages_regexes[14].wrong_message);
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
	    password_confirm_messages.textContent=htmlspecialchars_decode(messages_regexes[15].right_message);
	    password_confirm_messages.style.color='green';
	    password_confirm_validity=true;
		}
		else
		{
		password_confirm_messages.textContent=htmlspecialchars_decode(messages_regexes[15].wrong_message);
		password_confirm_messages.style.color='red';
		password_confirm_validity=false;
		}
   }
}

function time_zone_function(e)
{
    if(!time_zone.value )
	{
    time_zone_messages.textContent=htmlspecialchars_decode(messages_regexes[16].wrong_message);
	time_zone_messages.style.color='red';
	time_zone_validity=false;
	}
	else
	{
    time_zone_messages.textContent=htmlspecialchars_decode(messages_regexes[16].right_message);
	time_zone_messages.style.color='green';
	time_zone_validity=true;
	}
}
function captcha_function(e)
{
 captcha_Value=captcha.value;
    if(captcha_Value)
	{
		if(captcha.value.length!=6)
		{
    	messages_captcha.textContent=htmlspecialchars_decode(messages_regexes[17].wrong_message);
		messages_captcha.style.color='red';
		captcha_validity=false;
		}
	}
	else
	{
	messages_captcha.textContent="Input must not be empty";	
	messages_captcha.style.color='red';	
	captcha_validity=false;		
	}
}

function conditions_function(e)
{
    if(conditions.checked==true)
    {
		//alert('fdggf');
    messages_conditions.textContent=htmlspecialchars_decode(messages_regexes[18].right_message);
	messages_conditions.style.color='green';
	conditions_validity=true;
    }
	else
    {
	messages_conditions.textContent=htmlspecialchars_decode(messages_regexes[18].wrong_message);
	messages_conditions.style.color='red';
	conditions_validity=false;
    }
	
}
var information_check=document.getElementById('information_check');
register_button.addEventListener("click",function(e)
{
	register_results.innerHTML="";
	information_check.style.display="none";
    if(messages_regexes[0].display=='YES')
    {
    first_name_function();
    }
	
	if(messages_regexes[1].display=='YES')
    {
    last_name_function ();
	}
	if(messages_regexes[2].display=='YES')
    {
    age_function ();
	}
	if(messages_regexes[3].display=='YES')
    {
    day_function ();
	month_function ();
	year_function ();
	}
	if(messages_regexes[4].display=='YES')
    {
    gender_function ();
	}
	if(messages_regexes[5].display=='YES')
    {
    pseudonym_function ();
	}
	if(messages_regexes[6].display=='YES')
    {
    email_function ();
	}
	if(messages_regexes[7].display=='YES')
    {
    telephone_function ();
	}
	if(messages_regexes[8].display=='YES')
    {
    country_function ();
	}
	if(messages_regexes[9].display=='YES')
    {
    address_function ();
	}
	if(messages_regexes[10].display=='YES')
    {
    post_code_function ();
	}
	if(messages_regexes[11].display=='YES')
    {
    paypal_function();
	}
	if(messages_regexes[12].display=='YES')
    {
    credit_card_function();
	}
	if(messages_regexes[13].display=='YES')
    {
    CSV_function(e);
	}
	if(messages_regexes[14].display=='YES')
    {
    password_keyup();
	}
	if(messages_regexes[15].display=='YES')
    {
    password_confirm_keyup();
	}
	if(messages_regexes[16].display=='YES')
    {
    time_zone_function(e);
	}
	if(messages_regexes[17].display=='YES')
    {
    captcha_function();
	}
	
	if(messages_regexes[18].display=='YES')
    {
    conditions_function(e);
	}
	allTextInputs= document.getElementsByTagName('input');
	allSelects= document.getElementsByTagName('select');
	for(var i=0; i<allTextInputs.length; i++)
	{
		if(allTextInputs[i].type!='checkbox' && allTextInputs[i].type!='button' && allTextInputs[i].type!='submit'&& allTextInputs[i].type!='hidden' )
		{
			inputs_Ok=eval(allTextInputs[i].id+'_validity');
			//alert(inputs_Ok);
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
function registrationResults(xhttp) 
{
register_results.innerHTML=xhttp.responseText;
register_button.value="Register"	;
register_button.disabled=false;
}
function sendAJAXForm(url,cfunc,formObject) 
{
	  var xhttp;
  xhttp=new XMLHttpRequest();
  xhttp.open("POST", url);//, true
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
