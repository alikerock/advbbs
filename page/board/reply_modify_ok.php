<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";
  
  $bno = $_POST['board_no'];
  $rno = $_POST['reply_no'];
  $userpw = $_POST['pw'];
  $content = $_POST['content'];

  //비번조회
  $pwsql = "SELECT password FROM reply WHERE idx = {$rno}";
  $result = $mysqli->query($pwsql);
  $row = mysqli_fetch_assoc($result);

  $sql ="UPDATE reply set content='{$content}' where idx = {$rno}";

  $org_pw = $row['password'];
  if(password_verify($userpw, $org_pw)){
    if($mysqli->query($sql)){
      echo "<script>
          alert('댓글수정 완료');
          location.replace('read.php?idx=$bno');
          </script>";
    } 
  }else{
    echo "<script>
    alert('비번다시 입력');
    location.replace('read.php?idx=$bno');
    </script>";
  }




?>
