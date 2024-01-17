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
        ?>


        <center>
            <h1>글쓰기</h1>
            <a href="./logout.php"><input type="button" value="로그아웃" style = "width: 80px; height: 25px; display: inline-block; float: left; position: relative;  bottom: 82px; left: 30px;"></a>
            <div style="border: 2px solid black; width: 680px; height: 550px; position: relative; top: 2px; background-color: #FFFFFF;">
                <a href = "./community.php?page=1"><input type = "button" value = "뒤로가기" style = "float: left; position: relative; left: 5px; top: 5px;"></a><br><br><br>
                <form action="./write_process.php" method="post">
                    <select name = 'p_type' style="height: 30px;">
                        <option value="freeboard">자유</option>
                        <option value="tip">정보</option>
                        <option value="notice">공지사항</option>
                    </select>
                    <input type="text" name="p_title" placeholder="제목을 입력하시오." require style="width: 400px; height: 25px;"><br><br><br>
                    <textarea name="post" maxlength="20000" placeholder="내용을 입력하시오." style="width: 480px; height: 300px; font-size: 14px;" require></textarea><br><br>
                    <input type="submit" value="작성완료" style = "width: 100px; height: 40px; float: middle; position: relative; left: 193px; font-size: 16px;">
                </form>   
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