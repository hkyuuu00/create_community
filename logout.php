<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>logout</title>
    </head>

    <body>
    <?php
    session_start(); // 세션 시작

    if (isset($_SESSION['userid'])) { // 세션 변수 'userid'가 설정되어 있다면
        unset($_SESSION['userid']); // 세션 변수 'userid' 삭제
    }

    header('Location: ./login.php'); // 로그인 페이지로 리다이렉트
    ?>
    </body>
</html>