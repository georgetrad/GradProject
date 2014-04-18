<?php
include 'db_connect.php';
/** 
 * This class contains Database related functions for (SELECT, INSERT, UPDATE) queries.
 * @author George Trad
 */
class databaseClass {
    /**
     * This method accepts two parameters to log the user in
     * @param string $username
     * @param string $password
     * @return boolean: false if the username and/or password are invalid.
     * @return boolean user_type (A: Admin, U: User)
     */
    public static function login($username, $password){
        $password_hash	= md5($password);   //Decrypting the MD5 encrypted password.        
        $query = "SELECT user_id, username, type FROM user WHERE username='".mysql_real_escape_string($username)."' AND password='".mysql_real_escape_string($password_hash)."'";
        $queryRun = mysql_query($query);        
        if($queryRun){
            $queryNumRows = mysql_num_rows($queryRun);
            if($queryNumRows == 0){
                $response = array(
                    "success"   => false
                );                
            }
            else if($queryNumRows == 1){                        
                $userId = mysql_result($queryRun, 0, 'user_id');
                $userType = mysql_result($queryRun, 0, 'type');                
                $response = array(
                    "success"   => true,
                    "userId"    => $userId,
                    "userType"  => $userType
                );                
            }
            return $response;
        }		
    }
}