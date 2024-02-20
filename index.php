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
        if(isset($_GET['page'])){
          $page = $_GET['page'];
        }else{
          $page = 1;
        }
        //전체 게시물수 조회
        $page_sql = "SELECT COUNT(*) AS cnt FROM board";
        $page_result = $mysqli->query($page_sql);
        $page_row = mysqli_fetch_assoc($page_result);
        $row_num = $page_row['cnt'];
        echo $row_num;

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
    <div class="links">
      <a href="./page/board/write.php">글쓰기</a>
    </div>
  </div>
  <?php
    $mysqli->close();
  ?>
</body>
</html>