<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #ffd6e7, #d6e5ff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .box {
            width: 320px;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 10px #aaa;
            text-align: center;
            position: relative;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 7px 0;
            border: 2px solid #ffc2df;
            border-radius: 10px;
            background: #fff6fb;
        }

        button {
            padding: 10px 25px;
            background: #ff6fa7;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.2s;
        }

        button:hover {
            background: #ff4b8c;
        }

        .title {
            font-size: 20px;
            margin-bottom: 10px;
            color: #ff4b8c;
            font-weight: bold;
        }
    </style>

<body>

<div class="box">
    <h2>Login</h2>
    <form action="cek_login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
