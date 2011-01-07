<?php
class NapalmData{
    public function getdata($owner,$variable){
        $owner = secure($owner);
        $variable = secure($variable);
        $result = query("SELECT value FROM data WHERE owner = '$owner' AND variable = '$variable'");
        $count = mysql_num_rows($result);

        if($count == 1){
            return(mysql_result($result,0,"value"));
        }else{
            return(0);
        }

    }

    public function setdata($owner,$variable,$value){
        $owner = secure($owner);
        $variable = secure($variable);
        $value = secure($value);

        $result = query("SELECT value FROM data WHERE owner = '$owner' AND variable = '$variable'");
        $count = mysql_num_rows($result);

        if($count == 1){
            query("UPDATE data SET value = '$value' WHERE owner = '$owner' AND variable = '$variable'");
        }else{
            query("INSERT INTO data(owner,variable,value) VALUES('$owner','$variable','$value')");
        }
    }
}

?>
