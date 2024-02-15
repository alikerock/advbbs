<?php
$mysqli = new mysqli('localhost', 'advbbs', '12345', 'advbbs');

if ($mysqli->connect_errno) {
  echo "연결 실패".$mysqli->connect_error;
  exit(); //스크립트 종료, 뒤 script 무시
} 
?>