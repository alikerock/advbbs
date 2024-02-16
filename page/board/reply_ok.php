<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  $idx = $_POST['idx'];
  $username = $_POST['name'];
  $userpw = password_hash($_POST['password'],PASSWORD_DEFAULT);
  $content = $_POST['content'];
  $date = date("Y-m-d H:i:s");
  
  $sql = "INSERT INTO reply (name,password,content,date) values ('{$username}','{$userpw}','{$content}','{$date}')";

  if($mysqli->query($sql) === true){
    echo "<script>
        alert('댓글 작성 완료');
        location.href='../../index.php';
        </script>";
  } else{
    echo "Error:".$sql."<br>".$mysqli->error;
  }
  $mysqli->close();
?>