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
    <hr>
    <div class="content"><?= nl2br($resultArr['content']);?></div>
    <hr>
    <h2>댓글</h2>
    <?php

    $reply_sql = "SELECT * FROM reply WHERE b_idx = {$bno} order by idx desc";
    $reply_result = $mysqli->query($reply_sql);
    while($reply_row = mysqli_fetch_assoc($reply_result)){
    ?>
    <div class="reply">
      <h3><?= $reply_row['name']?></h3>
      <div class="content">
      <?= nl2br($reply_row['content']);?>
      </div>
      <div class="btns">
        <button class="edit">수정</button>
        <button class="del">삭제</button>
      </div>
      <dialog class="edit_dialog">
        <!-- 댓글 수정 폼 -->
        <form action="reply_modify_ok.php" method="POST">
          <input type="hidden" name="board_no" value="<?= $bno; ?>">
          <input type="hidden" name="reply_no" value="<?= $reply_row['idx']; ?>">
          <input type="password" name="pw" placeholder="비밀번호">
          <textarea name="content" cols="20" rows="5"><?= $reply_row['content'];?></textarea>
          <button>수정</button>
          <button type="button">취소</button>
        </form>
      </dialog>
      <dialog class="del_dialog">
        <!-- 댓글 삭제 폼 -->
        <form action="reply_delete_ok.php" method="POST">
          <input type="hidden" name="board_no" value="<?= $bno; ?>">
          <input type="hidden" name="reply_no" value="<?= $reply_row['idx']; ?>">
          <input type="password" name="pw" placeholder="비밀번호">
          
          <button>삭제</button>
          <button type="button">취소</button>
        </form>        
      </dialog>
    </div><!--// reply -->
    <?php } ?>

    <!-- 댓글 입력 폼 -->
    <div class="reply_form">
      <form action="reply_ok.php" method="POST">
        <input type="hidden" name="idx" value="<?= $bno;?>">
        <input type="text" name="name" placeholder="이름">
        <input type="password" name="password" placeholder="비밀번호">
        <textarea name="content" cols="20" rows="5"></textarea>
        <button>작성</button>
      </form>
    </div>

    <hr>
    <p>
      <a href="../../index.php">홈</a> /
      <a href="thumbsup.php?idx=<?= $bno;?>">추천</a>  /
      <a href="modify.php?idx=<?= $bno;?>">수정</a>  /
      <a href="delete.php?idx=<?= $bno;?>">삭제</a>
    </p>
  </div>
  <script src="js/common.js"></script>
</body>
</html>