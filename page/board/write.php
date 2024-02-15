<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>글쓰기</title>
</head>
<body>
  <h1>글쓰기</h1>
  <form action="write_ok.php" method="POST">
    <div class="field">
      <label for="name">이름:</label>
      <input type="text" id="name" name="name" required>
    </div>
    <div class="field">
      <label for="title">제목:</label>
      <input type="text" id="title" name="title" maxlength="50" required>
    </div>
    <div class="field">
      <label for="content">내용:</label>
      <textarea name="content" id="content" cols="30" rows="10"></textarea>
    </div>
    <div class="field">
      <label for="pw">비번:</label>
      <input type="password" id="pw" name="pw" required>
    </div>    
    <button>글 작성</button>
  </form>
</body>
</html>