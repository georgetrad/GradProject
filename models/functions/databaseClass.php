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
        $query = "SELECT count(id) FROM sugg_course WHERE active='A' AND semester_id = (SELECT max(id) FROM semester)";
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
        $query = "SELECT student.id, department.name_ar, ";
        $query.= "CONCAT (student.first_name, ' ', student.middle_name, ' ', student.last_name) as name, ";
        $query.= "department.tot_hours, ";
        $query.= "student.registration_date, ";
        $query.= "student.birth_date, ";
        $query.= "student.gender, ";
        $query.= "student.national_id, ";
        $query.= "student.phone_number, ";
        $query.= "student.email, ";
        $query.= "student.status, ";
        $query.= "student.address, ";
        $query.= "student.tot_hours_completed, ";
        $query.= "student.current_level, ";
        $query.= "student.current_gpa ";
        $query.= "FROM user ";                                               
        $query.= "INNER JOIN teacher ON teacher.user_username = user.username ";
        $query.= "INNER JOIN student ON student.advisor_id = teacher.id ";       
        $query.= "INNER JOIN department ON department.id = student.department_id "; 
        $query.= "AND teacher.user_username = '".$_SESSION['username']."' ";
        $query.= "AND student.id =". $id;
        
        $queryRun = mysql_query($query);        
        if ($queryRun){
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
            
            $failedQuery = "SELECT count(status) FROM student_course where student_id = $id AND status = 'F'";
            $result = mysql_query($failedQuery);
            $num = mysql_fetch_array($result);
            
            $response = array('success'   => true, 'id'  => $stuId, 'name'    => $name, 'gender'  => $gender, 'birthDate'  => $birthDate,
                              'nationalId'  => $nationalId, 'address'  => $address, 'phone' => $phone, 'email' => $email, 'gpa' => $gpa,
                                'comHrs' => $comHrs, 'level' => $stuLevel, 'depName' => $depName, 'depHrs' => $depHrs, 'regDate' => $regDate, 
                                'failedCrs' => $num[0]);
            }
        else {
            $response = array('success' => false);
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
    
    public static function getStuGrades($stuId){
        $query = "SELECT * FROM grades WHERE student = $stuId";
        $result = mysql_query($query);
        $queryNumRows = mysql_num_rows($result);
        if($queryNumRows == 0){
            print_r('Error');exit;
        }
        else{
            $rows = array();
            while($row = mysql_fetch_array($result)){
                $rows[] = $row;
            }
        }
        return $rows;
    }
    
    public static function getBelowStuNum(){
        $query = "SELECT s.min_req_hrs, COUNT(v.id) ";
        $query.= "FROM semester AS s, stu_sugg_hrs AS v ";
        $query.= "WHERE s.id = (SELECT max(id) FROM semester) AND v.hrs<(s.min_req_hrs)";
        $result = mysql_query($query);
        $num = mysql_fetch_array($result);
        return $num[1];
    }
    
    public static function getWithouthAdvNum(){
        $query = "SELECT count(id) ";
        $query.= "FROM student ";
        $query.= "WHERE advisor_id IS NULL";
        $result = mysql_query($query);
        $num = mysql_fetch_array($result);
        return $num[0];
    }
}