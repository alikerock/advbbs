<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";


  /*
  echo strlen('123abc'); //6
  echo mb_strlen('123abc');//6
  echo strlen('강남콩'); //9
  echo mb_strlen('강남콩');//3
  echo iconv_strlen('강남콩');//3

  //str_replace(B,C,A); A에서 b를 c로 변경  
  $txt = 'php web 개발'; // web->app
  $result = str_replace('web','app', $txt);
  echo $result;
 
  $abc = 'abcdefg';
  //iconv_substr(대상,start, length, charset);
  $abc2 = iconv_substr($abc,0,5,'utf-8');
  echo $abc2;
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>홈 - 게시판</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/bbs.css">
</head>
<body>
  <div class="wrapper">
    <h1>자유게시판</h1>
    <table>
      <thead>
        <tr>
          <th>번호</th>
          <th>제목</th>
          <th>글쓴이</th>
          <th>작성일</th>
          <th>조회수</th>
          <th>추천수</th>
        </tr>
      </thead>
      <tbody>
      <?php

        $sql = "SELECT * FROM board order by idx desc";
        $result = $mysqli->query($sql);
        while($row = mysqli_fetch_assoc($result)){
          $title = $row['title'];

          if(iconv_strlen($title) > 10){
            $title = str_replace($title,iconv_substr($title,0,10,'utf-8').'...',$title);
          }
      ?>

      <tr>
        <td><?= $row['idx'] ?></td>
        <td>
          <a href="page/board/read.php?idx=<?= $row['idx'] ?>"><?= $title; ?></a>
          <?php 
            if($row['lock_post'] == 1){
              echo "<i class=\"fa-solid fa-lock\"></i>";
            }
          ?>
        </td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['date'] ?></td>
        <td><?= $row['hit'] ?></td>
        <td><?= $row['thumbsup'] ?></td>
      </tr>

      <?php
        }
      ?>
        
      </tbody>
    </table>
    <div class="links">
      <a href="./page/board/write.php">글쓰기</a>
    </div>
  </div>
  <?php
    $mysqli->close();
  ?>
</body>
</html>