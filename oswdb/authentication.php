<?php
$allUsers= array( "b45802","rmnv30", "ra9817");
                        
                        if (empty($_SERVER['REMOTE_USER'])){
                            echo "You seemed to be logged out, please close this window and log in again with your core ID."; 
                            exit();
                        } 
                        $user = $_SERVER['REMOTE_USER'];
                        if(FALSE === array_search($user, $allUsers)){
                             echo "You are not authorized to do this action. Please contact ra9817@freescale.com to get access."; 
                             exit();
                        } 
?> 