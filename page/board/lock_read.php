<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";
  //idx번호의 글 조회
  $bno = $_GET['idx'];
  $sql = "SELECT * FROM board WHERE idx = {$bno}";
  $result = $mysqli->query($sql);
  $resultArr = mysqli_fetch_assoc($result);

  //조회수 업데이트
  $hit = $resultArr['hit'] + 1;
  $sqlUpdate = "UPDATE board SET hit={$hit} WHERE idx = {$bno}";
  $mysqli->query($sqlUpdate);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>글보기</title>
  <link rel="stylesheet" href="../../css/bbs.css">
</head>
<body>

    <div id="pass_confirm">
      <form action="" method="POST">
        <input type="password" name="pw_chk">
        <button>확인</button>
      </form>
    </div>
    <?php
      /*입력한 비번과 이 글의 원래 비번 비교, 일치하면 read.php 페이지이동*/
    ?>

</body>
</html>