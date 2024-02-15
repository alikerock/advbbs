<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  $username = $_POST['name'];
  $userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('Y-m-d');
  
  $sql = //board 테이블에 저장하는 sql 문장
?>