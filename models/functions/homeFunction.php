<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/selectFunction.php';

$num = select('count(id)', 'student');
echo 'عدد الطلاب هو: ';
echo $num[0];

echo '<br>';

$num = select('id', 'course');
echo 'عدد المقررات هو: ';
echo $num[0];

echo '<br>';

$num = select('count(id)', 'class');
echo 'عدد الشعب هو: ';
echo $num[0];

echo '<br>';

$num = select('count(id)', 'semester');
echo 'عدد  الطلاب الناجحين في مقرر للغة الإنكليزية  1   هو: ';
echo $num[0];

include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';

$query ='   SELECT  count(duty.id)
            FROM    student
                INNER JOIN student_class ON student.id = student_class.student_id
                INNER JOIN class ON student_class.class_id = class.id
                INNER JOIN course ON class.course_id = course.id   
                    AND class.course_id = "ENG100"
                INNER JOIN duty ON duty.student_class_student_id = student_class.student_id
                    AND duty.student_class_class_id = student_class.class_id     
                    AND duty.grade >=60 
                INNER JOIN duty_type ON duty_type.id = duty.duty_type_id
                    AND duty.duty_type_id = "5"  ';

$result =  mysql_query($query);
    
while($row = mysql_fetch_array($result)) {
    var_dump( $row );
}