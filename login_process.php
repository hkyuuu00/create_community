<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <style>
            body{
                background-color: #96a1f2;
            }
        </style>
    </head>

    <body>
        <center>
            <div style="border: 2px solid black; width: 560px; height: 160px; position: relative; top: 120px; background-color: #FFFFFF;" >
                <h1>로그인</h1><br>

                <?php
                $u_id = $_POST['u_id'];
                $u_pw = $_POST['u_pw'];

                $dbcon = mysqli_connect('localhost','root','');
                //데이터베이스 연결

                mysqli_select_db($dbcon, 'ktest');
                //데이터베이스 선택

                $query = "select * from member where u_id = '$u_id'";
                $result = mysqli_query($dbcon, $query);

                if($result){
                    $row = mysqli_fetch_array($result);
                    if(isset($row['u_pw'], $u_pw) && $row['u_pw'] === $u_pw){
                        if($u_id == 'admin'){
                            echo "관리자 계정이 로그인 되었습니다. 잠시후 관리자 페이지로 넘어갑니다.";
                            echo "<meta http-equiv='refresh' content='2; url=./admin.php'>";

                            $result = setcookie('userid',$u_id,time() + 60);     //쿠키 생성(쿠키이름,쿠키에 저장할 값,쿠키가 유효한 시간)

                            session_start();
                            $_SESSION['userid'] = $u_id;  //유저아이디에 ktest라는 세션을 저장
                            $_SESSION['time'] = time();
                            
                        }else{
                        echo "$u_id"."님 로그인이 완료되었습니다.";

                        $result = setcookie('userid',$u_id,time() + 60);     //쿠키 생성(쿠키이름,쿠키에 저장할 값,쿠키가 유효한 시간)

                        session_start();
                        $_SESSION['userid'] = $u_id;  //유저아이디에 ktest라는 세션을 저장
                        $_SESSION['time'] = time();

                        echo "<meta http-equiv='refresh' content='2; url=./community.php'>";
                        }
                    }else{
                        echo "입력하신 ID 혹은 비밀번호가 없거나 다릅니다.";
                        echo "<meta http-equiv='refresh' content='2; url=./login.php'>";
                    }
                }else{
                    echo "입력하신 ID 혹은 비밀번호가 없거나 다릅니다.";
                    echo "<meta http-equiv='refresh' content='2; url=./login.php'>";
                }
                //질의 전송 + 로그인 관련 처리

                mysqli_close($dbcon);
                //데이터베이스 종료
                ?>
            </div>
        </center>
    </body>
</html>