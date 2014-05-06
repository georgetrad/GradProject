<?php

include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';

$number = $_POST['number'];

$query = "SELECT student.first_name,
  student.middle_name,
  student.last_name,
  student.id,
  duty_type.name_ar,
  duty.grade AS Grade,
  class.id AS CRN,
  course.name_ar AS `Course Name`,
  course.id AS `Course Code`
FROM student
  INNER JOIN student_class ON student.id = student_class.student_id  
      AND student.id = ".$number."             
  INNER JOIN class ON class.id = student_class.class_id
  INNER JOIN course ON course.id = class.course_id
  INNER JOIN duty ON duty.student_class_student_id = student_class.student_id
    AND duty.student_class_class_id = student_class.class_id
  INNER JOIN duty_type ON duty_type.id = duty.duty_type_id   ";

$result =  mysql_query($query);

echo '<table cellpadding="5" cellspacing="5" class="db-table">';
while($row2 = mysql_fetch_row($result)) {
    echo '<tr>';
    foreach($row2 as $key=>$value) {
            echo '<td>',$value,'</td>';
    }
    echo '</tr>';
}