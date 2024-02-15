<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";
  
  $bno = $_POST['idx'];
  $username = $_POST['name'];
  $userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('Y-m-d');

  $sql ="UPDATE board set name='{$username}', pw='{$userpw}', title='{$title}', content='{$content}', date='{$date}' where idx = {$bno}";

  if($mysqli->query($sql) === true){
    echo "<script>
        alert('글수정 완료');
        location.href='../../index.php';
        </script>";
  } else{
    echo "<script>
          history.back();
        </script>";
  }

?>