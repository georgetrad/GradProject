<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/dbFunctions.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/databaseClass.php';

$case = $_POST['case'];

switch ($case){
    /******************** login_script ********************/
    case 'login':{
        if (isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];    
        $userInfo = databaseClass::logIn($username, $password);             // getting the user info from the database.

        if($userInfo['success'] == true){
            $semester = databaseClass::getLatestSemester();
            // Assigning the user info to a session to use it later.
            $_SESSION['userId']     = $userInfo['userId'];                
            $_SESSION['username']   = $userInfo['username'];
            $_SESSION['userLevel']  = $userInfo['userLevel'];           
            $_SESSION['semester']   = $semester;
        }
        echo json_encode($userInfo);    // Encoding the user info in JSON because it cannot be returned as an array.
        }
        break;
    }
    /******************** all_courses_script ********************/
    case 'suggCourse':{
        $action         = $_POST['action'];
        $courseCode     = $_POST['courseCode'];
        $userId         = $_SESSION['userId'];
        $result = databaseClass::suggCourse($action, $courseCode, $userId);
        echo json_encode($result);
        break;
    }
    /******************** all_courses_script ********************/
    case 'getSuggCourses':{
        $result = databaseClass::getSuggCourses();
        echo json_encode($result);
        break;
    }
    /******************** all_courses_script ********************/
    case 'getSuggCoursesNum':{
        $result = databaseClass::getSuggCoursesNum();
        echo $result;
        break;
    }    
    /******************** assign_advisor_script ********************/
    case 'updateAdvisor':{
        $advisorId          = $_POST['advisorId'];
        $selectedStudents   = $_POST['selectedStudents'];
        $tableName = 'student';
        
        $cols = array(    
            'id',
            'advisor_id'
        );
        
        $data = array(
            $selectedStudents,
            $advisorId
        );
        foreach ($selectedStudents as $id){
            $data = array($id, $advisorId);
            dbInsert('student', $cols, $data, true, $cols, $data);
        }
        break;
    }
    
    case 'deleteFile':{
        $selectedFiles   = $_POST['selectedFiles'];
        foreach ($selectedFiles as $id){
            unlink('../../uploads/'."'$id'");            
        }
    }
    
    /******************** importStudent ********************/
    case 'importStudent':{
        $file = $_POST['selectFile'];
        $result = databaseClass::importStudent($file);
        echo $result;
        break;
    } 
    /******************** courseImport ********************/
    case 'courseImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::courseImport($file);
        echo $result;
        break;
    } 
    /******************** classImport ********************/
    case 'classImport':{
        $file           = $_POST['selectFile'];
        $selectSemester = $_POST['selectSemester'];
        $result = databaseClass::classImport($file,$selectSemester);
        echo $result;
        break;
    } 
    /******************** gradeImport ********************/
    case 'gradeImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::gradeImport($file);
        echo $result;
        break;
    } 
    /******************** courseFileImport ********************/
    case 'courseFileImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::courseFileImport($file);
        echo $result;
        break;
    } 
    /******************** studentFileImport ********************/
    case 'studentFileImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::studentFileImport($file);
        echo $result;
        break;
    } 
}