
var attach,attachment = document.getElementById('attachment'),
 imgs = document.getElementById('images'),
 upl_results = document.querySelector('#responses_results'),
 progress_bar = document.querySelector('#progress_bar'),
 email_body = document.getElementById('email_html'),
 upload_form = document.querySelector('#upload_form'),
load_attachment=document.getElementById('load_attachment'),
load_image=document.getElementById('load_image');

load_attachment.addEventListener('click',function(){
	attachment.click();
	//alert('attachment.clicked');
},false);
load_image.addEventListener('click',function(){
	imgs.click();
	//alert('attachment.clicked');
},false);

 var div_progress, response_label, delete_icon, delete_imgs, file_names_array =[], j=0,  file_number=0 ;
attachment.onchange = upload_file;
imgs.onchange = upload_file;
var upload_path;

	  // email_body.value="<img src=''";
function upload_file(e)
{
	//alert(e.target.id);
	attach=e.target;
//upl_results.innerHTML+="Uploading file, please wait...";
//progress_bar.value=0;
//alert(file_number);
var  filesent = create_Progress_Div(file_number);
//alert( filesent );
if(!filesent)
{
	if(attach.id=="images")
	{
	upload_path="images";
	//alert(file_number);
	
	}
	else if(attach.id=="attachment")
	{
	upload_path="uploads";
	}
sendAJAXAttachment("mailer/mailerCtrl.php?path="+upload_path,upload_results,file_number);
file_number++;
//alert('ppp !');
	}
	else{
	file_number++;
	upload_results(0);
	}
	
	
}

function upload_results(xhttp)
{
	//upl_results.innerHTML+=xhttp.responseText; .
	if(xhttp!=0)
	{
	 	response_label.innerHTML=xhttp.responseText;
		if(upload_path=='uploads')
		{
		delete_icon=document.createElement('img');
		delete_icon.src='mailer/cross.png';
		delete_icon.title='Delete attachment';
		//delete_icon.style.display='none';
		//	delete_icon.src='error.png';	
		response_label.appendChild(delete_icon);
		delete_imgs=document.querySelectorAll("#responses_results div img");
	        for(var i=0;i< delete_imgs.length;i++)
	        {
		    delete_imgs[i].style.display='none';
	        }
	    }
	}
//	responseNode=createTextNode( xhttp.responseText );
	 //div_progress.insertBefore( delete_icon, responseNode );
	//div_progress.innerHTML+="<img alt ='' title='Delete attachment' src='error.png/>";
	//alert(attachment.files[file_number])
	if(attach.files[file_number]!==undefined)
	{
	var  filesent = create_Progress_Div(file_number);
	   if(!filesent)
	   {
	   sendAJAXAttachment("mailer/mailerCtrl.php?path="+upload_path,upload_results,file_number);
	   file_number++;
	   }
	   else{
	   file_number++;
	   upload_results(0);
	   }
	   //email_body.value="<img src=''";
	  // email_body.innerHTML="<img src=''";
		/*if(attachment.id=="images")
		{
		//image_name=attachment.id.parentNode.firstChild.innerText;
		image_name=attachment.files[file_number].name;
	    email_body.value+="<img src='images/"+image_name+"'/>";
	    // email_body.value+="<img src=images";
		}*/
	}
	else
	{
	delete_imgs=document.querySelectorAll("#responses_results div img");
		//alert(progress_divs);
		for(var i=0;i< delete_imgs.length;i++)
		{
		/*delete_icon[i]=document.createElement('img');
		delete_icon[i].src='error.png';
		delete_icon[i].title='Delete attachment';
		delete_icon[i].src='error.png';
		progress_divs[i].appendChild(delete_icon[i]);	
		//alert(progress_divs[i].innerText); 
		*/
		for( var j=0;j< delete_imgs.length;j++)
		{
		delete_imgs[j].style.display='inline';
		}
	    delete_imgs[i].addEventListener('click',function(e){
		attachment_name=e.target.parentNode.parentNode.firstChild.innerText;
			//alert(attachment_name);
			
		//	alert("dd");
		for(var j=0;j< delete_imgs.length;j++)
		{
		delete_imgs[j].style.display='none';
		}
  	  	delete_Attachment(attachment_name,e);
  	 
		},false);
		/*
		if(attachment.id=="images")
		{
		//image_name=attachment.id.parentNode.firstChild.innerText;
		image_name=attachment.files[i].name;
	    email_body.value+="<img src='images/"+image_name+"'/>";
	    // email_body.value+="<img src=images";
		}
		*/
		}
		file_number=0;
	/*
	delete_icon.addEventListener('click',function(){
	attachment_name=e.target.parentNode.firstChild.firstChild.innerText;
	alert(attachment_name);
	delete_Attachment(attachment_name);
},false);
*/		
    //message.value="<img src=''";
	}
	
	
}



function create_Progress_Div(progress_Div_number)
{
	 //attach.files[progress_Div_number];
	 // 	 alert(progress_Div_number);
	 	// alert(attach.files.length);
	  //	 alert(attach.files[progress_Div_number]);
         
	 file_name=attach.files[progress_Div_number].name;
	// alert(file_name);
	// image_name=attachment.files[file_number].name;
	if(attach.id=="images")
	{
	email_body.value+="<img src='images/"+file_name+"' />\r";
	}else if( attach.id=="attachment" )
	{
	 email_body.value+="<embed src='uploads/"+file_name+"' />\r"; 
	}
	//alert(file_names_array.indexOf(file_name));
	if(file_names_array.indexOf(file_name)==-1)
	{
	div_progress=document.createElement('div');
	file_name_label=document.createElement('label');
	response_label=document.createElement('label');
	file_name_label.innerHTML=attach.files[progress_Div_number].name;
	progressBar=document.createElement('progress');
	div_progress.appendChild(file_name_label);
	div_progress.appendChild(progressBar);
	div_progress.appendChild(response_label);
	responses_results.appendChild(div_progress);
	file_names_array[j]=file_name;
  	j++;
  	filesent=false;
	 }
	 else
	 {
	 alert('File "'+file_name+'": already uploaded');
	 filesent=true;
	 }
	// file_number++;
return filesent ;
}

function sendAJAXAttachment(url,cfunc,file_num) 
{
	var xhttp;

	xhttp=new XMLHttpRequest();
	xhttp.open("POST", url);
	
	xhttp.upload.onprogress=function(event){
	progressBar.value=event.loaded;
	progressBar.max=event.total;
	}

	xhttp.onreadystatechange = function() 
	{
    	if (xhttp.readyState == 4 && (xhttp.status == 200 ||  xhttp.status == 0  ))
    	{
    	cfunc(xhttp);
    	}
	}

	mform = new FormData();
	//mform.append('attachment',attachment.files[0]);
	mform.append('attachment',attach.files[file_num]);
	//mform.append('attachment',attachment.files[2]);
	xhttp.send(mform);
}

function delete_Attachment(attachment_name,e) 
{
	getAJAXResponse("mailer/mailerCtrl.php?operation=delete_attachment&attachment="+attachment_name, delete_Attachment_Response) ;
	e.target.parentNode.parentNode.style.display='none';
	file_index=file_names_array.indexOf(attachment_name);
	delete file_names_array[file_index];
			
}

function delete_Attachment_Response(xhttp,e)
{
	//alert("Attachment deleted");
	//alert(xhttp.responseText);
	//upl_results.innerHTML+=xhttp.responseText;
  
    for(j=0;j< delete_imgs.length;j++)
    {
    delete_imgs[j].style.display='inline';
    //alert('k');
    }
	 
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
