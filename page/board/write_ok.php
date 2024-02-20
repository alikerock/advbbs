<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  $username = $_POST['name'];
  $userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('Y-m-d');

  //print_r($_FILES['file']);
  $attach_name = $_FILES['file']['name'];
  $attach_temp_path = $_FILES['file']['tmp_name'];
  $upload_path = "../../upload/".$attach_name;

  move_uploaded_file($attach_temp_path, $upload_path);

  if(strpos($_FILES['file']['type'], 'image') !== false){$is_img = 1;} else{$is_img = 0;}

  if(isset($_POST['lock'])){
    $lock_post = 1;
  } else{
    $lock_post = 0;
  }

  $sql = "INSERT INTO board (name,pw,title,content,date,lock_post,file,is_img) values ('{$username}','{$userpw}','{$title}','{$content}','{$date}', {$lock_post}, '{$attach_name}', {$is_img})";

  if($mysqli->query($sql) === true){
    echo "<script>
        alert('글쓰기 완료');
        location.href='../../index.php';
        </script>";
  } else{
    echo "Error:".$sql."<br>".$mysqli->error;
  }

?>