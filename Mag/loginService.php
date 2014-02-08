<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function authenticate ($username, $password){
    $authentic_users = array("admin"=> "admin", "user1" => "user1");
    if(FALSE === array_key_exists($username, $authentic_users)){
        return FALSE;
    }else{
        if($authentic_users[$username] == $password){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>
