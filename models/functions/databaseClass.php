<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importFunction.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importStudentClassFunction.php';
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
    /**
     * This function imports a students excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
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

        if ($result===true){
            echo 'file imported successfully';
        }
        else{ 
            echo $result;            
        }

        unset($columns, $tableName, $staticData, $a);
        return true;        
    }
    /**
     * This function imports a courses excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
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
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);

        if ($result===true)
            echo 'file imported successfully';
        else 
            echo $result;

        unset($columns, $tableName, $staticData, $a);
        return true;   
    }
    /**
     * This function imports classes from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
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
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);

        if ($result===true)
            echo 'file imported successfully';
        else 
            echo $result;

        unset($columns, $tableName, $staticData, $a);
        ////*******************Student class*******************//
        $columns = array(
            "student_id"    => "A",
            "class_id"      => "H" 
        );
        $staticData = array();
        $tableName = 'student_class';
        $result = importSC($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);

        if ($result===true)
            echo 'file imported successfully';
        else 
            echo $result;

        unset($columns, $tableName, $staticData, $a);
    }
    /**
     * This function imports students grades from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
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
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);

        if ($result===true){
            echo 'file imported successfully';
        }
        else{ 
            echo $result;
        }

        unset($columns, $tableName, $staticData, $a);
        return true;   
    }
    /**
     * This function imports courses from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
    public static function courseFileImport($file){
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //*******************Variables   *******************//
        $rows = 5000;
        $rowsOffSet = 2;
        //******************* Course File *******************//
        $columns = array(
            "id"                => "C",
            "course_type_id"    => "F",
            "req_course_id"     => "E",
            "name_ar"           => "B",
            "course_level"      => "A"
        );
        $staticData = array();
        $tableName = 'course';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        if ($result===true){
            echo 'file imported successfully';
        }
        else{
            echo $result;
        }
        unset($columns, $tableName, $staticData);        
    }
    /**
     * This function imports students from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
    public static function studentFileImport($file, $major){
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //*******************Variables   *******************//
        $rows = 5000;
        $rowsOffSet = 3;
        //*******************Student File *******************//
        $columns = array(
            "id"            => "A",
            "first_name"    => "B",
            "middle_name"   => "C",
            "last_name"     => "D"    
        );
        $staticData = array(
            "department_id" => $major       
        );   
        $tableName = 'student';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);

        if ($result===true){
            echo 'file imported successfully';
        }
        else {
            echo $result;
        }

        unset($columns, $tableName, $staticData, $a);
        return true;   
    }
    
    public static function updateHoursLevel(){
        // Update completed hours for all students.
        $query = "CALL update_hours_and_level()";
        $result = mysql_query($query);            
        // Update all students level according to their hours.
        if($result){
            $response = 'Success';
        }
        else{
            $response = 'Fail';
        }
        return $response;        
    }
    
    public static function updateStuCourse(){        
        $query = "CALL update_student_course()";
        $result = mysql_query($query);
        if($result){
            $response = 'Success';
        }        
        else{
            $response = 'Fail';
        }
        return $response;        
    }
    
    public static function updateCourse(){        
        $query = "CALL update_course()";
        $result = mysql_query($query);
        if($result){
            $response = 'Success';
        }        
        else{
            $response = 'Fail';
        }
        return $response;        
    }
    
    public static function getStuData($id){        
        $query = "SELECT s.id, CONCAT(s.first_name, ' ', s.middle_name, ' ', s.last_name) as name, s.department_id, s.registration_date, ";
        $query.= "s.gender, s.birth_date, s.national_id, s.address, s.phone_number, s.email, s.tot_hours_completed, s.current_level, s.current_gpa, ";
        $query.= "d.name_ar, d.tot_hours ";
        $query.= "FROM student AS s ";
        $query.= "LEFT JOIN department AS d ";
        $query.= "ON s.department_id = d.id ";
        $query.= "WHERE s.id = $id";
                
        $queryRun = mysql_query($query);
        if (!$queryRun){
            $response = array('success' => false);
        }
        else if ($queryRun){
            $stuId = mysql_result($queryRun, 0, 'id');
            $name = mysql_result($queryRun, 0, 'name');
            $gender = mysql_result($queryRun, 0, 'gender');
            $birthDate = mysql_result($queryRun, 0, 'birth_date');
            $nationalId = mysql_result($queryRun, 0, 'national_id');
            $address = mysql_result($queryRun, 0, 'address');
            $phone = mysql_result($queryRun, 0, 'phone_number');
            $email = mysql_result($queryRun, 0, 'email');
            $gpa = mysql_result($queryRun, 0, 'current_gpa');
            $comHrs = mysql_result($queryRun, 0, 'tot_hours_completed');
            $stuLevel = mysql_result($queryRun, 0, 'current_level');
            $depName = mysql_result($queryRun, 0, 'name_ar');
            $depHrs = mysql_result($queryRun, 0, 'tot_hours');
            $regDate = mysql_result($queryRun, 0, 'registration_date');
            if($gender == 'M'){
                $gender = MALE;
            }
            else if($gender == 'F'){
                $gender = FEMALE;
            }
            
            $failedQuery = "SELECT count(status) FROM student_course where student_id = 20910264 AND status = 'F'";
            $result = mysql_query($failedQuery);
            $num = mysql_fetch_array($result);
            
            $response = array('success'   => true, 'id'  => $stuId, 'name'    => $name, 'gender'  => $gender, 'birthDate'  => $birthDate,
                              'nationalId'  => $nationalId, 'address'  => $address, 'phone' => $phone, 'email' => $email, 'gpa' => $gpa,
                                'comHrs' => $comHrs, 'level' => $stuLevel, 'depName' => $depName, 'depHrs' => $depHrs, 'regDate' => $regDate, 
                                'failedCrs' => $num[0]);
            }         
        return $response;
    }
    
    public function getCurrSemInfo(){
        $query = "SELECT * FROM semester WHERE id= (SELECT max(id) FROM semester) AND active = 'A'";
        $result = mysql_query($query);
        $rows = array();
        while($row = mysql_fetch_array($result)){
            $rows[] = $row;
        }
        return $rows;
    }   
}
