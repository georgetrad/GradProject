<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/dbFunctions.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/databaseClass.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';

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
    /******************** import_script ********************/
    case 'importStudent':{
        $file = $_POST['selectFile'];
        $result = databaseClass::importStudent($file);
        echo $result;
        break;
    }     
    /******************** import_script ********************/
    case 'classGradeImport':{
//        $file = $_POST['selectFile'];
//        $cls =  $_POST['selectFile'];
//        $sem =  $_POST['selectFile'];
//        $dep =  $_POST['selectFile'];
        $file = 'Grades - Example';
//        $cls = 9999;
//        $sem = 17;
        $dep = 1;
        $objPHPExcel = PHPExcel_IOFactory::load($file);        
        $crs = $objPHPExcel->getActiveSheet()->getCell('D2')->getValue();
        $crs_name = $objPHPExcel->getActiveSheet()->getCell('C2')->getValue();
        $cls = $objPHPExcel->getActiveSheet()->getCell('E2')->getValue();
        $sem = $objPHPExcel->getActiveSheet()->getCell('A2')->getValue();
        
        dbInsert('course', array('id','name_ar'),  array($crs,$crs_name));
        dbInsert('class', array('id'),array($cls));
//        dbInsert('course', array('id'), $values, $isDuplicate, $uColumns, $uValues);

        $result = databaseClass::classGradeImport($file, $cls, $sem, $dep);
        return $result;
        break;
    } 
    /******************** import_script ********************/
    case 'courseImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::courseImport($file);
        echo $result;
        break;
    } 
    /******************** import_script ********************/
    case 'classImport':{
        $file           = $_POST['selectFile'];
        $selectSemester = $_POST['selectSemester'];
        $result = databaseClass::classImport($file,$selectSemester);
        echo $result;
        break;
    } 
    /******************** import_script ********************/
    case 'gradeImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::gradeImport($file);
        echo $result;
        break;
    } 
    /******************** import_script ********************/
    case 'courseFileImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::courseFileImport($file);
        echo $result;
        break;
    } 
    /******************** import_script ********************/
    case 'studentFileImport':{
        $file = $_POST['selectFile'];
        $major = $_POST['selectMajor'];
        $result = databaseClass::studentFileImport($file, $major);
        echo $result;
        break;
    }
    case 'updateData':{
        $selectedOption = $_POST['selectUpdate'];
        if($selectedOption == 0){
            $result = 'Fail';
        }
        if($selectedOption == 1){
            $result = databaseClass::updateHoursLevel();
        }
        else if($selectedOption == 2){
            $result = databaseClass::updateStuCourse();
        }
        else if($selectedOption == 3){
            $result = databaseClass::updateCourse();
        }
        echo $result;
        break;
    }
    
    case 'getStuData':{
        $id = $_POST['id'];
        $result = databaseClass::getStuData($id);        
        echo (json_encode($result));
        break;
    }
    
    case 'getStuGrades':{
        $stuId = $_POST['id'];
        $result = databaseClass::getStuGrades($stuId);
        $html = '<table>';
        $html.=     '<tr>';
        $html.=         '<th style="width:100px; font-size:17px">';
        $html.=             COURSE_CODE;
        $html.=         '</th>';
        $html.=         '<th style="width:250px; font-size:17px">';
        $html.=             COURSE_NAME;
        $html.=         '</th>';
        $html.=         '<th style="width:150px; font-size:17px">';
        $html.=             FINAL_GRADE;
        $html.=         '</th>';
        $html.=         '<th style="width:50px; font-size:17px">';
        $html.=             POINTS;
        $html.=         '</th>';
        $html.=         '<th style="width:50px; font-size:17px" >';
        $html.=             LETTER;
        $html.=         '</th>';
        $html.=     '</tr>';
        for ($i=0 ; $i<count($result) ; $i++){
            $html.= '<tr>';
            $html.=     '<td style="font-size: 16px; text-align: left">';
            $html.=         $result[$i]['course_id'];
            $html.=     '</td>';
            $html.=     '<td style="font-size: 16px">';
            $html.=         $result[$i]['course_name'];
            $html.=     '</td>';
            $html.=     '<td style="font-size: 16px; text-align: left">';
            $html.=         $result[$i]['grade'];
            $html.=     '</td>';            
            $html.= '</tr>';
        }
        $html.= '</table>';
        echo $html;
        break;
    }
    
    case 'getBelowStuNum':{
        $result = databaseClass::getBelowStuNum();
        echo $result;
        break;
    }
}
