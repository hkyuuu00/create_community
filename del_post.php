<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>글쓰기</title>
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

            
            $dbcon = mysqli_connect('localhost', 'root', '');
            mysqli_select_db($dbcon, 'ktest');

            $num = $_GET['num']; // 삭제할 게시물의 번호를 가져옵니다.

            // 해당 번호의 게시물을 삭제하는 SQL 쿼리
            $query = "DELETE FROM community WHERE num = $num";

            $result = mysqli_query($dbcon, $query);

            if ($result) {
                echo "<center><div style='border: 2px solid black; width: 400px; height: 110px; position: relative; top: 200px; background-color: #FFFFFF;'>";
                echo "<p style = 'font-size: 20px;'>게시물을 삭제하였습니다.</p>";
                echo "<meta http-equiv='refresh' content='2; url=./community.php?page=1'>";
                echo "</div></center>";
            } else {
                echo "<center><div style='border: 2px solid black; width: 400px; height: 80px; position: relative; top: 200px; background-color: #FFFFFF;'>";
                echo "<p style = 'font-size: 20px;'>게시물 삭제에 실패했습니다: " . mysqli_error($dbcon)."</p>";
                echo "<meta http-equiv='refresh' content='2; url=./community.php?page=1'>";
                echo "</div></center>";
            }

            mysqli_close($dbcon);
            

        
        }else{
            echo "<center><div style='border: 2px solid black; width: 400px; height: 110px; position: relative; top: 200px; background-color: #FFFFFF;'>";
            echo "<p style = 'font-size: 30px;'>엑세스 거부</p>";
            echo "<meta http-equiv='refresh' content='2; url=./login.php'>";
            echo "</div></center>";
        }
        ?>
    </body>
</html>