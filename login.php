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
            <div style="border: 2px solid black; width: 400px; height: 320px; position: relative; top: 200px; background-color: #FFFFFF;">
                <h1>로그인</h1>
                <form action="login_process.php" method="post">
                    <table>
                        <tr>
                            <td style = "font-size: 14px">아이디 </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="u_id" placeholder="아이디 입력"required></td>
                        </tr>
                        <tr>
                            <td style = "font-size: 14px">비밀번호 </td>
                        </tr>
                        <tr>
                            <td><input type="password" name="u_pw" placeholder="비밀번호 입력" required></td>   
                        </tr>
                    </table><br>
                    <input type="submit" value="로그인" style = "width: 170px; height: 30px;"><br><br>
                    <a href="./join.php"><input type="button" value="회원가입"></a>&nbsp;&nbsp;
                    <a href="./search.php"><input type="button" value="ID/PW찾기"></a>
                    

                </form>
            </div>
        <center>
    </body>
</html>