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
  <div class="wrapper">
    <h1>글보기</h1>
    <h2><?= $resultArr['title'];?></h2>
    <div class="info">
      <span>글쓴이: <?= $resultArr['name'];?></span>
      <span>날짜: <?= $resultArr['date'];?></span>
      <span>조회수: <?= $resultArr['hit'];?></span>
      <span>추천수: <?= $resultArr['thumbsup'];?></span>
    </div>
    <div class="content"><?= nl2br($resultArr['content']);?></div>
    <hr>
    <p>
      <a href="../../index.php">홈</a> /
      <a href="thumbsup.php?idx=<?= $bno;?>">추천</a>  /
      <a href="modify.php?idx=<?= $bno;?>">수정</a>  /
      <a href="delete.php?idx=<?= $bno;?>">삭제</a>
    </p>
  </div>
</body>
</html>