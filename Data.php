<?php
//
//TABLES
$Registration_Table="dj_members";
$Option_Table="dj_options";
$Admin_Table="dj_admins";
$HTMLElement_Table="dj_form";
//Pass salts
$pass_merge='Lw?#:[wHLoNh\;E';
$admin_pass_merge='&7W!)#A7C!@{6]^';
//Identification salts
$identRegistration="`7p^,Y!Mx5%0#bd";
$identActivation="Z+#,J?TyjR!fA%s";
$identBan="2E/Y(#pv8(rh`3";
$identAdmin="j)e&>4`;BMD%{-";
//merges
$urlMergeRegistration="Y,yCx3A\0SAET~v";
$urlMergeRecovery="!e(:é!w*/+-|^@&";
$urlMergeLogin="bsJP-P{Zot.KQ@P";
$urlMergeLogout="S<r+J6lI^>b+CES";

//Session
////////////// 


if( /*file_exists("../Config.php") OR*/ file_exists("Config.php"))
{
include_once('classes/Table.Class.php');
$dj_table=new dj_table($Option_Table);
$all_data=$dj_table->Read_Table_Data("*","");
$client_session_time=$all_data[4]["option_content"];
$admin_session_time=$all_data[5]["option_content"];
$session_Life=$client_session_time*60;
$admin_Session_Life=$admin_session_time*60;
}

///////////
//Cookies
$cookie_life=time()+3600*60*24*10;


$memberTable="CREATE TABLE IF NOT EXISTS `$Registration_Table`(
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `age` text NOT NULL,
  `birth_date` text NOT NULL,
  `gender` text NOT NULL,
  `pseudonym` text NOT NULL,
  `email` text NOT NULL,
  `telephone` text NOT NULL,
  `country` text NOT NULL,
  `address` text NOT NULL,
  `post_code` text NOT NULL,
  `paypal` text NOT NULL,
  `credit_card` text NOT NULL,
  `CSV` text NOT NULL,
  `time_zone` text NOT NULL,
  `register_date` text NOT NULL,
  `imprint` text NOT NULL,
  `ident` text NOT NULL,
  `merge` text NOT NULL,
  `hash_type` text NOT NULL,
  `account` int(11) NOT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1";

$adminTable="CREATE TABLE IF NOT EXISTS `$Admin_Table`(
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `pseudonym` text NOT NULL,
  `email` text NOT NULL,
  `role` text NOT NULL,
  `register_date` text NOT NULL,
  `imprint` text NOT NULL,
  `ident` text NOT NULL,
  `merge` text NOT NULL,
  `hash_type` text NOT NULL,
  `account` int(11) NOT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1";

$optionsTable="CREATE TABLE IF NOT EXISTS `$Option_Table`(
  `id_option` int(11) NOT NULL AUTO_INCREMENT,
  `option` text NOT NULL,
  `option_content` text NOT NULL,
  PRIMARY KEY (`id_option`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1";


$elementsTable="CREATE TABLE IF NOT EXISTS `$HTMLElement_Table`(
  `id_element` int(11) NOT NULL AUTO_INCREMENT,
  `element_name` text NOT NULL,
  `label` text NOT NULL,
  `regex` text NOT NULL,
  `right_message` text NOT NULL,
  `wrong_message` text NOT NULL,
  `double_message` text NOT NULL,
  `display` text NOT NULL,
  PRIMARY KEY (`id_element`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1";

//Insertion
$insertOptionsTable="TRUNCATE TABLE `$Option_Table` ; INSERT INTO `$Option_Table`(`id_option`, `option`, `option_content`) VALUES
(1, 'emailer', \"\narray('Sender' =>'My web site',	\n'From' =>'no-reply@gmail.com',\n'Reply' =>'replyto@gmail.com',\n'Cc_Email' =>'ccEmail@gmail.com',\n'Bcc_Email' =>'BccEmail@gmail.com',\n'Activation_Message' =>'Thanks you for registering on our server, to activate your account click on link below:',\n);\"),
(2, 'hash_type', '1'),
(3, 'login_page', 'count.php'),
(4, 'logout_page', 'login.php'),
(5, 'client_session', '60'),
(6, 'admin_session', '60'),
(7, 'label_conditions', 'Tick box to accept general conditions,&lt;br&gt; visit &lt;a href=&quot;policy.php&quot;&gt;policy &lt;/a&gt;page for more details'),
(8, 'login_with', 'user_name')";



$insertElementsTable="TRUNCATE TABLE `$HTMLElement_Table` ; INSERT INTO `$HTMLElement_Table` (`id_element`, `element_name`, `label`, `regex`, `right_message`, `wrong_message`, `double_message`, `display`) VALUES
(1, 'first_name', 'First name', '^[a-zA-Z]{2,20}$', '', 'Must contains 2 minimum letters ', '', 'NO'),
(2, 'last_name', 'Last name', '^[a-zA-Z]{2,20}$', '', 'Must contains 2 minimum letters ', '', 'NO'),
(3, 'age', 'Age', '^[0-9]{1,3}$', '', 'Age must contains only numbers', '', 'NO'),
(4, 'birth_date', 'Birth date', '', '', 'Select birth date', '', 'NO'),
(5, 'gender', 'Gender', '', '', 'Select your gender', '', 'NO'),
(6, 'pseudonym', 'User name', '^[a-zA-Z]{5,20}[0-9]{0,20}$', '', 'Must contains 5 alpabetics letters or alphanumerics', 'User name already exists, select other one', 'YES'),
(7, 'email', 'Email', '^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}.[a-zA-Z]{2,4}$', '', 'Must be like: &quot;MobileEmailer@gmail.com&quot;', 'Email already exists, select other one', 'YES'),
(8, 'telephone ', 'Telephone ', '^[0-9]{8,20}$', '', 'Must contains 8 numbers minimally with no others characters', '', 'NO'),
(9, 'country', 'Country ', '', '', 'Select country', '', 'NO'),
(10, 'address', 'Full Address', '^[a-zA-Z0-9, -.]{10,500}$', '', 'Must contains 10 minimum alphanumerics ', '', 'NO'),
(11, 'post_code', 'Post code', '^[0-9]{5,15}$', '', 'Must 5 to 15 numbers', '', 'NO'),
(12, 'paypal', 'PayPal address', '^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}.[a-zA-Z]{2,4}$', '', 'Must be like: &quot;MobileEmailer@gmail.com&quot;', '', 'NO'),
(13, 'credit_credit', 'Credit card number', '^([0-9]{4})([ -][0-9]{4}){3}$', '', 'Must be like this format is:xxxx-xxxx-xxxx-xxxx', '', 'NO'),
(14, 'Card Security code', 'Card Security code', '^[0-9]{3}$', '', 'Wrong security code, must have 3 numbers', '', 'NO'),
(15, 'Password ', 'Password ', '^.{6,}$', '', 'Must be 6 minimum characters and numbers', '', 'YES'),
(16, 'password_verification', 'Password verification', '', '', 'Password verification is different from password', '', 'YES'),
(17, 'time_zone', 'Time zone', '', '', 'Select time zone', '', 'NO'),
(18, 'captcha', 'Captcha ', '', '', 'Incorrect code introduced', '', 'YES'),
(19, 'conditions', 'Conditions', '', '', 'Tick box if you accept web site conditions &amp; policy ', '', 'NO')";

$coutries_list=array(
     "Afghanistan",     "Albania",     "Algeria",     "Andorra", 
     "Angola",     "Antigua and Barbuda",     "Argentina",     "Armenia",
     "Aruba",     "Australia",     "Austria",     "Azerbaijan",
     "Bahamas",	 "Bahrain",     "Bangladesh",     "Barbados",
     "Belarus",    "Belgium",     "Belize",     "Benin",
     "Bhutan",     "Bolivia",     "Bosnia and Herzegovina",     "Botswana",
     "Brazil",     "Brunei",     "Bulgaria",     "Burkina Faso",
     "Burma",     "Burundi",     "Cambodia",     "Cameroon",
     "Canada",     "Cape Verde",     "Central African Republic",     "Chad",
     "Chile",     "China",     "Colombia",     "Comoros",     "Congo",
	 "Democratic Republic of the Congo",       "Republic of the Costa Rica",
     "Ivory costs",     "Croatia",     "Cuba",     "Curacao",     "Cyprus",
     "Czech Republic",     "Denmark",     "Djibouti",     "Dominica",
     "Dominican Republic",	  "East Timor", "Ecuador", "Egypt", "El Salvador",
     "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia",     "Fiji",
     "Finland",     "France",     "Gabon",     "Gambia",	 "Georgia",
     "Germany",     "Ghana",     "Greece",     "Grenada",     "Guatemala",
     "Guinea",     "Guinea-Bissau",     "Guyana",     "Haiti",
     "Holy See",     "Honduras",     "Hong Kong",     "Hungary",
     "Iceland",     "India",     "Indonesia",     "Iran",
     "Iraq",     "Ireland",     "Israel",     "Italy",
     "Jamaica",     "Japan",     "Jordan",     "Kazakhstan",
     "Kenya",     "Kiribati",     "Korea North",     "Korea South",
     "Kosovo",     "Kuwait",     "Kyrgyzstan",     "Laos",
     "Latvia",     "Lebanon",     "Lesotho",     "Liberia",
     "Libya",     "Liechtenstein",     "Lithuania",     "Luxembourg",
	 "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia",
     "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania",
     "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco",
     "Mongolia", "Montenegro", "Morocco", "Mozambique",
     "Namibia",     "Nauru",     "Nepal",     "Netherlands",
     "Netherlands Antilles",     "New Zealand",     "Nicaragua",
     "Niger",     "Nigeria",     "North Korea",     "Norway",
	 "Oman",     "Pakistan",     "Palau",     "Palestine",
     "Panama",     "Papua New Guinea",     "Paraguay",
     "Peru",     "Philippines",     "Poland",     "Portugal",
	 "Qatar",     "Romania",     "Russia",     "Rwanda",
     "Saint Kitts and Nevis",     "Saint Lucia",     "Saint Vincent and the Grenadines",
     "Samoa",     "San Marino",     "Sao Tome and Principe",     "Saudi Arabia",
     "Senegal",     "Serbia",     "Seychelles",     "Sierra Leone",
     "Singapore",     "Sint Maarten",     "Slovakia",     "Slovenia",
     "Solomon Islands",     "Somalia",     "South Africa",     "South Korea",
     "South Sudan",     "Spain",     "Sri Lanka",     "Sudan",
     "Suriname",     "Swaziland",     "Sweden",     "Switzerland",
     "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand",
     "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia",
     "Turkey", "Turkmenistan", "Tuvalu",     "Uganda",     "Ukraine",
     "United Arab Emirates",     "United Kingdom",     "Uruguay",
     "Uzbekistan",     "Vanuatu",     "Venezuela",     "Vietnam",
     "Yemen",     "Zambia",     "Zimbabwe");

$months=array("January","February","March","April","May","June","July","August","September","October","November","December");

$time_zone_list=array("(GMT -12:00) Eniwetok",
"(GMT -11:00) Midway Island",
"(GMT -10:00) Hawaii",
"(GMT -9:00) Alaska",
"(GMT -8:00) Pacific Time ",
"(GMT -7:00) Mountain Time ",
"(GMT -6:00) Central Time ",
"(GMT -5:00) Eastern Time ",
"(GMT -4:30) Caracas",
"(GMT -4:00) Atlantic Time (Canada)",
"(GMT -3:30) Newfoundland",
"(GMT -3:00) Brazil, Buenos Aires",
"(GMT -2:00) Mid-Atlantic",
"(GMT) Western Europe Time",
"(GMT +1:00 hour) Brussels",
"(GMT +2:00) Kaliningrad",
"(GMT +3:00) Baghdad, Riyadh",
"(GMT +3:30) Tehran",
"(GMT +4:00) Abu Dhabi, Muscat",
"(GMT +4:30) Kabul",
"(GMT +5:00) Ekaterinburg, Islamabad",
"(GMT +5:30) Mumbai, Kolkata",
"(GMT +5:45) Kathmandu",
"(GMT +6:00) Almaty, Dhaka",
"(GMT +6:30) Yangon, Cocos Islands",
"(GMT +7:00) Bangkok, Hanoi",
"(GMT +8:00) Beijing, Perth",
"(GMT +9:00) Tokyo, Seoul",
"(GMT +9:30) Adelaide, Darwin",
"(GMT +10:00) Eastern Australia",
"(GMT +11:00) Magadan, Solomon Islands",
"(GMT +12:00) Auckland, Wellington");
?>