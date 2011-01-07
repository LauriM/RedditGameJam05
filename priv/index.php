<?php
$status = $napalmauth->user_auth_status();
$username = $napalmauth->user_name();

$lasthit = $napalmdata->getdata($username,"lasthit");
$napalmdata->setdata($username,"lasthit",time());
?>
<h1>PRIVATE REALM</h1>

<?php
echo("<p>Hi $username!<p/>");

$diff = time() - $lasthit;

echo("<p>Last hit $diff secs ago</p>");

$napalmauth->show_logout();

?>
<hr/>
<?php
$napalmauth->show_changepw();

switch($napalmauth->auth_status()){
    case 5:
        echo("Password changed!");
        break;
    case 6:
        echo("Password not changed! Check for incorrect passwords");
        break;
}
?>
<hr/>
