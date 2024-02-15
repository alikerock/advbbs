<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  $username = $_POST['name'];
  $userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('Y-m-d');
  
  $sql = "INSERT INTO board (name,pw,title,content,date) values ('{$username}','{$userpw}','{$title}','{$content}','{$date}')";

  if($mysqli->query($sql) === true){
    echo "<script>
        alert('글쓰기 완료');
        location.href='../../index.php';
        </script>";
  } else{
    echo "Error:".$sql."<br>".$mysqli->error;
  }

?>