<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>커뮤니티</title>
        <style>
            body{
                background-color: #96a1f2;
            }
        </style>
    </head>

    <body>
        <?php
        session_start();
        if(isset($_SESSION['userid'])){      //유저아이디에 세션가 있는지 조사
            $userid = $_SESSION['userid'];
            echo "<p style='font-size: 14px;'><strong>어서오세요!  $userid"."님</strong></p>";    //세션이 있는 경우
        ?>

        <center>
        <a href="./logout.php"><input type="button" value="로그아웃" style = "width: 80px; height: 25px; display: inline-block; float: left; position: relative; bottom: 10px; left: 30px;"></a>
            <h1 style = "font-size: 35px; display: inline-block; position: relative; right: 48px;">게시판</h1>
            <div style="border: 2px solid black; width: 680px; height: 550px; position: relative; top: 2px; background-color: #FFFFFF; border-radius: 10px;">
                <?php
                $dbcon = mysqli_connect('localhost', 'root', '');
                mysqli_select_db($dbcon, 'ktest');
                
                // URL에서 'num' 파라미터를 가져옵니다.
                $num = $_GET['num'];
                // 'num' 값이 숫자인지 확인합니다.
                if(is_numeric($num)) {
                    // 해당하는 게시물의 정보를 데이터베이스에서 가져옵니다.
                    $query = "SELECT * FROM community WHERE num = $num";
                    $result = $dbcon->query($query);
    
                    if ($result->num_rows > 0) {
                    // 결과를 출력합니다.
                    while($row = $result->fetch_assoc()) {
                        echo "<a href = './community.php?page=1'><input type = 'button' value = '뒤로가기' style = 'float: left; position: relative; left: 5px; top: 5px'></a><br><br>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<td style = 'width: 400px; font-size: 18px;'>&nbsp;&nbsp;제목: ".$row["p_title"]."</td>";
                        echo "<td style = 'width: 120px; font-size: 15px; text-align: center;'>작성자: ".$row["u_id"]."</td>";
                        echo "<td style = 'width: 120px; font-size: 14px; text-align: center;'>날짜: ".$row["p_time"]."</td>";
                        echo "</tr></table><br><br><table style = 'border: 1px solid black;'><tr>";
                        echo "<td style = 'width: 600px; height: 350px; font-size: 18px; vertical-align: top;'>".$row["post"]."</td>";
                        echo "</tr></table>";

                        $current_userid = $_SESSION['userid']; // 현재 사용자 ID. 세션에서 가져오는 방식을 예시로 들었습니다.

                        // 현재 사용자가 게시물 작성자거나 관리자일 경우에만 삭제 버튼을 보여줍니다.
                        if ($current_userid == $row['u_id'] || $current_userid == 'admin') {
                            echo '<br><a href="del_post.php?num=' . $row['num'] . '"><input type="button" value = "삭제하기" style="width: 80px; height: 30px;"></a>';
                        }
                    }
                    } else {
                        echo "<center><div style='border: 2px solid black; width: 400px; height: 150px; position: relative; top: 150px; background-color: #FFFFFF;'>";
                        echo "<h1>오류</h1><br>";
                        echo "다시 시도해주세요.";
                        echo "<meta http-equiv='refresh' content='2; url=./write.php'>";
                        echo "</div><center>";
                    }
                } else {
                    echo "<center><div style='border: 2px solid black; width: 400px; height: 150px; position: relative; top: 150px; background-color: #FFFFFF;'>";
                    echo "<h1>오류</h1><br>";
                    echo "다시 시도해주세요.";
                    echo "<meta http-equiv='refresh' content='2; url=./write.php'>";
                    echo "</div><center>";
                }
                ?>
            </div>
        <center>

        <?php
        }else{
            echo "<center><div style='border: 2px solid black; width: 400px; height: 110px; position: relative; top: 200px; background-color: #FFFFFF;'>";
            echo "<p style = 'font-size: 30px;'>엑세스 거부</p>";       //세션이 없는 경우
            echo "<meta http-equiv='refresh' content='2; url=./login.php'>";
            echo "</div></center>";
        }
        ?>
    </body>
</html>