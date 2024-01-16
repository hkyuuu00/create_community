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

            if(isset($_POST['post']) && !empty($_POST['post']) && isset($_POST['p_title']) && !empty($_POST['p_title'])){
                
                $p_type = $_POST['p_type'];
                $p_title = $_POST['p_title'];
                $post = $_POST['post'];

                if($p_type == "freeboard") {
                    $p_title = "<strong>[자유]</strong> " . $p_title;
                }else if ($p_type == "tip") {
                    $p_title = "<strong>[정보]</strong> " . $p_title;
                }else{
                    $p_title = "<strong>[공지]</strong> " . $p_title;
                }

                $dbcon = mysqli_connect('localhost','root','');
                //데이터베이스 연결

                mysqli_select_db($dbcon, 'ktest');
                //데이터베이스 선택
                
                $query = "insert into community values (null, '$p_title', '$p_type', '$post', '$userid', now())";
                $result = mysqli_query($dbcon, $query);

                echo "<center><div style='border: 2px solid black; width: 400px; height: 150px; position: relative; top: 150px; background-color: #FFFFFF;'>";
                echo "<h1>글 작성완료</h1><br>";
                echo "글이 성공적으로 업로드 되었습니다.";
                echo "<meta http-equiv='refresh' content='2; url=./community.php?page=1'>";
                echo "</div><center>";

                mysqli_close($dbcon);
            }else{
                echo "<center><div style='border: 2px solid black; width: 400px; height: 150px; position: relative; top: 150px; background-color: #FFFFFF;'>";
                echo "<h1>오류</h1><br>";
                echo "제목과 내용을 작성해주세요.";
                echo "<meta http-equiv='refresh' content='2; url=./write.php'>";
                echo "</div><center>";
            }

        
        }else{
            echo "<center><div style='border: 2px solid black; width: 400px; height: 110px; position: relative; top: 200px; background-color: #FFFFFF;'>";
            echo "<p style = 'font-size: 30px;'>엑세스 거부</p>";       //세션이 없는 경우
            echo "<meta http-equiv='refresh' content='2; url=./login.php'>";
            echo "</div></center>";
        }
        ?>
    </body>
</html>