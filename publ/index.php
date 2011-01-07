<h1>PUBLIC ReALM!</h1>

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
