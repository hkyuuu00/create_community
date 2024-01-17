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
            if($userid == 'admin'){
                echo '<a href="./admin.php"><input type="button" value="회원검색" style = "width: 80px; height: 25px; display: inline-block; float: left; position: relative; bottom: 1px; left: 30px;"></a><br><br>';
            }else{
                echo "<p style='font-size: 14px;'><strong>어서오세요!  $userid"."님</strong></p>";    //세션이 있는 경우
            }    //세션이 있는 경우
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
                <a href="./community.php?page=1"><input type="button" value="메인" style = "width: 60px; height: 25px; float: right; position: relative; right: 10px; top: 5px;"></a><br>
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

                        $search_p = mysqli_real_escape_string($dbcon, $_POST['search_p']);
                        $search_type = $_POST['search_type'];

                        $limit = 15; // 페이지당 보여줄 게시물 수
                        $page = isset($_GET['page']) ? $_GET['page'] : 1; // 현재 페이지 번호, 기본값은 1
                        $start = ($page - 1) * $limit; // 시작 게시물의 인덱스

                        if ($search_type == 'u_id') {
                            $query2 = "SELECT COUNT(*) as total FROM community WHERE u_id LIKE '%$search_p%'";
                            $query3 = "SELECT * FROM community WHERE u_id LIKE '%$search_p%' ORDER BY num DESC LIMIT $start, $limit";
                        } elseif ($search_type == 'post') {
                            $query2 = "SELECT COUNT(*) as total FROM community WHERE post LIKE '%$search_p%'";
                            $query3 = "SELECT * FROM community WHERE post LIKE '%$search_p%' ORDER BY num DESC LIMIT $start, $limit";
                        } elseif ($search_type == 'p_title') {
                            $query2 = "SELECT COUNT(*) as total FROM community WHERE p_title LIKE '%$search_p%'";
                            $query3 = "SELECT * FROM community WHERE p_title LIKE '%$search_p%' ORDER BY num DESC LIMIT $start, $limit";
                        } else {
                            $query2 = "SELECT COUNT(*) as total FROM community";
                            $query3 = "SELECT * FROM community ORDER BY num DESC LIMIT $start, $limit";
                        }

                        $result2 = mysqli_query($dbcon, $query2);
                        if (!$result2) {
                            die('Query Failed: ' . mysqli_error($dbcon));
                        }

                        $row = mysqli_fetch_assoc($result2);
                        $total_pages = ceil($row['total'] / $limit);

                        $result3 = mysqli_query($dbcon, $query3);
                        if (!$result3) {
                            die('Query Failed: ' . mysqli_error($dbcon));
                        }
                        if (mysqli_num_rows($result3) > 0) {
                            while($row = mysqli_fetch_assoc($result3)){
                                echo "<tr style='padding: 0px; border: 1px solid black; height: 30px;'>";
                                echo "<td style = 'width: 60px; text-align: center; font-size: 14px;'>".$row['num']."</td>";
                                echo '<td style = "width: 395px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">&nbsp; <a href="view_post.php?num=' . $row['num'] .'">' . $row['p_title'] . '</a></td>';
                                echo "<td style = 'width: 120px; text-align: center; font-size: 14px;'>".$row['u_id']."</td>";
                                echo "<td style = 'width: 90px; text-align: center; font-size: 14px;'>".$row['p_time']."</td>";
                                echo "</tr>";
                            }
                        }
                        else{
                            echo "검색 결과가 없습니다.";
                        }
                        $start_link = max(1, $page - 2);
                        $end_link = min($total_pages, $page + 2);

                        // 전체 페이지 수를 기반으로 페이지네이션 링크를 출력합니다.
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