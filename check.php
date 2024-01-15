<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>중복확인</title>
    </head>

    <body>
    <?php
    $u_id = $_GET['u_id'];
    $dbcon = mysqli_connect('localhost', 'root', '');
    //데이터베이스 연결

   mysqli_select_db($dbcon, 'ktest');
   //데이터베이스 선택

   $query = "select * from member where u_id = '$u_id'";
    //데이터베이스에 사용자 자료 입력

    $result = mysqli_query($dbcon, $query);
    $count = mysqli_num_rows($result);
    if(strlen($u_id) < 5){
        echo "<center>5자 이상이어야 합니다.</center>";
        echo "<center><input type=button value=창닫기 onclick='self.close()'></center>";
    }else if(strlen($u_id) > 20){
        echo "<center>20자 미만이어야 합니다.</center>";
        echo "<center><input type=button value=창닫기 onclick='self.close()'></center>";
    }else{
        if($count == 0){
            echo "<center>사용 가능 ID 입니다.</center>";
            echo "<center><input type=button value=창닫기 onclick='self.close()'></center>";
        }else{
            echo "<center>중복된 ID 입니다.</center>";
            echo "<center><input type=button value=창닫기 onclick='self.close()'></center>";
        }
    }
    ?>
    </body>
</html>