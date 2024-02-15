<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  $bno = $_GET['idx'];
  $sql = "SELECT thumbsup FROM board WHERE idx = {$bno}";
  $result = $mysqli->query($sql);
  $resultArr = mysqli_fetch_assoc($result);
  $newthumb = $resultArr['thumbsup'] + 1;

  $sqlUpdate = "UPDATE board SET thumbsup={$newthumb} WHERE idx = {$bno}";

  if($mysqli->query($sqlUpdate) === true){
    echo "<script>
        alert('추천성공');
        location.href='../../index.php';
        </script>";
  };

?>