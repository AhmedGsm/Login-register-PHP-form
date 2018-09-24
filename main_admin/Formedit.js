/*(function(){*/  
var A_buttons=document.querySelectorAll('.linked_button');
//alert(A_buttons);
var inputs=document.getElementsByTagName('input');
var all_ok=false;
var form_id;

for(var i=0;i<A_buttons.length;i++){
//alert(A_buttons.id);
A_buttons[i].addEventListener('click',link_operations ,false);
}

function link_operations(e)
{
e.preventDefault();
button_Num=e.target.id.split('_')[1];
url="FormEditLoad.php?button_Num="+button_Num;
getAJAXResponse(url,loading_Results,e) ;
}

function getAJAXResponse(url,cfunc,e) 
{
	  var xhttp;
  xhttp=new XMLHttpRequest();
  xhttp.open("GET", url, true);
  xhttp.onreadystatechange = function() 
  {
    if (xhttp.readyState == 4 && (xhttp.status == 200 ||  xhttp.status == 0  ))
	{
    cfunc(xhttp,e);
    }
  }
  xhttp.send();
}
elem_form=document.getElementsByTagName('div');
function loading_Results(xhttp,e)
{
form_right=true;
form_edited=false;

	for(i=0;i<elem_form.length;i++)
	{
		if(elem_form[i].id=='elem_form')
		{
		elem_form[i].innerHTML='';	
		}
	}
	e.target.nextSibling.nextSibling.innerHTML=xhttp.responseText;
for(var i=0;i<inputs.length;i++)
{
    switch(inputs[i].type)
	{
	case 'text':	
	inputs[i].addEventListener('keyup',text_Function,false);
	inputs[i].addEventListener("blur",text_Function,false);
	inputs[i].addEventListener("select",text_Function,false);
	break;
		
	case 'submit':	
	inputs[i].addEventListener('click',button_Function,false);
	//inputs[i].addEventListener('click',checkbox_Function,false);
	break;
		
	case 'checkbox':	
	inputs[i].addEventListener('click',checkbox_Function,false);	
	//inputs[i].addEventListener('resize',checkbox_Function,false);
	//checkbox_Function(e);
	break;
	default:	
	}
}

var form_subm=document.getElementsByTagName('form')[0];
form_subm.addEventListener("submit",function(e){e.preventDefault();},false);
}
var any_char='a';
function text_Function(e)
{
	form_edited=true;
    if(/^label|wrong_message|double_message/.test(e.target.id)) 
    {
		if(!e.target.value)
		{
    	eval('message_'+e.target.id).innerHTML='Must not be empty';
    	eval('message_'+e.target.id).style.color='red';
		form_right=false;
		}
		else
		{
		form_right=true;
    	eval('message_'+e.target.id).innerHTML='';
		}
	}
	
    if(/^regex/.test(e.target.id)) 
    {
		if(!e.target.value)
		{
    	eval('message_'+e.target.id).innerHTML='Must not be empty';
    	eval('message_'+e.target.id).style.color='red';
		form_right=false;
		}
		else
		{
    		eval('message_'+e.target.id).innerHTML='WARNING:This regex not verified automatically,<br> please be sure that\'s in valid format before change it';
    		eval('message_'+e.target.id).style.color='red';
			form_right=true;
		}
		
	}
}

function  button_Function(e)
{
	update_results.innerHTML="";
	form_id=e.target.id.split('_')[1];
	//alert(checkbox_disabled);
	if(form_edited==true)
	{
		if(form_right==true)
		{
		displ_Check=document.querySelector('input[type=checkbox]');
		checkbox_disabled=displ_Check.disabled;
		url='FormEditCtrl.php?request=update&form_id='+form_id+'&checkbox_disabled='+checkbox_disabled;
		//alert(url);
		formObject=document.getElementById('form_'+form_id);
		sendAJAXForm(url,response_Results,formObject) ;
		}
		else
		{
		//
		unchanged_infos.style.display="none";	
		informations_error.style.display="table";
		}
	}
	else
	{
	unchanged_infos.style.display="table";
	}
}

function checkbox_Function(e)
{
form_edited=true;
	checkbox_disabled=e.target.disabled ; 
	//alert(checkbox_disabled)
    if(this.checked)
	{
		this.nextSibling.nextSibling.innerHTML='DISPLAYED';
	}
	else
	{
		this.nextSibling.nextSibling.innerHTML='HIDDEN';
	}
}

function sendAJAXForm(url,cfunc,formObject) 
{
	var xhttp;
    xhttp=new XMLHttpRequest();
    xhttp.open("POST", url);//, true
    xhttp.onreadystatechange = function() {
    
        if (xhttp.readyState == 4 && (xhttp.status == 200 ||  xhttp.status == 0  ))
	    {
        cfunc(xhttp);
        }
    }

form = new FormData( formObject );
 xhttp.send(form);
}
function response_Results( xhttp )
{
form_right=true;
form_edited=false;
	unchanged_infos.style.display="none";	
	informations_error.style.display="none";
	update_results.innerHTML=xhttp.responseText;
}
/*})();*/