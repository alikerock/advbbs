<?php
  include $_SERVER['DOCUMENT_ROOT']."/advbbs/inc/db.php";

  /*
  변수명 $bno에 idx값 저장
  $uesername에 새이름 저장
  $userpw에 새비번을 암호화해서 저장
  $title에 새제목 저장
  $content에 새내용 저장
  $data에 현재 날짜 저장

  변수명 $sql에 board테이블에서 idx가 bno와 일치하는 행의 각 컬럼의 값을 새 값들로 변경
  $sql 지시문 실행
  실행결과가 있다면 수정성공 메시지후 홈으로, 없다면 수정실패 메시지 출력후 바로 전 페이지로
  */

?>