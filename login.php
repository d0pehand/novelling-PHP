<!DOCTYPE>

<html>
<head>
    <meta charset='utf-8'>
</head>

<body>
<div align='center'>
    <span>로그인</span>

    <form method='get' action="../logics/login.php">
        <p>ID: <input name="id" type="text"></p>
        <p>PW: <input name="pw" type="password"></p>
        <input type="submit" value="로그인">
    </form>

    <button onclick="location.href='./signUp.php'">회원가입</button>
</div>
</body>
</html>