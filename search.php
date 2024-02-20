<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";
  $search_type = $_GET['search_type'];
  $search_keyword = $_GET['search'];

  if($search_type == 'title'){
    $type_name = '제목';
  } else if($search_type == 'name'){
    $type_name = '글쓴이';
  } else if($search_type == 'content'){
    $type_name = '내용';
  }
  //페이지네이션
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }
  //전체 게시물수 조회
  $page_sql = "SELECT COUNT(*) AS cnt FROM board WHERE $search_type LIKE '%$search_keyword%' ";
  $page_result = $mysqli->query($page_sql);
  $page_row = mysqli_fetch_assoc($page_result);
  $row_num = $page_row['cnt'];
 

  //페이지네이션 변수
  $list = 10;//한페이지당 출력할 게시물 수
  $block_ct = 5; //페이지네이션 개수

  $block_num = ceil($page/$block_ct); // 1/5  0.2 = 1
  $block_start = (($block_num - 1) * $block_ct) + 1; // (1-1)*5 + 1 = 1
  $block_end = $block_start + $block_ct - 1; //1 + 5 – 1 = 5        
  
  $total_page = ceil($row_num / $list); // 65/10   6.5   7
  if($block_end > $total_page) $block_end = $total_page;
  //만약 블록의 마지막 번호가 페이지수보다 크다면 마지막 번호는 페이지 수
  // 5>7 $block_end = 5   
  
  $total_block = ceil($total_page/$block_ct); //  7/5 = 2
  $start_num = ($page-1) * $list; //1-1*10 = 0

  $sql = "SELECT * FROM board order by idx desc limit {$start_num}, {$list}";
  $result = $mysqli->query($sql);

  

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
    <p><?= $type_name; ?>:<?= $search_keyword; ?>의 검색결과는 총 '<?= $row_num; ?>'건 입니다.</p>
    <!-- <p>제목:'웹표준'의 검색결과는 총 '10'건 입니다.</p>
    <p>작성자:'홍길동'의 검색결과는 총 '10'건 입니다.</p>
    <p>내용:'웹표준'의 검색결과는 총 '10'건 입니다.</p> -->
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

        while($row = mysqli_fetch_assoc($result)){
          $title = $row['title'];

          $reply_cnt_sql = "SELECT COUNT(*) AS cnt FROM reply WHERE b_idx={$row['idx']}";
          $reply_cnt_result = $mysqli->query($reply_cnt_sql);
          $reply_row = mysqli_fetch_assoc($reply_cnt_result);
          if($reply_row['cnt'] > 0){
            $rc = "(".$reply_row['cnt'].")";
          } else{
            $rc ='';
          }

          if(iconv_strlen($title) > 10){
            $title = str_replace($title,iconv_substr($title,0,10,'utf-8').'...',$title);
          }
      ?>

      <tr>
        <td><?= $row['idx'] ?></td>
        <td>        
          <?php
            $postdate = $row['date']; //글쓴 날짜
            $current_date = date('Y-m-d'); //현재 날짜

            if($postdate == $current_date) {
              $new = '[새글]';
            } else {
              $new = '';
            }
          ?>  
        
          <?php if($row['lock_post'] == 1){ ?>      
          
          <a href="page/board/lock_read.php?idx=<?= $row['idx'] ?>"><?= $title.$rc.$new; ?> <i class="fa-solid fa-lock"></i></a>

          <?php  } else { ?>

            <a href="page/board/read.php?idx=<?= $row['idx'] ?>"><?= $title.$rc.$new; ?></a>

          <?php } ?>

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
    <div class="pagenation">
      <ul>
         <?php
        if($page > 1){
          echo "<li><a href=\"index.php?page=1\" class=\"button\">처음</a></li>";
          //이전
          if($block_num > 1){
            $prev = 1 + ($block_num - 2) * $block_ct;
            echo "<li><a href=\"index.php?page=$prev\" class=\"button\">이전</a></li>";
          }
        }
       
          for($i=$block_start;$i<=$block_end;$i++){
            if($i == $page){
              echo "<li><a href=\"index.php?page=$i\" class=\"active\">$i</a></li>";
            }else{
              echo "<li><a href=\"index.php?page=$i\">$i</a></li>";
            }            
          }  

          if($page < $total_page){
            if($total_block > $block_num){
              $next = $block_num * $block_ct + 1;
              echo "<li><a href=\"index.php?page=$next\" class=\"button\">다음</a></li>";
            }
            echo "<li><a href=\"index.php?page=$total_page\" class=\"button\">마지막</a></li>";
          }        
        ?>
      </ul>
    </div>
    <hr>
    <div class="search_form">
      <form action="page/board/search.php" method="get">
          <select name="search_type">
            <option value="title">제목</option>
            <option value="name">글쓴이</option>
            <option value="content">내용</option>
          </select>
          <input type="text" name="search" require>
          <button>검색</button>
      </form>
    </div>
    <div class="links">
      <a href="./page/board/write.php">글쓰기</a>
    </div>
  </div>
  <?php
    $mysqli->close();
  ?>
</body>
</html>