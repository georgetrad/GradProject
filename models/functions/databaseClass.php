<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importFunction.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/selectFunction.php';
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
        $query = "SELECT user.user_id, user.username, user.level ";
        $query.= "FROM user ";        
        $query.= "WHERE user.username='".mysql_real_escape_string($username)."' AND user.password='".mysql_real_escape_string($password_hash)."' AND user.active = 'A' ";
        
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
                
                if($userLevel == 0 || $userLevel ==  -1){
                    $query2 = "SELECT id, CONCAT(teacher.first_name, ' ', teacher.last_name) AS name ";
                    $query2.= "FROM teacher, user ";
                    $query2.= "WHERE user.username = teacher.user_username AND user.username = '$username'";
                }

                else if($userLevel == 1){
                    $query2 = "SELECT id, CONCAT(student.first_name, ' ', student.last_name) AS name ";
                    $query2.= "FROM student, user ";
                    $query2.= "WHERE user.username = student.user_username AND user.username = '$username'";
                }

                $queryRun2 = mysql_query($query2);
                $name = mysql_result($queryRun2, 0, 'name');
                $id = mysql_result($queryRun2, 0, 'id');
                $response = array(
                        'success'   => true,
                        'username'  => $username,
                        'userId'    => $userId,
                        'userLevel' => $userLevel,
                        'id'        => $id,
                        'name'      => $name
                    );
            }                
            return $response;
        }
    }
    public static function changePassword($userId, $oldPassword, $newPassword){        
        $passwordHash	= md5($oldPassword);
        $response = array();
        $query = "SELECT password FROM user WHERE user_id = $userId";
        $queryRun = mysql_query($query);                
        $queryNumRows = mysql_num_rows($queryRun);
        if($queryNumRows == 0){
            $response['success'] = false;
        }
        else if($queryNumRows == 1){
            $password = mysql_result($queryRun, 0, 'password');            
            if($passwordHash == $password){
                $updatedPassword = md5($newPassword);
                $cols = array('password', 'update_date');
                $data = array("'$updatedPassword'", 'now()');
                dbUpdate('user', $cols, $data, "user_id = $userId");                
                $response['success'] = true;
            }
            else{
                $response['success'] = false;
            }
        }
        return $response;
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
        if(isset($queryRun)){
            $response = array(
                'Success' => true
            );
        return $response;            
        }        
    }
    /**
     * This function inserts/removes to/from student_suggest table.
     * @author George Trad
     * @param String $action
     * @param String $courseCode
     * @param Integer $userId
     */
    public static function askForCourse($action, $studentId, $courseCode, $credits, $semester, $userId){        
        if($action == 'add'){            
            $cols = array('student_id', 'course_id', 'credits', 'semester_id', 'create_date', 'user_id');            
            $values = array("'$studentId'", "'$courseCode'", $credits, $semester, 'now()', $userId);
            dbInsert('student_suggest', $cols, $values);            
        }
        else if($action == 'remove'){
            $query = "DELETE FROM student_suggest ";
            $query.= "WHERE course_id='$courseCode';";
            $queryRun = mysql_query($query);
        }
        if(isset($queryRun)){
            $response = array(
                'Success' => true
            );
            return $response;
        }                
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
        $query =   "SELECT ".$columns." FROM ".$tableName." WHERE semester_id = (SELECT max(id) FROM semester WHERE active = 'A')";
        $result =  mysql_query($query);
        while ($result2 = mysql_fetch_array($result)){
            array_push($resultArray, $result2);
        }
        return $resultArray;
    }
    /**
     * This function returns the courses that have been asked by the student.
     * @author George Trad
     * @return JSON Array
     */
    public static function getAskedCourses($studentId){
        $resultArray =array();
        $columns = 'COURSE_ID';
        $tableName = 'student_suggest';
        $query =   "SELECT ".$columns." FROM ".$tableName." WHERE student_id = '$studentId'";
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
        $query = "SELECT count(id) FROM sugg_course WHERE active='A' AND semester_id = (SELECT max(id) FROM semester WHERE active = 'A')";
        $result = mysql_query($query);
        $num = mysql_fetch_array($result);
        return $num[0];
    }
    /**
     * This function returns the total number of asked courses from student_suggest table.
     * @author George Trad
     * @return type
     */
    public static function getAskCoursesNum($studentId){
        $query = "SELECT count(id) AS num, sum(credits) AS hrs FROM student_suggest WHERE student_id = '$studentId' AND semester_id = (SELECT max(id) FROM semester WHERE active = 'A')";
        $result = mysql_query($query);
        $num = mysql_result($result, 0, 'num');
        $hrs = mysql_result($result, 0, 'hrs');                
        $response = array(
            'num' => $num,
            'hrs' => $hrs
        );        
        return $response;
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
        $userId = $_SESSION['userId'];
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
                "status"        => "A",       
                "upload_file"   => $file,       
                "user_id"       => $userId       
        );    
        $tableName = 'student';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        unset($columns, $tableName, $staticData);
        return $result;
    }
    /**
     * This function imports a courses excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
    public static function courseImport($file){
        $userId = $_SESSION['userId'];
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //*******************Variables   *******************//
        $rows = 5000;
        $rowsOffSet = 3;
        ////*******************Course name*******************//
        $columns = array(
            "id"            => "F",
            "name_ar"       => "G"
        );
        $staticData = array(       
            "upload_file"   => $file,       
            "user_id"       => $userId
        );   
        $tableName = 'course';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        unset($columns, $tableName, $staticData);
        return $result;
    }
    /**
     * This function imports classes from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
    public static function classImport($file,$inputSemester){
        $userId = $_SESSION['userId'];
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
            "semester_id"   => $inputSemester,       
            "upload_file"   => $file,       
            "user_id"       => $userId    
        );
        $tableName = 'class';
        $result1 = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        unset($columns, $tableName, $staticData);
        ////*******************Student class*******************//
        $columns = array(
            "student_id"    => "A",
            "class_id"      => "H" 
        );
        $staticData = array();
        $tableName = 'student_class';
        $result2 = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData,false);
        unset($columns, $tableName, $staticData);  
        return array('result'=>$result1['result']&&$result2['result'],'query'=>$result1['query'].$result2['query'],'error'=>$result1['error'].$result2['error']);
    }
    /**
     * This function imports students grades from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
    public static function gradeImport($file){
        $userId = $_SESSION['userId'];
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //*******************Variables   *******************//
        $rows = 5000;
        $rowsOffSet = 3;
        //*******************Student duty , duty number 5*******************//
        $columns = array(
            "student_class_student_id"  => "A",
            "student_class_class_id"    => "H",
            "grade"                     => "O",
            "point"                     => "P",
            "letter_grade"              => "Q"
        );
        $staticData = array(
            "duty_type_id"    => "5",       
            "upload_file"   => $file,       
            "user_id"       => $userId          
        );   
        $tableName = 'duty';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        unset($columns, $tableName, $staticData);
        return $result;  
    }
    /**
     * This function imports students grades from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
    public static function classGradeImport($file,$dep){
        $userId = $_SESSION['userId'];
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //** General variables ***********************************//
        $rows = 5000;
        $rowsOffSet = 6;
        $error = '';
        
        //** import course and class, if course is not defined its tpe wll be 0 ***********************************//
                
        $objPHPExcel = PHPExcel_IOFactory::load($_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file);        
        $crs = $objPHPExcel->getActiveSheet()->getCell('D2')->getValue();
        $crsName = $objPHPExcel->getActiveSheet()->getCell('C2')->getValue();
        $cls = $objPHPExcel->getActiveSheet()->getCell('E2')->getValue();
        $semName = $objPHPExcel->getActiveSheet()->getCell('A2')->getValue();
        
        $sem = getValue('id', 'semester', 'name LIKE"'.$semName.'"');
        
        dbInsert('course', array('id','name_ar'),  array('"'.$crs.'"','"'.$crsName.'"'));
        dbInsert('class', array('id','course_id'),array('"'.$cls.'"','"'.$crs.'"'));
        //** Student ***********************************//
        $columns = array(
            "id"            => "T",
            "first_name"    => "U",
            "middle_name"   => "V",
            "last_name"     => "W"   
        );
        $staticData = array(
            "status"        => "A" ,
            "department_id" => $dep,       
            "upload_file"   => $file,       
            "user_id"       => $userId
        );   
        $tableName = 'student';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData, false);
        $error .= $result;
        unset($columns, $tableName, $staticData, $result);  
        //** Student Class ***********************************//
        $columns = array(
            "student_id"  => "T"
        );
        $staticData = array(
            "class_id"    => $cls 
        );   
        $tableName = 'student_class';
        $result = importSC($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData, false);
        $error .= $result;
        unset($columns, $tableName, $staticData, $result); 
        //** Final grade ***********************************//
        $columns = array(
            "student_class_student_id"  => "T",
            "grade"      => "J"
        );
        $staticData = array(
            "student_class_class_id"    => $cls,
            "duty_type_id"              => "5",       
            "upload_file"   => $file,       
            "user_id"       => $userId       
        );   
        $tableName = 'duty';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        var_dump($result);exit;
        $error .= $result;
        unset($columns, $tableName, $staticData, $result);      
        //** Return response ***********************************//
        $success =  true;
        $response =  array ('SUCCESS' => $success, 'ERROR' => $error);
        return $response;  
    }
    /**
     * This function imports courses from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
    public static function courseFileImport($file){
        $userId = $_SESSION['userId'];
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
            "course_level"      => "A",
            "credits"           => "D"
        );
        $staticData = array(       
            "upload_file"   => $file,       
            "user_id"       => $userId
        );
        $tableName = 'course';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        unset($columns, $tableName, $staticData);
        return $result;       
    }
    /**
     * This function imports students from an excel file.
     * @author Mohammad Haddad
     * @param String $file File name
     * @return boolean
     */
    public static function studentFileImport($file, $dep){
        $userId = $_SESSION['userId'];
        $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
        //*******************Variables   *******************//
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
            "status"        => "A",
            "department_id" => $dep,       
            "upload_file"   => $file,       
            "user_id"       => $userId       
        );   
        $tableName = 'student';
        $result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
        unset($columns, $tableName, $staticData);
        return $result;
    }
    
    public static function updateAll(){        
        $query = "CALL update_data()";
        $result = mysql_query($query);
        $response = array("result" => $result, "error"=> mysql_error());
        return $response;
    }
    
    public static function updateHoursLevel(){
        // Update completed hours for all students.
        $query = "CALL update_hours_and_level()";
        $result = mysql_query($query);
        $response = array("result" => $result, "error"=> mysql_error());
        return $response;
    }
    
    public static function updateStuCourse(){        
        $query = "CALL update_student_course()";
        $result = mysql_query($query);
        $response = array("result" => $result, "error"=> mysql_error());
        return $response;
    }
    
    public static function updateCourse(){        
        $query = "CALL update_course()";
        $result = mysql_query($query);
        $response = array("result" => $result, "error"=> mysql_error());
        return $response;
    }
    
    public static function createUsernamesForStudent(){        
        $query = "CALL create_user_stu()";
        $result = mysql_query($query);
        $response = array("result" => $result, "error"=> mysql_error());
        return $response;
    }
    
    public static function getStuData($id){ 
        
        $query= "SELECT * FROM get_stu_data WHERE ";
        if ($_SESSION['userLevel']!= -1){
            $query.= "user_username = '".$_SESSION['username']."' AND ";
        }
        $query.= "id =". $id;
        
        $queryRun = mysql_query($query);
        $fetch = mysql_fetch_row($queryRun);
        if ($fetch != ''){
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
            
            $gpa = getValue('SUM(academic_view_max.point*academic_view_max.credits)/SUM(academic_view_max.credits)','academic_view_max','student_id='.$id,FALSE);//select SUM(academic_view_max.point*academic_view_max.credits)/SUM(academic_view_max.credits) from academic_view_max where academic_view_max.student_id = 
                    
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
        $query = "SELECT * FROM semester WHERE id= (SELECT max(id) FROM semester WHERE active = 'A') AND active = 'A'";
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
            return false;
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
//       $x = getValue('count(*)', 'stu_sugg_hrs',"hrs<(SELECT min_req_hrs FROM semester WHERE id = (SELECT max(id) FROM semester)) OR hrs IS NULL " );
        $query = "SELECT count(*) as recordCount FROM stu_sugg_hrs ";
        $query.= "WHERE hrs<(SELECT min_req_hrs FROM semester WHERE id = (SELECT max(id) FROM semester WHERE active = 'A')) OR hrs IS NULL ";
        $result = mysql_query($query);
        $num = mysql_fetch_row($result);
        return $num[0];
//        return $x;
    }
    
    public static function getWithouthAdvNum(){
        $query = "SELECT count(id) ";
        $query.= "FROM student ";
        $query.= "WHERE advisor_id IS NULL";
        $result = mysql_query($query);
        $num = mysql_fetch_array($result);
        return $num[0];
    }
    
    public static function getGraduationCourses(){
        $id = getValue('max(id)', 'semester');
        $max = getValue('max_grad_stu_hrs', 'semester','id = '.$id);
        $result = select('tot_hours_completed','student',  'tot_hours_completed >= '.$max);
        return $result;
    }
    
    public static function getGraduationStudents(){
        $id = getValue('max(id)', 'semester');
        $max = getValue('max_grad_stu_hrs', 'semester','id = '.$id);
        $result = getData('id','student',  'tot_hours_completed >= '.$max);
        return $result;
    }
    
    public static function getSuggestedCourses(){
        $id = getValue('max(id)', 'semester');
        $result = getData('course_id','sugg_course',  'semester_id = '.$id);
        return $result;
    }
    
    public static function getCheckboxFilter(){
        $data = getData('name_ar,id','course_type');
        $result = "<form id='checkboxFilter'>"; 
        foreach ($data as $value){
            $result.= "<input type='checkbox' name='filter' value='".$value[1]."' id='course_type_".$value[1]."'>".' '.$value[0].'   ';
            $result.= "&nbsp;";
                    
        }
        $result .= "</form>";
        return $result;
    }
    
    public static function getMyStudents(){
        $query = "SELECT student.id, student.current_level AS level, ";
        $query.= "CONCAT (student.first_name, ' ', student.middle_name, ' ', student.last_name) as name, department.name_ar as dep_name ";        
        $query.= "FROM user ";                                               
        $query.= "INNER JOIN teacher ON teacher.user_username = user.username ";
        $query.= "INNER JOIN student ON student.advisor_id = teacher.id ";       
        $query.= "INNER JOIN department ON department.id = student.department_id ";
        $query.= "AND teacher.user_username = '".$_SESSION['username']."' ";        
        
        $result = mysql_query($query);        
        $rows = array();
        while($row = mysql_fetch_array($result)){
            $rows[] = $row;
        }
        return $rows;
    }
}
