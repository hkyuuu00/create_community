<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>커뮤니티</title>
        <style>
            body{
                background-color: #96a1f2;
            }
            a {
                text-decoration: none;
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
            <form action="./search_post.php" method="post">
                <select name = 'search_type' style = "float: left; position: relative; top: 10px; left: 20px; height: 20px;">
                    <option value="p_title">제목</option>
                    <option value="post">내용</option>
                    <option value="u_id">작성자</option>
                </select>
                <input type="text" name = "search_p" placeholder = "검색어 입력" require style = "float: left; position: relative; top: 10px; left: 25px;">
                <input type="submit" value = "검색" style = "float: left; position: relative; top: 10px; left: 30px; height: 22px;">
            </form>
                <a href="./write.php"><input type="button" value="글쓰기" style = "width: 60px; height: 25px; float: right; position: relative; right: 10px; top: 5px;"></a><br>
                <table style = "border-collapse: collapse; position: absolute; left: 2.5px;">
                    <tr style = "text-align: center; font-size: 14px; font-weight: bold;">   
                        <td style="padding: 0px; border: 1px solid black; width: 60px;">번호</td>
                        <td style="padding: 0px; border: 1px solid black; width: 395px;">제목</td>
                        <td style="padding: 0px; border: 1px solid black; width: 120px;">글쓴이</td>
                        <td style="padding: 0px; border: 1px solid black; width: 90px;">작성일</td>
                    </tr>
                        <?php
                        $dbcon = mysqli_connect('localhost', 'root', '');
                        mysqli_select_db($dbcon, 'ktest');
                        $query1 = "select * from community";
                        $result1 = mysqli_query($dbcon, $query1);

                        // 전체 게시물 수를 가져오기 위한 쿼리를 작성합니다.
                        $query2 = "SELECT COUNT(*) as total FROM community";
                        $result2 = mysqli_query($dbcon, $query2);

                        // mysqli_fetch_assoc() 함수를 사용하여 결과에서 하나의 행을 가져옵니다. 
                        // 이 함수는 결과 세트의 다음 행을 연관 배열로 반환합니다.
                        $row = mysqli_fetch_assoc($result2);

                        $limit = 15;
                        $page = isset($_GET['page']) ? $_GET['page'] : 15;

                        // ceil() 함수를 사용하여 전체 페이지 수를 계산합니다. 
                        // ceil() 함수는 주어진 숫자보다 크거나 같은 가장 작은 정수를 반환합니다.
                        $total_pages = ceil($row['total'] / $limit);

                        // 현재 페이지의 첫 번째 게시물의 인덱스를 계산합니다.
                        $start = ($page-1)*$limit;

                        // 현재 페이지에 표시할 게시물을 가져오기 위한 쿼리를 작성합니다.
                        $query3 = "SELECT * FROM community ORDER BY num DESC LIMIT $start, $limit";
                        $result3 = mysqli_query($dbcon, $query3);


                        while($row = mysqli_fetch_assoc($result3)){
                            echo "<tr style='padding: 0px; border: 1px solid black; height: 30px;'>";
                            echo "<td style = 'width: 60px; text-align: center; font-size: 14px;'>".$row['num']."</td>";
                            echo '<td style = "width: 395px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">&nbsp; <a href="view_post.php?num=' . $row['num'] .'">' . $row['p_title'] . '</a></td>';
                            echo "<td style = 'width: 120px; text-align: center; font-size: 14px;'>".$row['u_id']."</td>";
                            echo "<td style = 'width: 90px; text-align: center; font-size: 14px;'>".$row['p_time']."</td>";
                            echo "</tr>";
                        }

                        $start_link = max(1, $page - 2);
                        $end_link = min($total_pages, $page + 2);

                        // 전체 페이지 수를 기반으로 페이지 네비게이션 링크를 출력합니다.
                        for ($i = $start_link; $i <= $end_link; $i++) {
                            // 현재 페이지의 링크 색상을 변경합니다.
                            if ($i == $page) {
                                echo "<span style='float: middle; position: relative; right: 110px; top: 495px;'><a href='community.php?page=".$i."' style='color: red;'>&nbsp;".$i."&nbsp;</a></span>";
                            } else {
                                echo "<span style='float: middle; position: relative; right: 110px; top: 495px;'><a href='community.php?page=".$i."'>&nbsp;".$i."&nbsp;</a></span>";
                            }
                        }

                        mysqli_close($dbcon);
                        ?>      
                </table>
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