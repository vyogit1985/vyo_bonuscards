<?php
  /*global variables*/    
  error_reporting(E_ALL);
  define('ROOT', '/var/www/html/bonuscards/');
  define('TEMPLATE_DIR', ROOT.'template/');
  define('LOGIC_DIR', ROOT.'logic/');

  /*db config*/
  $db_host_name = 'localhost';
  $db_user_name = 'bonuscards_user';
  $db_user_pass = '9sKRcwG9BmquwLmy';
  $db_name = 'vyo_bonuscards';

  if (!$db_link = mysql_connect($db_host_name, $db_user_name, $db_user_pass))
  {
    die('Не можу встановити зв\'язок з сервером БД.');
  }

  if (!mysql_select_db($db_name, $db_link))
  {
    die('Не можу підключитися до конкретної БД.');
  }

  /*for ukraine language*/
  mysql_query('SET NAMES "utf8"');
?>