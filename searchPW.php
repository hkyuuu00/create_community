<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>비밀번호 찾기</title>
        <style>
            body{
                background-color: #96a1f2;
            }
        </style>
    </head>

    <body>
        <center>
            <div style="border: 2px solid black; width: 600px; height: 130px; position: relative; top: 220px; background-color: #FFFFFF;">
                <?php
                $u_id = $_POST['u_id'];
                $u_name = $_POST['u_name'];
                $u_phone = $_POST['u_phone'];
                // 정보 받아오기

                $dbcon = mysqli_connect('localhost', 'root', '');
                // 데이터베이스 연결

                mysqli_select_db($dbcon, 'ktest');
                // 데이터베이스 선택

                $checkid = "select * from member where u_id = '$u_id'";
                $result = mysqli_query($dbcon, $checkid);
                $row = mysqli_fetch_array($result);

                if(isset($row['u_name'], $row['u_phone'], $row['u_pw']) && $row['u_name'] == $u_name && $row['u_phone'] == $u_phone){
                    echo "<p style = 'font-size: 22px;'>회원님의 비밀번호는 <strong>".$row['u_pw']."</strong> 입니다</p>";
                }else{
                    echo "<p style = 'font-size: 22px;'>계정이 없습니다.</p>";
                }
                
                
                mysqli_close($dbcon);
                // 데이터베이스 연결 종료
                ?>
                <a href="./search.php"><input type="button" value="뒤로가기" style = "width: 130px; height: 30px;"></a>&nbsp;&nbsp;&nbsp;
                <a href="./login.php"><input type="button" value="로그인 하기" style = "width: 130px; height: 30px;"></a>
            </div>
        </center>
    </body>
</html>