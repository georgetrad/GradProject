<?php
include_once '../core.php';
include_once '../db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importFunction.php';
/**  
 * * This class contains Database related functions for (SELECT, INSERT, UPDATE, DELETE) queries.
 */
class databaseClass {
    /**
     * @author George Trad
     * This method accepts two parameters to log the user in.
     * @param string $username
     * @param string $password
     * @return array: false if the username and/or password are invalid.
     * @return array: true and user information (A: Admin, U: User)     
     */
    public static function logIn($username, $password){
        $password_hash	= md5($password);   //Decrypting the MD5 encrypted password.        
        // mySQL query
        $query = "SELECT user_id, username, level FROM user WHERE username='".mysql_real_escape_string($username)."' AND password='".mysql_real_escape_string($password_hash)."' AND active = 'A'";
        $queryRun = mysql_query($query);        
        if($queryRun){
            $queryNumRows = mysql_num_rows($queryRun);
            if($queryNumRows == 0){
                $response = array(
                    'success'   => false
                );                
            }
            else if($queryNumRows == 1){
                $userId = mysql_result($queryRun, 0, 'user_id');
                $username = mysql_result($queryRun, 0, 'username');
                $userLevel = mysql_result($queryRun, 0, 'level');                                
                $response = array(
                    'success'   => true,
                    'username'  => $username,
                    'userId'    => $userId,
                    'userLevel'  => $userLevel                    
                );                
            }
            return $response;
        }
    }        
    /**
     * This function inserts/removes to/from sugg_course table.
     * @author George Trad
     * @param String $action
     * @param String $courseCode
     * @param Integer $userId
     */
    public static function suggCourse($action, $courseCode, $userId){
        if($action == 'add'){
            $semester = $_SESSION['semester'];
            $cols = array('course_id', 'semester_id', 'active', 'create_date', 'user_id');            
            $values = array("'$courseCode'", $semester, "'A'", 'now()', $userId);
            dbInsert('sugg_course', $cols, $values);            
        }
        else if($action == 'remove'){
            $query = "DELETE FROM sugg_course ";
            $query.= "WHERE course_id='$courseCode';";
            $queryRun = mysql_query($query);
        }
        if($queryRun){
            $response = array(
                'Success' => true
            );
        }        
        return $response;
    }
    /**
     * This function returns the courses that have been suggested by the dean to show them in jTable.
     * @author Mohammad Haddad
     * @return JSON Array
     */
    public static function getSuggCourses(){
        $resultArray =array();
        $columns = 'COURSE_ID';
        $tableName = 'sugg_course';
        $query =   "SELECT ".$columns." FROM ".$tableName;
        $result =  mysql_query($query);
        while ($result2 = mysql_fetch_array($result)){
            array_push($resultArray, $result2);
        }
        return $resultArray;
    }
    
    /**
     * This function returns the total number of suggested courses from sugg_course table
     * @author George Trad
     * @return type
     */
    public static function getSuggCoursesNum(){
        $query = "SELECT count(id) FROM sugg_course WHERE active='A'";
        $result = mysql_query($query);
        $num = mysql_fetch_array($result);
        return $num[0];
    }
    /**
     * This functions returns the latest inserted semester.
     * @author George Trad
     * @return Integer    
     */
    public static function getLatestSemester(){
        $query = "SELECT max(id) FROM semester WHERE active='A'";
        $result = mysql_query($query);
        $last = mysql_fetch_array($result);        
        return $last[0]; 
    }
    public static function importStudent($file){
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //** Variables ******************************************************************************//
        $rows = 5000;
        $rowsOffSet = 3;
        //** Student name ******************************************************************************//
        $columns = array(
            "id"            => "A",
            "first_name"    => "B",
            "middle_name"   => "C",
            "last_name"     => "D"    
        );
        $staticData = array(
                "status"    => "A"       
        );    
        $tableName = 'student';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);

        if ($result===true)
            echo 'file imported successfully';
        else 
            echo $result;

        unset($columns, $tableName, $staticData, $a);
        return true;        
    }
    public static function courseImport($file){
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //*******************Variables   *******************//
        $rows = 5000;
        $rowsOffSet = 3;
        ////*******************Course name*******************//
        $columns = array(
            "id"            => "F",
            "name_ar"       => "G"
        );
        $staticData = array();   
        $tableName = 'course';
        $a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        var_dump($a);echo '<br>';
        unset($columns, $tableName, $staticData, $a);

        return true;     
    }
    public static function classImport($file,$inputSemester){
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //*******************Variables   *******************//
        $rows = 5000;
        $rowsOffSet = 3;
        ////*******************Class name*******************//
        $columns = array(
            "id"            => "H",
            "course_id"     => "F"
        );
        $staticData = array(
            "semester_id"   => $inputSemester
        );
        $tableName = 'class';
        $a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        var_dump($a);echo '<br>';
        unset($columns, $tableName, $staticData, $a);
        ////*******************Student class*******************//
        $columns = array(
            "student_id"    => "A",
            "class_id"      => "H" 
        );
        $staticData = array();
        $tableName = 'student_class';
        $a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        var_dump($a);echo '<br>';
        unset($columns, $tableName, $staticData, $a);

        return true;      
    }
    public static function gradeImport($file){
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //*******************Variables   *******************//
        $rows = 5000;
        $rowsOffSet = 3;
        //*******************Student duty , duty number 5*******************//
        $columns = array(
            "student_class_student_id"                  => "A",
            "student_class_class_id"                    => "H",
            "grade"                                     => "O"
        );
        $staticData = array(
                "duty_type_id"    => "5"       
        );   
        $tableName = 'duty';
        $a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        var_dump($a);echo '<br>';
        unset($columns, $tableName, $staticData, $a);

        return true;       
    }
    public static function courseFileImport($file){

        
    }
    public static function studentFileImport($file){

        
    }
}