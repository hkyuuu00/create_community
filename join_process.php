<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Join</title>
        <style>
            body{
                background-color: #96a1f2;
            }
        </style>
    </head>

    <body>
        <center>
            <div style="border: 2px solid black; width: 500px; height: 160px; position: relative; top: 120px; background-color: #FFFFFF;" >
                <h1>회원가입</h1><br>

                <?php
                $u_id = $_POST['u_id'];
                $u_pw = $_POST['u_pw'];
                $u_name = $_POST['u_name'];
                $u_gender = $_POST['u_gender'];
                $u_phone = $_POST['u_phone'];
                // 정보 받아오기

                $dir = './image/'; // 저장할 폴더
                $file_name1 = basename($_FILES['u_img']['name']); // 파일 이름 1
                if ($file_name1 == '') {
                    // 파일이 업로드되지 않았을 경우 기본 이미지 사용
                    $imagepath = $dir . 'default.jpg'; // 기본 이미지 파일.
                } else {
                    $file_name2 = date('Ymd', time()); // 파일 이름 2 (시간 값)
                    $imagepath = $dir . $file_name2 . $file_name1; // 파일 이름 설정
                    move_uploaded_file($_FILES['u_img']['tmp_name'], $imagepath); // 이미지 파일 업로드 설정
                }

                $dbcon = mysqli_connect('localhost', 'root', '');

                // 데이터베이스 연결

                mysqli_select_db($dbcon, 'ktest');
                // 데이터베이스 선택
                $checkid = "select * from member where u_id = '$u_id'";
                $result = mysqli_query($dbcon, $checkid);
                $count = mysqli_num_rows($result); //데이터 한 줄을 불러오기
                if(strlen($u_id) < 5){
                    echo "<center>5자 이상이어야 합니다. 회원가입을 다시 해주세요.</center>";
                }else if(strlen($u_id) > 20){
                    echo "<center>20자 미만이어야 합니다. 회원가입을 다시 해주세요.</center>";
                }else{
                    if($count == 0){
                        $query = "INSERT INTO member (u_id, u_pw, u_name, u_gender, u_phone, u_img) VALUES ('$u_id', '$u_pw', '$u_name', '$u_gender', '$u_phone', '$imagepath')";
                        $check = mysqli_query($dbcon, $query);
                        // 데이터베이스 질의 전송

                        if ($check) {
                            echo "$u_name 님의 가입이 승인되었습니다.";
                            echo "<meta http-equiv='refresh' content='2; url=./login.php'>";
                        } else {
                            echo "오류가 발생하였습니다. 관리자에게 문의하시오: " . mysqli_error($dbcon);
                        }
                    }else{
                        echo "<center>중복된 ID 입니다. 회원가입을 다시 해주세요.</center>";
                    }
                }
                mysqli_close($dbcon);
                // 데이터베이스 연결 종료
                ?>
            </div>
        </center>
    </body>
</html>