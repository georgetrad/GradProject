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
                $_SESSION['name']       = $userInfo['name'];
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
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        break;
    }     
    /******************** classGradeImport ********************/
    case 'classGradeImport':{
        $file = $_POST['selectFile'];
        $dep =  $_POST['selectMajor'];
        $result = databaseClass::classGradeImport($file, $dep);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        break;
    } 
    /******************** courseImport ********************/
    case 'courseImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::courseImport($file);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        break;
    } 
    /******************** classImport ********************/
    case 'classImport':{
        $file           = $_POST['selectFile'];
        $selectSemester = $_POST['selectSemester'];
        $result = databaseClass::classImport($file,$selectSemester);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        break;
    } 
    /******************** gradeImport ********************/
    case 'gradeImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::gradeImport($file);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        break;
    } 
    /******************** courseFileImport ********************/
    case 'courseFileImport':{
        $file = $_POST['selectFile'];
        $result = databaseClass::courseFileImport($file);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        break;
    } 
    /******************** studentFileImport ********************/
    case 'studentFileImport':{
        $file = $_POST['selectFile'];
        $major = $_POST['selectMajor'];
        $result = databaseClass::studentFileImport($file, $major);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        break;
    }
    /******************** updateData ********************/
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
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
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
        if ($result == FALSE){
            $html = '<div class="medium-4 large-4 columns">
                        <div id="wrong" data-alert class="alert-box warning text-center" style="font-size: 14px; font-family: DroidKufi-Regular">
                                <span id="invalid_login">لا يوجد علامات</span>
                                <a href="#" class="close"></a>
                            </div>
                        </div>';
        }
        else {
            $html = '<table>';
            $html.=     '<tr>';
            $html.=         '<th style="width:100px; font-size:17px">';
            $html.=             COURSE_CODE;
            $html.=         '</th>';
            $html.=         '<th style="width:250px; font-size:17px">';
            $html.=             COURSE_NAME;
            $html.=         '</th>';
            $html.=         '<th style="width:120px; font-size:17px">';
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
                $html.=     '<td style="font-size: 16px; text-align: center;">';
                $html.=         $result[$i]['grade'];
                $html.=     '</td>';            
                $html.=     '<td style="font-size: 16px; text-align: left">';
                $html.=         $result[$i]['point'];
                $html.=     '</td>';            
                $html.=     '<td style="font-size: 16px; text-align: left; direction: ltr">';
                $html.=         $result[$i]['letter_grade'];
                $html.=     '</td>';            
                $html.= '</tr>';
            }
            $html.= '</table>';
        }        
        echo $html;
        break;
    }
    
    case 'getBelowStuNum':{
        $result = databaseClass::getBelowStuNum();
        echo $result;
        break;
    }
    case 'getGraduationCourses':{
        $result = databaseClass::getGraduationCourses();
        echo json_encode($result);
        break;
    }
    case 'getGraduationStudents':{
        $result = databaseClass::getGraduationStudents();
        echo json_encode($result);
        break;
    }
    case 'getSuggestedCourses':{
        $result = databaseClass::getSuggestedCourses();
        echo json_encode($result);
        break;
    }
}
