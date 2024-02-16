<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  $username = $_POST['name'];
  $userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('Y-m-d');
  
  if(isset($_POST['lock'])){
    $lock_post = 1;
  } else{
    $lock_post = 0;
  }

  $sql = "INSERT INTO board (name,pw,title,content,date,lock_post) values ('{$username}','{$userpw}','{$title}','{$content}','{$date}', {$lock_post})";

  if($mysqli->query($sql) === true){
    echo "<script>
        alert('글쓰기 완료');
        location.href='../../index.php';
        </script>";
  } else{
    echo "Error:".$sql."<br>".$mysqli->error;
  }

?>