<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  //idx번호의 글 조회
  $bno = $_GET['idx'];
  $sql = "SELECT * FROM board WHERE idx = {$bno}";
  $result = $mysqli->query($sql);
  $resultArr = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>글수정</title>
  <link rel="stylesheet" href="../../css/bbs.css">
</head>
<body>
  <div class="wrapper">
    <h1>글수정</h1>
    <form action="modify_ok.php" method="POST" class="form">
      <input type="hidden" name="idx" value="<?= $bno; ?>">
      <div class="field">
        <label for="name">이름:</label>
        <input type="text" id="name" name="name" value="<?= $resultArr['name'];?>" required>
      </div>
      <div class="field">
        <label for="title">제목:</label>
        <input type="text" id="title" name="title" maxlength="50" value="<?= $resultArr['title'];?>" required>
      </div>
      <div class="field">
        <label for="content">내용:</label>
        <textarea name="content" id="content" cols="30" rows="10"><?= $resultArr['content'];?></textarea>
      </div>
      <div class="field">
        <label for="pw">비번:</label>
        <input type="password" id="pw" name="pw" required>
      </div>    
      <button>글 작성</button>
    </form>
  </div>
</body>
</html>