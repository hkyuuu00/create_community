<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>계정찾기</title>
        <style>
            body{
                background-color: #96a1f2;
            }
        </style>
    </head>

    <body>
        <center>
            <div style="border: 2px solid black; width: 600px; height: 300px; position: relative; top: 40px; background-color: #FFFFFF;">
            <a href="./login.php"><input type="button" value="<< 로그인" style = "width: 100px; height: 30px; position: relative; top: 10px; right: 240px;"></a>
                <h1>아이디 찾기</h1>
                <form action="searchID.php" method="post">
                    <table>
                        <tr>
                            <td style = "font-size: 14px">이름 </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="u_name" placeholder="이름 입력" required></td>
                        </tr>
                        <tr>
                            <td style = "font-size: 14px">전화번호 </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="tel" name="u_phone" placeholder="전화번호 입력 (-제외)" onkeypress="return onlyNumber(event)" required>
                                <script>
                                function onlyNumber(event){ //숫자만 입력할 수 있도록 하는 이벤트 설정
                                    event = event || window.event;
                                    var keyID = (event.which) ? event.which : event.keyCode;
                                    if ( ( keyID >=48 && keyID <= 57 ) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
                                        return;
                                    else
                                        return false;
                                }
                                </script>
                            </td>   
                        </tr>
                    </table><br>
                    <input type="submit" value="찾기" style = "width: 170px; height: 30px;">
                </form>
            </div>
            <div style="border: 2px solid black; width: 600px; height: 320px; position: relative; top: 60px; background-color: #FFFFFF;">
                <h1>비밀번호 찾기</h1>
                <form action="searchPW.php" method="post">
                    <table>
                        <tr>
                            <td style = "font-size: 14px">아이디 </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="u_id" placeholder="아이디 입력" required></td>
                        </tr>
                        <tr>
                            <td style = "font-size: 14px">이름 </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="u_name" placeholder="이름 입력" required></td>
                        </tr>
                        <tr>
                            <td style = "font-size: 14px">전화번호 </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="tel" name="u_phone" placeholder="전화번호 입력 (-제외)" onkeypress="return onlyNumber(event)" required>
                                <script>
                                function onlyNumber(event){ //숫자만 입력할 수 있도록 하는 이벤트 설정
                                    event = event || window.event;
                                    var keyID = (event.which) ? event.which : event.keyCode;
                                    if ( ( keyID >=48 && keyID <= 57 ) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
                                        return;
                                    else
                                        return false;
                                }
                                </script>
                            </td>   
                        </tr>
                    </table><br>
                    <input type="submit" value="찾기" style = "width: 170px; height: 30px;">
                </form>
            </div>
        <center>
    </body>
</html>