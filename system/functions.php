<?php 
function secure($string){
    return(mysql_real_escape_string($string));
}

?>
