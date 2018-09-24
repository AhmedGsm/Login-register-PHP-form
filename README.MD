Script definition:
This script installed when need to implement a clients registration system like: first name....
Interfaces of script:	
There are two part client and Admin: 
Script advantages :
-Easy installation with no php files edition needed
-Password hashed with salts	
-Multi hash types
-Protection from XSS, SQL Injection, SPRF


Client interface pages:
Register,email verification & activation, sign in, password recovery,count(after success sign in) and logout(sign out)
Optionally empty pages added: index, services, Faq, contact
Template added  with: header, menu, main body, footer	
Client pages details:
Register.php:
Multi field contained first name, last name,...
Fields verified dynamically without submitting or reloading page when keyboard key is pressed
Fields  verification from server after submitting.
Error messages when field is incorrect.
User name and email verification if already exists on database when a key is pressed
Anti spam protection with Captcha that rands and verify characters from server
Send link to email to activate account and verify that email
Email verification and account activation:
Accunt activation with one click link on email
Message after success or failed activation 
Message if account already activated
Activation automatically blocked with error message if count is unknown state or banned from administrator 

Sign in(log in):
Log in with email or user name(pseudonym) with validity verification
Save identifier and password in cookie
Error messages 
Redirection to count.php by default or page that set in administrator interface.
Server verification
Password recovery:
Check email if registered on database.
Check if password verification equal to new password
Send email that contains link that updates password.
Count:
Access to client informations from database with sessions:
Sign out (Logout):
Redirection to main page that's adjusted in admin interface
Destroy session variables.	
Administrator interface pages:
Script installation & admin register,sign in, password recovery,main admin(after success sign in) and  log out,form edition, clients operations, general settings, log out
Script installation & admin register:
Register config file
Register script tables on database
Register administrator with email and user name.
Form edition:
Edit client register form elements:
Label
Error messages on wrong format
Messages on right format(optional)
Message when both email and user name exists on database
Hide or display form elements
Clients operations:
-Search members by email or pseudo or name
-Listing by id,email,.....
-Normal listing or reverse
-Display member details(id,email,pseudo,name,count state...)
-Send emails(newsletter) to one or all members
-Count operations(activate, ban, deactivate)
General settings:
Edit:
-Email header(from,cc_email,bcc_email,)
-Password hash type,
-Client and admin session time
-Page to access after success log in
-Page to return when log out
