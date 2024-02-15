<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";
  $bno = $_GET['idx'];
  $sql = "DELETE FROM board WHERE idx = {$bno}";

  if($mysqli->query($sql) === true){
    echo "<script>
    alert('삭제성공');
    location.href='../../index.php';
    </script>";
  };

?>