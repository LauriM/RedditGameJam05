<?php
session_start();
?>
<html>
<body>
<?php
include("config.php");
include("system/database.php");
include("system/functions.php");
include("system/napalmauth.class.php");
include("system/napalmdata.class.php");
include('system/recaptchalib.php');

$napalmauth = new NapalmAuth();
$napalmauth->init();

$napalmdata = new NapalmData();

$status = $napalmauth->user_process();

switch($napalmauth->auth_status()){
    case 0:
        include("publ/index.php");
        break;
    case 1:
        include("priv/index.php");
        break;
    case 2:
        include("publ/index.php");
        break;
    case 3:
        include("publ/index.php");
        break;
    case 4:
        include("publ/index.php");
        break;
    case 5:
        include("priv/index.php");
        break;
    case 6:
        include("priv/index.php");
        break;
	case 7:
		include("publ/index.php");
		break;
	case 8:
		include("publ/index.php");
		break;
	case 9:
		include("publ/index.php");
		break;
	case 10:
		include("publ/index.php");
		break;
}

$napalmauth->debug();
?>
</body>
</html>
