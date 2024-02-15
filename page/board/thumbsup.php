<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  $bno = $_GET['idx'];
  /*
  변수명 $sql에 board테이블에서 idx가 bno번호와 일치하는 행에서 thumbsup 컬럼 조회 지시문 작성
  $sql지시문을 실행한 결과를 $result에 할당.
  $result를 연관배열로 추출해서 변수명 $resultArr에 할당
  thumbsup에 1을 추가해서 변수명 $newthumb에 할당

  thumbsup의 값을 board테이블에 업데이트하는 지시문을 $sqlUpdate에 할당
  $sqlUpdate 실행 결과는 $resultUpdate에 할당
  $resultUpdate의 결과가 true라고 한다면 '추천성공' 경고 메시지 출력후 index.php로 이동
  */
?>