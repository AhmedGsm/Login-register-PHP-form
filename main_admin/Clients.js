(function() { 
empty_email=document.getElementById('empty_email');
email_form=document.getElementById('email_form');

empty_email.style.display='none';
a_Clicked=false;
button_search=document.getElementById('button_search');
members_details=document.getElementById('members_details');
//main_div.style.opacity="0.5";
//change_Buttons_Cursor('no-drop');
//alert(all_SubButtons);
//change_Buttons_Properties(true) ;
button_search.addEventListener('click',list_Members,false);
radio_buttons=document.getElementsByName('ascendesc');
//orderby.addEventListener('change',list_Members,false);
/*function change_Buttons_Cursor(cursor_Type)
{//preventDefault
	all_SubButtons=document.querySelectorAll("input[type=submit]");
	for(var i=0;i<all_SubButtons.length;i++)
	{
	//alert(all_SubButtons);
	all_SubButtons[i].style.cursor=cursor_Type;
	}
}*/

//div_email.addEventListener('load',list_Members,false);
	if(document.getElementById('members_details')!=null){
	//list_Members(event);
	//alert('members_details');
	}
	setTimeout(list_Members, 200);
//list_Members();

form_subm=document.getElementsByTagName('form');
for(i=0;i<form_subm.length;i++){
//form_subm[i].addEventListener("submit",function(e){e.preventDefault();},false);	 ascend
}
for(i=0;i<radio_buttons.length;i++){
	//radio_buttons[i].addEventListener('click',list_Members,false);
}

function  change_Buttons_Properties(apply){//disable_Buttons

	update_buttons=document.getElementsByTagName('input');
	orderby=document.getElementById('orderby');
	orderby.disabled=apply;
	account_state=document.getElementById('account_state');
	account_state.disabled=apply;
	
	//div_limiter.disabled=apply;
	
    for(var i=0;i<update_buttons.length;i++){
	    /*if(update_buttons[i].type=='submit')
	    {*/
	        update_buttons[i].disabled=apply;
			if(apply){
			update_buttons[i].style.cursor='no-drop';
			update_buttons[i].style.opacity='0.5';
			//update_buttons[i].style.backgroundColor='rgb(200,200,200)';
			}
			else{
			update_buttons[i].style.cursor='pointer';
			update_buttons[i].style.opacity='1';
			//update_buttons[i].style.backgroundColor='initial';
			}
	   // }
		
    }
}
//list_Members();
//document.addEventListener('load',list_Members,true);
//members_details.addEventListener('change',delimiterRedirect,true);

//document.addEventListener('load',delimiterRedirect,true);
//setTimeout(list_Members,6000);//members_details
//delimiterRedirect();
//alert(document.getElementById('members_details'));
function delimiterRedirect(){
	//alert(document.getElementById('redirct'));
	//alert('redirect');
	if(document.getElementById('redirct')!=null){
	document.location.href='clients.php?page=1&elems=10#members_details';	
	}
}
function list_Members(e){
//if(document.addEventListener('redirct')=='undefined'
//e.preventDefault();	
//e.stopPropagation();	
	//main_div.style.opacity="0.5";
	//change_Buttons_Cursor('no-drop');
	//button_search.style.opacity="0.5";
	//div_email.style.opacity="0.5";
	//members_details.style.opacity='0.5';
	button_search.value="Searching...";
	//button_search.disabled=true;

	chunks=	window.location.href.split('?');
	argms=chunks[1];
	//alert(chunks[0] );members_details
	//alert(chunks[1] );
	if(!a_Clicked)
	{
		if(argms!='undefined'){
		url='ClientsCtrl.php?operation=load_members&'+argms;
		}
		else{
		url='ClientsCtrl.php?operation=load_members';
		}
		//**TEMPO**/
		//url='ClientsCtrl.php?operation=load_members';
		//**TEMPO**/
		
	//alert(url);
	//alert(argms);
	//url=window.location.href+"?operation=load_members";
	//alert(window.location.href);
	}
	else
	{
	//url='ClientsCtrl.php?operation=load_members&'+argms;
	url='ClientsCtrl.php?operation=load_members&page='+a_Clicked.innerHTML;	
	}
	//***TEMPP***///
	//url='ClientsCtrl.php?operation=load_members';
	//***TEMPP***///
	formObject=document.getElementById('search_form');
		//alert(formObject);
	sendAJAXForm(url,members_Listing,formObject);
	change_Buttons_Properties(true) ;
}

function members_Listing(xhttp)
{
//main_div.style.opacity="1";
//change_Buttons_Cursor('pointer');
/*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*/
members_details.innerHTML=xhttp.responseText;
//members_details.innerText=xhttp.responseText;
/*members_count.innerHTML=xhttp.responseText;*/
/*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*//*TEMPORARY*/
button_search.value="Search members";
change_Buttons_Properties(false) ;
//button_search.disabled=false;

update_buttons=document.getElementsByTagName('input');
for(var i=0;i<update_buttons.length;i++){
	if(update_buttons[i].type=='submit')
	{
	update_buttons[i].addEventListener('click',update_Account_send_Email,false);
	}
}
a_Buttons=document.querySelectorAll('#div_limiter a');
for(i=0;i<a_Buttons.length;i++)
{
a_Buttons[i].addEventListener('click',a_Links_Buttons ,false);	
}
	delimiterRedirect();
}

function update_Account_send_Email(e)
{
	e.preventDefault();	

if(e.target.id!='button_search')
{
old_Button_Value=e.target.value;
button_ID=document.getElementById(e.target.id);
button_Chunks=e.target.id.split('_');
button_Num=e.target.id.split('_')[2];
button_ID.nextSibling.nextSibling.nextSibling.innerHTML='';	
		if(button_Chunks[1]=='account')
    	{
		button_ID.value='Updating...';
		//main_div.style.opacity="0.5";
		//change_Buttons_Cursor('no-drop');
    	url='ClientsCtrl.php?operation=update_account&button_id='+button_Num;
   	 	formObject=document.getElementById('form_'+button_Num);
    	sendAJAXForm(url,update_Account_Results,formObject) ;
		change_Buttons_Properties(true);
    	}
    	else if(button_Chunks[1]=='email')
    	{
        	if(!email_title.value || !/*email_plain*/email_html.value || !email_html.value)
	    	{
				button_ID.nextSibling.nextSibling.nextSibling.innerHTML=empty_email.innerHTML;
			}
			else
			{
    		button_ID.value='Sending Email...';
			//main_div.style.opacity="0.5";preventDefault
			//change_Buttons_Cursor('no-drop');
			
    		url='ClientsCtrl.php?operation=send_email&button_id='+button_Num;
    		formObject=document.getElementById('email_form');
    		sendAJAXForm(url,email_Sending,formObject) ;
    		sending_email=document.getElementById('sending_email_'+button_Num);
			change_Buttons_Properties(true);
			}
    	}
}
}

function update_Account_Results(xhttp,e)
{
	button_ID.nextSibling.nextSibling.nextSibling.innerHTML=xhttp.responseText;
	button_ID.value=old_Button_Value;
	change_Buttons_Properties(false);
	//main_div.style.opacity="1";
	//change_Buttons_Cursor('pointer');
}
function email_Sending(xhttp,e)
{
	button_ID.nextSibling.nextSibling.nextSibling.innerHTML=xhttp.responseText;
	button_ID.value=old_Button_Value;
	//main_div.style.opacity="1";
    //change_Buttons_Cursor('pointer');
	change_Buttons_Properties(false);
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

mform = new FormData(formObject);
 xhttp.send(mform);
}

function a_Links_Buttons(e) 
{
//e.preventDefault();	
a_Clicked=e.target;
list_Members(e);
}
//////////////////////////////////////////
//MAILER
//MAILER
//MAILER
//////////////////////////////////////////*
//////////////////////////////////////////
//MAILER
//MAILER
//MAILER
//////////////////////////////////////////
})();
