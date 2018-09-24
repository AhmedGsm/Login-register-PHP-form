<div id="div_mailer">
<form action='' method='post' id='email_form' enctype="multipart/form-data">
<label for="email_title" >Email title</label><br> 
<input type='text' title='Fill email title(subject)' size="25" id="email_title" name="email_title" value="<?php if(isset($_SESSION['email_title']))echo $_SESSION['email_title']?>" /><br>
<br><label for="email_html" >Email content in HTML</label><br> 
<textarea width="200" title='Fill email content in HTML format' name="email_html" id="email_html" height="200"></textarea><br>
<div id='email_tool_bar'>
<img src='mailer/attachment.png' id="load_attachment" title='Add attachment' />
<img src='mailer/picture.png' id="load_image" title='Insert image' />
</div>
<input type="file" id="attachment" name="attachment" multiple /><br>
<input type="file" id="images" accept="image/*" name="images" multiple /><br>
<input type='submit' title='Send email to all members that are registered in this web site' class='clients_buttons'  id='send_email_ALL' value='Send Email to all members' /><br>
<div id='sending_email_ALL'>
</div>
<div id="responses_results">

</div>
<!--<br><input type="submit" id="send_email" value="Send email"  /><br>-->
</form>
</div>