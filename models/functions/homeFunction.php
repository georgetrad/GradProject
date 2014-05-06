<?php

include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';

//student total number
$query =   "SELECT count(id)
            FROM student
            WHERE student.active = 'A'";
$result =  mysql_query($query);

echo 'عدد الطلاب هو: ';
echo '<table cellpadding="5" cellspacing="5" class="db-table">';
while($row2 = mysql_fetch_row($result)) {
    echo '<tr>';
    foreach($row2 as $key=>$value) {
            echo '<td>',$value,'</td>';
    }
    echo '</tr>';
}
echo '</table>';
