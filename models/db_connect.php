<?php
// This file contains the database access information.
// This file also establishes a connection to MySQL and selects the database.

// Setting the database access information as constants.
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'root');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'ebla');

// Create a connnection.
$dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysql_error() );
$charset = 'utf8';
mysql_set_charset($charset);
// Select the defined database.
mysql_select_db (DB_NAME) OR die ('Could not select the database: ' . mysql_error() );