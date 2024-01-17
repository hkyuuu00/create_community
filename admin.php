<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>관리자 페이지</title>
        <style>
            body {
                background-color: #96a1f2;
            }
            ul {
                background-color: #FFDAB9;
                width: 150px;
                list-style-type: none;
                padding: 0;
            }
            li a {
                display: block;
                color: #000000;
                padding: 8px;
                text-decoration: none;
                font-weight: bold;
                text-align: center;
                border: 1px solid black;
            }
            li a:hover {
                background-color: #CD853F;
                color: white;
            }
            li a.current {
                background-color: #FF6347;
                color: white;
            }
            li a:hover:not(.current) {
                background-color: #CD853F;
                color: white;
            }
        </style>
    </head>

    <body>
    

        <?php

        session_start();
        if(isset($_SESSION['userid'])){      //유저아이디에 세션가 있는지 조사
            $userid = $_SESSION['userid'];

            if($userid == 'admin') {
                ?>
                <ul>
                    <li><a href="./logout.php">로그아웃</a></li>
                    <li><a href="./admin.php">회원검색</a></li>
                    <li><a href="./community.php?page=1">게시판</a></li>
                </ul>
                <center>

                    <form action="./admin.php" method="post" style = 'border: 2px solid black; width: 750px; height: 140px; background-color: #FFFFFF;'>
                        <h1>검색</h1>
                        이름: <input type="text" name="u_name">&nbsp;&nbsp;
                        성별: 
                            <select name = 'u_gender'>
                            <option value="all">모두</option>
                            <option value="male">남성</option>
                            <option value="female">여성</option>
                        </select>&nbsp;&nbsp;
                        <input type="submit" value="검색">
                    </form>

                    <h1 style = 'border: 2px solid black; width: 750px; background-color: #FFFFFF;'>검색결과</h1><br>

                    <?php
                    if(!isset($_POST['u_name'])) return 0;      //u_name에 받은 값이 없으면 종료하기
                    if(!isset($_POST['u_gender'])) return 0;    //u_gender에 받은 값이 없으면 종료하기

                    $u_name = $_POST['u_name'];
                    $u_gender = $_POST['u_gender'];
                    //정보 가져오기
            
                    $dbcon = mysqli_connect('localhost', 'root', '');
                    //데이터베이스 연결
            
                    mysqli_select_db($dbcon, 'ktest');
                    //데이터베이스 선택
            
                    if($u_name == ''){
                        if($u_gender == 'all'){
                            $query = "select * from member";
                        }
                        else {
                            $query = "select * from member where u_gender = '$u_gender'";
                        }
                    }else{
                        if($u_gender == 'all'){
                            $query = "select * from member where u_name = '$u_name'";
                        }
                        else {
                            $query = "select * from member where u_name = '$u_name' and u_gender = '$u_gender'";
                        }
                    }
                    //데이터베이스에 사용자 자료 검색
                    
                    $result = mysqli_query($dbcon, $query);
                    //사용자 자료 전송
                    if(mysqli_num_rows($result) == 0){
                        echo "검색결과가 없습니다.";
                    }else{
                        echo "<table border = '1' style = 'background-color: #FFFFFF;'>";
                        echo "<tr>";
                        echo "<td>사진</td>";   
                        echo "<td>ID</td>";
                        echo "<td>PW</td>";
                        echo "<td>이름</td>";
                        echo "<td>성별</td>";
                        echo "<td>전화번호</td>";
                        echo "</tr>";
                
                        while($row = mysqli_fetch_row($result)){
                            echo "<tr>";
                            echo "<td><img src = ".$row[6]." width = '120' height = '160'></td>";
                            echo "<td width = '120' align = 'center'>".$row[1]."</td>";
                            echo "<td width = '120' align = 'center'>".$row[2]."</td>";
                            echo "<td width = '120' align = 'center'>".$row[3]."</td>";
                            echo "<td width = '120' align = 'center'>".$row[4]."</td>";
                            echo "<td width = '120' align = 'center'>".$row[5]."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        //한 줄씩 배열 형태로 변환
                    }
                    mysqli_close($dbcon);
                }else{
                    echo "<center><div style='border: 2px solid black; width: 400px; height: 110px; position: relative; top: 200px; background-color: #FFFFFF;'>";
                    echo "<p style = 'font-size: 30px;'>엑세스 거부</p>";       //세션이 없는 경우
                    echo "<meta http-equiv='refresh' content='2; url=./login.php'>";
                    echo "</div></center>";
                }


            }else{
                echo "<center><div style='border: 2px solid black; width: 400px; height: 110px; position: relative; top: 200px; background-color: #FFFFFF;'>";
                echo "<p style = 'font-size: 30px;'>엑세스 거부</p>";       //세션이 없는 경우
                echo "<meta http-equiv='refresh' content='2; url=./login.php'>";
                echo "</div></center>";
            }
            ?>
         </center>
    </body>
</html>