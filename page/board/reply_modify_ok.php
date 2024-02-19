<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";
  
  $bno = $_POST['board_no'];
  $rno = $_POST['reply_no'];
  $userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
  $content = $_POST['content'];


  $sql ="UPDATE reply set content='{$content}' where idx = {$rno}";

  if($mysqli->query($sql)){
    echo "<script>
        alert('댓글수정 완료');
        location.replace('read.php?idx=$bno;');
        </script>";
  } 
?>
