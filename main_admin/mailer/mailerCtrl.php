<?php
session_start();
//$_SESSION["attachments_files"]='';
//$_POST['buffer']='I am a file content';
//$ini_post_max_size=ini_get('post_max_size');
//upload_max_filesize
//$post_max_size=preg_match('#^([0-9.]+)([kmgtpezy]?)#i', $ini_post_max_size, $matches,PREG_OFFSET_CAPTURE );
//$var="";
//var_dump( $ini_post_max_size );
//var_dump( $var );
//var_dump( $matches );
//var_dump( $matches );
//ini_set('upload_max_filesize','20M');
/*
$subject = "abcdef";
//$subject = "kjdef";
$pattern = '/^def/';
$subject=substr($subject,3);
//var_dump(subject);
preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE,0);
//preg_match($pattern, substr($subject,3), $matches, PREG_OFFSET_CAPTURE);
//var_dump($matches);*/


$attachment_max_size=10000000;

if(!is_dir('uploads/'))
{
mkdir('uploads/');
}
if(!is_dir('images/'))
{
mkdir('images/');
}
//var_dump($_FILES['attachment']['error']);
//var_dump($_FILES);
//var_dump(ini_get('post_max_size'));
//var_dump(post_max_size);
/*TEMPO*******/
if(isset($_GET['path']))
{
$upload_path=htmlspecialchars($_GET['path']);
$upload_path.="/";
//var_dump($upload_path);
}
/*TEMPO***********/

//var_dump($_GET);
if(isset($_GET['operation']) /*AND  isset($_GET['attachment'])*/)
{
	$operation=htmlspecialchars($_GET['operation'] );
	$attachment_name=htmlspecialchars($_GET['attachment'] );
$attachment_file="uploads/".$attachment_name;
switch($operation)
{
	case 'delete_attachment':
		if(file_exists($attachment_file))
		{
		$delete_state=unlink($attachment_file) ;
		}
		
	break;

}
}elseif($_FILES){

//var_dump($_POST);
// check if no error occures xhen uploading file
//echo $_FILES['attachment']['error'];l
	if(isset($_FILES['attachment']) AND $_FILES['attachment']['error']==0)
	{
	$tmp_file=$_FILES['attachment']['tmp_name'];
	$file_base_name= basename($_FILES['attachment']['name']);
	// $base_name=$_FILES['attachment'][''];
	$file_path=$upload_path.$file_base_name;
	//var_dump($file_name);
	//Check file size
	if(!file_exists($file_path))
	{	
        if($_FILES['attachment']['size']<=$attachment_max_size)
		{
			$move_state=move_uploaded_file($tmp_file,$file_path);
	    	if($move_state)
			{
			echo '<span class="upload_success">Upload success</span>';	
			//add file name to list in session
			//	 $add_attachment_path=true;
			//echo $_SESSION['attachments_files'] ;
			 
			
			}
			else
			{
			echo '<span class="upload_fail">Upload failed</span>';	
			}
		}
		else
		{
		echo '<span class="upload_fail">File sizy</span>';	
		}
	}
	else
	{
	echo	'<span class="upload_fail">File already uploaded</span>';
	//$add_attachment_path=true;
	}
	}
	elseif(isset($_FILES['attachment']) AND $_FILES['attachment']['error']!=0)
	{
		switch($_FILES['attachment']['error'])
		{
			case UPLOAD_ERR_INI_SIZE:
			echo '<span class="upload_fail">File size exeeded</span>';
			break;
			case UPLOAD_ERR_FORM_SIZE:
			echo '<span class="upload_fail">File size exeeded</span>';
			break;
			case UPLOAD_ERR_PARTIAL:
			echo '<span class="upload_fail">File not fully uploaded</span>';
			break;
			case UPLOAD_ERR_NO_FILE:
			echo '<span class="upload_fail">Not file uploaded</span>';
			break;
			case UPLOAD_ERR_NO_TMP_DIR:
			echo '<span class="upload_fail">No upload folder found</span> ';
			break;
			case UPLOAD_ERR_CANT_WRITE:
			echo '<span class="upload_fail">Fail to write file on disk</span> ';
			break;
			case UPLOAD_ERR_EXTENSION:
			echo '<span class="upload_fail">Wrong file extension</span>';
			break;
			default:
			echo '<span class="upload_fail">Upload failed</span>';
		}
	//echo 'Upload failed';		
	}
}
elseif(empty($_FILES))
{
echo '<span class="upload_fail">Big file size</span>';			
}

/*if(isset($add_attachment_path))
{
	if($upload_path=='uploads')		    
	{
		if( !isset( $_SESSION['attachments_files'] ))
		{
			    $_SESSION['attachments_files']= $file_path ;
		}
		else
		{
			if(empty( $_SESSION['attachments_files'] ))
			{
			$_SESSION['attachments_files']= $file_path ;
			
			}
			else{
			$_SESSION['attachments_files'].= ",".$file_path ;
			}
		}
	}
}*/
?>