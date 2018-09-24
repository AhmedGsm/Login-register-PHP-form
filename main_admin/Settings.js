(function() { 
form_Right=true;
form_Modified=false;
elements_validity=[true];
var inputs=document.getElementsByTagName('input'),
 lists=document.getElementsByTagName('select'),
 textareas=document.getElementsByTagName('textarea'),
formObject=document.getElementsByTagName('form')[0];
formObject.addEventListener("submit",function(e){e.preventDefault();},false);

for(var i=0;i<inputs.length;i++)
{
	switch(inputs[i].type)
	{
	case 'text':
	inputs[i].addEventListener('keyup',operations_clk,false);
	inputs[i].addEventListener("blur",operations_clk,false);
	inputs[i].addEventListener("select",operations_clk,false);
	break;
	
	case 'email':
	inputs[i].addEventListener('keyup',operations_clk,false);
	inputs[i].addEventListener("blur",operations_clk,false);
	inputs[i].addEventListener("select",operations_clk,false);
	break;
	
	case 'tel':
	inputs[i].addEventListener('keyup',operations_clk,false);
	inputs[i].addEventListener("blur",operations_clk,false);
	inputs[i].addEventListener("select",operations_clk,false);
	break;
	
	case 'submit':
	inputs[i].addEventListener('click',update_Infos,false);
	break;
	default:
	}
}

function operations_clk(e)
{
	form_Modified=true;
	sender_Regex=/^[a-zA-Z ]{4,}$/; 
   	if(sender_Regex.test(sender.value))
    {
	elements_validity[1]=true;		
	sender.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[1]=false;		
	sender.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Invalid \'Sender\' introduced';
	//alert(sender.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild);
	sender.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
	email_Regex=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}(,[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}){0,2}$/; 
   	if(email_Regex.test(from.value))
    {
	elements_validity[2]=true;		
	from.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[2]=false;		
	from.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Insert 1 to 3 valid emails separated by commas with no spaces';
	from.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
   	if(email_Regex.test(replyto.value))
    {
	elements_validity[3]=true;		
	replyto.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[3]=false;		
	replyto.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Insert 1 to 3 valid emails separated by commas with no spaces';
	replyto.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
   	if(email_Regex.test(cc_email.value))
    {
	elements_validity[4]=true;		
	cc_email.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[4]=false;		
	cc_email.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Insert 1 to 3 valid emails separated by commas with no spaces';
	cc_email.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
   	if(email_Regex.test(bcc_email.value))
    {
	elements_validity[5]=true;		
	bcc_email.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[5]=false;		
	bcc_email.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Insert 1 to 3 valid emails separated by commas with no spaces';
	bcc_email.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
	page_Regex=/^[a-zA-Z0-9_]{4,}\.(php|htm|html)$/;
   	if(page_Regex.test(login_page.value))
    {
	elements_validity[7]=true;		
	login_page.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[7]=false;		
	login_page.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Page name must be with 4 minimum letters with (htm, html, php) extenstions';
	login_page.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
	client_session_Regex=/^[0-9]{1,3}$/;
   	if(client_session_Regex.test(client_session.value))
    {
	elements_validity[8]=true;		
	client_session.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[8]=false;		
	client_session.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Session life must be a number';
	client_session.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
	admin_session_Regex=/^[0-9]{1,3}$/;
   	if(admin_session_Regex.test(admin_session.value))
    {
	elements_validity[9]=true;		
	admin_session.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[9]=false;		
	admin_session.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Session life must be a number';
	admin_session.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
	page_Regex=/^[a-zA-Z0-9_]{4,}\.(php|htm|html)$/;
   	if(page_Regex.test(logout_page.value))
    {
	elements_validity[10]=true;		
	logout_page.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	else
	{
	elements_validity[10]=false;		
	logout_page.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Page name must be with 4 minimum letters with (htm, html, php) extenstions';
	logout_page.parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
}

for(var i=0;i<lists.length;i++)
{
lists[i].addEventListener('change',selectListChanged,false);
}

function selectListChanged()
{
form_Modified=true;
}

function update_Infos(e)
{
	unchanged_infos.style.display="none";	
	informations_error.style.display="none";	
	update_results.innerHTML="";
	if(form_Modified==true)
	{
		for(i=0;i<elements_validity.length;i++)
		{
			form_Right=elements_validity[i];
			if(elements_validity[i]==false)
			{
			break;
			}
		}
		if(form_Right==true)
		{
		button_update.value="Updating data...";
		url='SettingsCtrl.php?request=update';
		//formObject=document.getElementById('my_form');
		sendAJAXForm(url,response_Results,formObject) ;
		}
		else
		{
		//
		unchanged_infos.style.display="none";	
		informations_error.style.display="table";
		update_results.innerHTML="";
		}
	}
	else
	{
	unchanged_infos.style.display="table";
	update_results.innerHTML="";
	}
}


for(i=0;i<textareas.length;i++)
{
	textareas[i].addEventListener('keyup',textareas_function,false);
	textareas[i].addEventListener("blur",textareas_function,false);
	textareas[i].addEventListener("select",textareas_function,false);
}


function textareas_function(event)
{
form_Modified=true;	
	if(textareas[0].value.length <=10)
	{
	elements_validity[11]=false;		
	textareas[0].parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Fill text area above, must be more than 10 caracters';
	textareas[0].parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
	else
	{
	elements_validity[11]=true;		
	textareas[0].parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
	
	if(textareas[1].value.length <=10)
	{
	elements_validity[12]=false;		
	textareas[1].parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='Fill text area above, must be more than 10 caracters';
	textareas[1].parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.style.color='red';
	}
	else
	{
	elements_validity[12]=true;		
	textareas[1].parentNode.parentNode.nextSibling.nextSibling.lastElementChild.firstElementChild.innerHTML='';
	}
}
function response_Results(xhttp)
{
form_Right=true;
form_Modified=false;
button_update.value="Update data";
update_results.innerHTML=xhttp.responseText;
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
