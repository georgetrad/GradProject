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
                $_SESSION['id']         = $userInfo['id'];
                $_SESSION['name']       = $userInfo['name'];
                $_SESSION['semester']   = $semester;
            }
            echo json_encode($userInfo);    // Encoding the user info in JSON because it cannot be returned as an array.
        }
        break;
    }
    /******************** change_password_script ********************/
    case 'changePassword':{        
        $oldPassword        = $_POST['oldPassword'];
        $newPassword        = $_POST['newPassword'];            
        $userId             = $_SESSION['userId'];
        // getting the user info from the database.
        $result = databaseClass::changePassword($userId, $oldPassword, $newPassword);
        echo json_encode($result);    // Encoding the user info in JSON because it cannot be returned as an array.        
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
    /******************** ask_for_courses_script ********************/
    case 'askForCourse':{
        $action         = $_POST['action'];        
        $courseCode     = $_POST['courseCode'];
        $credits        = $_POST['credits'];
        $userId         = $_SESSION['userId'];
        $studentId      = $_SESSION['id'];
        $semester       = $_SESSION['semester'];
        $result = databaseClass::askForCourse($action, $studentId, $courseCode, $credits, $semester, $userId);
        echo json_encode($result);
        break;
    }
    /******************** all_courses_script ********************/
    case 'getSuggCourses':{
        $result = databaseClass::getSuggCourses();
        echo json_encode($result);
        break;
    }
    /******************** ask_for_courses_script ********************/
    case 'getAskedCourses':{
        $studentId = $_SESSION['id'];
        $result = databaseClass::getAskedCourses($studentId);        
        echo json_encode($result);
        break;
    }
    /******************** all_courses_script ********************/
    case 'getSuggCoursesNum':{
        $result = databaseClass::getSuggCoursesNum();
        echo $result;
        break;
    }
    /******************** ask_for_courses_script ********************/
    case 'getAskCoursesNum':{
        $studentId = $_SESSION['id'];
        $result = databaseClass::getAskCoursesNum($studentId);        
        echo json_encode($result);
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
    /******************** importStudentStatus ********************/
    case 'importStudentStatus':{
        $file = $_POST['selectFile'];
        $result = databaseClass::importStudentStatus($file);
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
            $result = databaseClass::updateAll();
        }
        else if($selectedOption == 2){
            $result = databaseClass::updateHoursLevel();
        }
        else if($selectedOption == 3){
            $result = databaseClass::updateStuCourse();
        }
        else if($selectedOption == 4){
            $result = databaseClass::updateCourse();
        }
        else if($selectedOption == 5){
            $result = databaseClass::createUsernamesForStudent();
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        break;
    }
    
    case 'getStuData':{
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $id = $_POST['id'];
        }
        else{
            $id = $_SESSION['id'];
        }        
        $result = databaseClass::getStuData($id);        
        echo (json_encode($result));
        break;
    }
    
    case 'getStuGrades':{
        $stuId = $_POST['id'];
        $result = databaseClass::getStuGrades($stuId);
        if ($result == FALSE){
            $html = '<div class="medium-4 large-4 columns">&nbsp;</div>';
            $html.= '<div class="medium-4 large-4 columns">';
            $html.=     '<div id="wrong" data-alert class="alert-box warning text-center" style="font-size: 14px; font-family: DroidKufi-Regular">';
            $html.=         '<span id="invalid_login">'.NO_GRADES.'</span>';
            $html.=         '<a href="#" class="close"></a>';
            $html.=     '</div>';
            $html.= '</div>';
            $html.= '<div class="medium-4 large-4 columns">&nbsp;</div>';
        }
        else {
            $html = '<table>';
            $html.=     '<tr>';
            $html.=         '<th style="width:10%; font-size:17px">';
            $html.=             COURSE_CODE;
            $html.=         '</th>';
            $html.=         '<th style="width:25%; font-size:17px;">';
            $html.=             COURSE_NAME;
            $html.=         '</th>';
            $html.=         '<th style="width:25%; font-size:17px">';
            $html.=             CREDITS;
            $html.=         '</th>';
            $html.=         '<th style="width:10%; font-size:17px">';
            $html.=             FINAL_GRADE;
            $html.=         '</th>';
            $html.=         '<th style="width:30px; font-size:17px">';
            $html.=             POINTS;
            $html.=         '</th>';
            $html.=         '<th style="width:10px; font-size:17px" >';
            $html.=             LETTER;
            $html.=         '</th>';
            $html.=     '</tr>';
            for ($i=0 ; $i<count($result) ; $i++){
                $html.= '<tr>';
                $html.=     '<td style="font-size: 16px; text-align: left">';
                $html.=         $result[$i]['course_id'];
                $html.=     '</td>';
                $html.=     '<td style="font-size: 16px; padding-right:20px">';
                $html.=         $result[$i]['course_name'];
                $html.=     '</td>';
                $html.=     '<td style="font-size: 16px; text-align: center;">';
                $html.=         $result[$i]['credits'];
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
    case 'getCheckboxFilter':{
        $result = databaseClass::getCheckboxFilter();
        echo json_encode($result);
    break;}
}
