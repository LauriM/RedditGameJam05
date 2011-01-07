<?php

class NapalmAuth{
    private $user_name = "";
    private $user_pass = "";
    private $user_auth_done = 0;
    //0  = not authed
    //1  = logged in
    //2  = new account registered
    //3  = creating new account failed
    //4  = logout
    //5  = password changed
    //6  = password change FAILED
	//7  = incorrect captha
	//8  = invalid username
	//9  = username already exist
	//10 = too short password
	private $recaptha_enable;
	private $recaptha_public;
	private $recaptha_private;

    public function init(){
        $this->user_name = $_SESSION['username'];
        $this->user_pass = $_SESSION['password'];

		$this->recaptha_enable  = false;
		$this->recaptha_public  = "";
		$this->recaptha_private = "";
    }

    public function test(){
        echo("NapalmAuth Working!");
    }

    public function auth_status(){
        return($this->user_auth_done);
    }

	public function recaptha_enable($public,$private){
		$this->recaptha_enable  = true;
		$this->recaptha_public  = $public;
		$this->recaptha_private = $private;
	}

    public function api_auth(){
        $user_name = $_POST['username'];
        $user_pass = md5($_POST['password']);

        if($user_name == ""){
            $user_name = $_GET['username'];
            $user_pass = md5($_GET['password']);
        }

        $result = query("SELECT * FROM users WHERE username = '$user_name' AND password = '$user_pass'");
        if(mysql_num_rows($result) == 1){
            $user_auth_done = 1;
        }

        return $user_auth_done;
    }

    public function user_process(){
        if($_GET['napalmauth'] == "login"){
            $this->user_name = secure($_POST['username']);
            $this->user_pass = md5($_POST['password']);

            $_SESSION['username'] = $this->user_name;
            $_SESSION['password'] = $this->user_pass;

        }

        if($_GET['napalmauth'] == "register"){

            $username = secure($_POST['username']);
            $password = $_POST['password'];
            
            if($this->recaptha_enable == true){
                $resp = recaptcha_check_answer ($this->recaptha_private,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
            }

			if(!$resp->is_valid AND $this->recaptha_enable == true){
				$this->user_auth_done = 7;
			}else{
				$result = query("SELECT * FROM users WHERE username = '$username'");

				if(preg_match('/^[a-zA-Z0-9]+$/',$username) == false){
					$invalid_name = true;
				}

				if($username <> $_POST['username']){
					$invalid_name = true;
				}

				if(strlen($username) < 4 OR strlen($username) > 21){
					$invalid_name = true;
				}

				if(strlen($password) < 6){
					$invalid_password = true;
				}

				if(mysql_num_rows($result) == 0 AND $username <> "" AND $invalid_password == false AND $invalid_name == false){
					$hash = md5($password);
					query("INSERT INTO users(username,password) VALUES('$username','$hash');");
					$this->user_auth_done = 2;
				}else{
					$this->user_auth_done = 3;

					if($invalid_name == true){
						$this->user_auth_done = 8;
					}

					if(mysql_num_rows($result) > 0){
						$this->user_auth_done = 9;
					}

					if($invalid_password == true){
						$this->user_auth_done = 10;
					}
				}
			}
        }

        $var1 = $this->user_name;
        $var2 = $this->user_pass;

        $result = query("SELECT * FROM users WHERE username = '$var1' AND password = '$var2'");
        if(mysql_num_rows($result) == 1){
            $this->user_auth_done = 1;
        }

        if($_GET['napalmauth'] == "changepw"){
            $old = md5($_POST['oldpw']);
            $pw1 = md5($_POST['pw1']);
            $pw2 = md5($_POST['pw2']);

            $result = query("SELECT * FROM users WHERE username = '$var1' AND password = '$old'",1); //$var1 stolen from above
            $count  = mysql_num_rows($result);
            
            if($count == 1){
                if($pw1 == $pw2){
                    query("UPDATE users SET password = '$pw1' WHERE username = '$var1'");

                    $this->user_pass = $pw1; //to make sure user wont be kicked out
                    $_SESSION['password'] = $this->user_pass;

                    $this->user_auth_done = 5;
                }else{
                    $this->user_auth_done = 6;
                }
            }else{
                $this->user_auth_done = 6;
            }
        }

        //last so it wont "relog" user in after logout with the php vars
        if($_GET['napalmauth'] == "logout"){
            session_destroy();
            $this->user_auth_done= 4;
        }

        return $this->user_auth_done;
    }

    public function user_auth_status(){
        return $this->user_auth_done;
    }

    public function user_name(){
        return $this->user_name;
    }

    public function show_login(){
        echo("<h3>Login!</h3>");
        echo("<form action='index.php?napalmauth=login' method='POST'>");
        echo("<input type='text' name='username'>");
        echo("<input type='password' name='password'>");
        echo("<input type='submit' value='login'>");
        echo("</form>");
        echo("<p><a href='index.php?napalmauth=show_register'>Register!</a></p>");
    }

    public function show_register(){
        echo("<h3>Register here</h3>");
        echo("<form action='index.php?napalmauth=register' method='POST'>");
        echo("<input type='text' name='username'>");
        echo("<input type='password' name='password'>");
        echo("<input type='submit' value='register'>");
        echo("<p><a href='index.php'>Login!</a></p>");
		if($this->recaptha_enable == true){
			echo recaptcha_get_html($this->recaptha_public);
		}
        echo("</form>");
    }

    public function show_changepw(){
        echo("<h3>Change password</h3>");
        echo("<form action='index.php?napalmauth=changepw' method='POST'>");
        echo("<input type='password' name='oldpw'/>");
        echo("<input type='password' name='pw1'/>");
        echo("<input type='password' name='pw2'/>");
        echo("<input type='submit' value='Change'/>");
        echo("</form>");
    }

    public function show_logout(){
        echo("<a href='index.php?napalmauth=logout'>Logout</a>");
    }

    public function debug(){
        echo("<hr/>");
        echo("user_name: $this->user_name<br/>");
        echo("user_pass: $this->user_pass<br/>");
        echo("user_auth_done: $this->user_auth_done<br/>");
        echo("ses_user_name: ".$_SESSION['username']."<br/>");
        echo("ses_user_pass: ".$_SESSION['password']."<br/>");
        echo("<hr/>");
    }

};
?>
