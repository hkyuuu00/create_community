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
            <div style="border: 2px solid black; width: 500px; height: 580px; position: relative; top: 75px; background-color: #FFFFFF;" >
            <a href="./login.php"><input type="button" value="<< 로그인" style = "width: 90px; height: 30px; position: relative; top: 10px; right: 190px;"></a>
                <h1>회원가입</h1>
                <form action="./join_process.php" enctype="multipart/form-data" method="post" name="register">
                    <table>
                        <tr>
                            <td style="font-size: 14px;">아이디 </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="u_id" placeholder="ID 입력" minlength="5" maxlength="20" required>&nbsp;
                            <input type="button" id="checkid" value="중복체크">
                            <script>
                                document.getElementById('checkid').addEventListener('click', function() { //checkid 버튼이 클릭되면 실행
                                    var u_id = document.register.u_id.value; //u_id 정보를 u_id에 저장
                                    window.open('./check.php?u_id=' + u_id, 'popup', "left=550, top=150, width=120, height=30, scrollbars=no, resizable=no");
                                    //새 창으로 check.php를 열고 u_id정보를 전송
                                });
                            </script>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;">비밀번호 </td>
                        </tr>
                        <tr>
                            <td><input type="password" name="u_pw" id="u_pw" placeholder="비밀번호 입력" minlength="5" maxlength="20" required oninput="updatePWText()"></td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;">비밀번호 확인 </td>
                        </tr>
                        <tr>
                            <td><input type="password" name="u_pwcheck" id="u_pwcheck" placeholder="비밀번호 확인" required oninput="updatePWText()">&nbsp;
                            <p id="pwcheck" style="display:inline"></p>
                            <script>
                                window.onload = function() { //창이 켜졌을때
                                    var joinInputs = document.querySelectorAll('input[name="join"]'); // join버튼 요소를 가져오기
                                    joinInputs.forEach(input => input.disabled = true); // join버튼 비활성화
                                }
                                function updatePWText(value) {
                                    var element = document.getElementById("pwcheck");
                                    var joinInputs = document.querySelectorAll('input[name="join"]'); // join버튼 요소를 가져오기
                                    var pw = document.getElementById("u_pw").value; //id가 u_pw인 input의 값을 가져오기
                                    var pwcheck = document.getElementById("u_pwcheck").value; //id가 u_pwcheck인 input의 값을 가져오기

                                    if (pw !== "" && pwcheck !== "" && pw === pwcheck) {
                                        element.innerText = "O";
                                        element.style.color = "green";
                                        joinInputs.forEach(input => input.disabled = false); // join버튼 활성화
                                    } else if (pwcheck === "" || pw === ""){
                                        element.innerText = "";
                                        element.style.color = "black";
                                        joinInputs.forEach(input => input.disabled = true); // join버튼 비활성화
                                    } else {
                                        element.innerText = "X";
                                        element.style.color = "red";
                                        joinInputs.forEach(input => input.disabled = true); // join버튼 비활성화
                                    }
                                }
                            </script>
                        </td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;">이름 </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="u_name" placeholder="이름 입력" required></td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;">성별 </td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="u_gender" value="male" checked>남성
                                <input type="radio" name="u_gender" value="female">여성
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;">전화번호 </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="tel" name="u_phone" placeholder="전화번호 입력 (-제외)" minlength="11" maxlength="11" onkeypress="return onlyNumber(event)" required>
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
                        <tr>
                            <td style="font-size: 14px;">사진 </td>
                        </tr>
                        <tr>
                            <td><input type="file" name="u_img"></td>
                        </tr>
                        <tr>
                            <td><p style="font-size: 10px; color: gray;">추가하지 않으면 기본이미지로 설정됩니다.</p></td>
                        </tr>
                    </table>
                    <br><input type="submit" name="join" value="회원가입" style = "width: 100px; height: 30px;">
                </form>
            </div>
        <center>
    </body>
</html>