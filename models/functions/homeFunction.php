<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/selectFunction.php';

$num = select('count(id)', 'student');
echo 'عدد الطلاب هو: ';
echo $num[0];

echo '<br>';

$num = select('count(id)', 'course');
echo 'عدد المقررات هو: ';
echo $num[0];

echo '<br>';

$num = select('count(id)', 'class');
echo 'عدد الشعب هو: ';
echo $num[0];

echo '<br>';

$num = select('count(id)', 'semester');
echo 'عدد  الفصول  هو: ';
echo $num[0];