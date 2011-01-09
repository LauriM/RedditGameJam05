<html>
<head>
    <title>Rush for the hearts!</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="container">

<h1>Rush for the hearts!</h1>

<p>This is my entry to the RedditGameJam05!</p>

<p>It may not have the best gameplay because of the technical problems (ajax is not good for realtime games), but atleast I made game under 48 hours :P</p>

<p>Source code is avaivable on the <a href='https://github.com/k00pa/RedditGameJam05'>Github reporisitory</a></p>
<?php
switch($status){
    case 2:
        echo("<p>Account created!</p>");
        break;
    case 3:
        echo("<p>Problem while creating account</p>");
		$napalmauth->show_register();
		$hide = true;
        break;
    case 4:
        echo("<p>Logged out!</p>");
        break;
	case 7:
		echo("<p>Incorrect captha code</p>");
		$napalmauth->show_register();
		$hide = true;
		break;
	case 8:
		echo("<p>Incorrect username</p>");
		$napalmauth->show_register();
		$hide = true;
		break;
	case 9:
		echo("<p>Username already exist!</p>");
		$napalmauth->show_register();
		$hide = true;
		break;
	case 10:
		echo("<p>Too short password!<p>");
		$napalmauth->show_register();
		$hide = true;
		break;
}

if($hide == false){
	if($_GET['napalmauth'] <> "show_register"){
		$napalmauth->show_login();
	}else{
		$napalmauth->show_register();
	}
}

?>

<p>Register only asks for username and password! Nothing else is asked.</p>

</div>
</html>
