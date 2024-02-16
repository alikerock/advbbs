<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";
  //idx번호의 글 조회
  $bno = $_GET['idx'];
  $sql = "SELECT pw FROM board WHERE idx = {$bno}";
  $result = $mysqli->query($sql);
  $row = mysqli_fetch_assoc($result);

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
      $org_pw = $row['pw'];
      if(isset($_POST['pw_chk'])){
        $pwk = $_POST['pw_chk']; //1234
        if(password_verify($pwk, $org_pw)){
    ?>
    <script>
      location.replace("read.php?idx=<?= $bno;?>");  
    </script>
    <?php 
      } else {
    ?>
    <script>
      alert('비번이 맞지 않습니다.');
      location.replace("../../index.php");  
    </script>
    <?php 
      } }
    ?>

</body>
</html>