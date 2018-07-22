<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('front/img/assets/favicon2.png') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            height: 100vh;
            background: url({{asset('assets/admin_bg.jpg')}}) 50% fixed;
            background-size: cover;
        }
        @keyframes spinner {
            0% {
                transform: rotateZ(0deg);
            }
            100% {
                transform: rotateZ(359deg);
            }
        }
        * {
            box-sizing: border-box;
        }
        .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            min-height: 100%;
            padding: 20px;
            background: rgba(4, 40, 68, 0.85);
        }
        .login {
            border-radius: 2px 2px 5px 5px;
            padding: 10px 20px 20px 20px;
            width: 90%;
            max-width: 320px;
            background: #fff;
            position: relative;
            padding-bottom: 80px;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
        }
        .login.loading button {
            max-height: 100%;
            padding-top: 50px;
        }
        .login.loading button .spinner {
            opacity: 1;
            top: 40%;
        }
        .login.ok button {
            background-color: #8bc34a;
        }
        .login.ok button .spinner {
            border-radius: 0;
            border-top-color: transparent;
            border-right-color: transparent;
            height: 20px;
            animation: none;
            transform: rotateZ(-45deg);
        }
        .login input {
            display: block;
            padding: 15px 10px;
            margin-bottom: 10px;
            width: 100%;
            border: 1px solid #ddd;
            transition: border-width 0.2s ease;
            border-radius: 2px;
            color: #ccc;
        }
        .login input + i.fa {
            color: #fff;
            font-size: 1em;
            position: absolute;
            margin-top: -47px;
            opacity: 0;
            left: 0;
            transition: all 0.1s ease-in;
        }
        .login input:focus {
            outline: none;
            color: #444;
            border-color: #2196f3;
            border-left-width: 35px;
        }
        .login input:focus + i.fa {
            opacity: 1;
            left: 30px;
            transition: all 0.25s ease-out;
        }
        .login a {
            font-size: 0.8em;
            color: #2196f3;
            text-decoration: none;
        }
        .login .title {
            color: #444;
            font-size: 1.2em;
            font-weight: bold;
            margin: 10px 0 30px 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .login button {
            width: 100%;
            height: 100%;
            padding: 10px 10px;
            background: #2196f3;
            color: #fff;
            display: block;
            border: none;
            margin-top: 20px;
            position: absolute;
            left: 0;
            bottom: 0;
            max-height: 60px;
            border: 0px solid rgba(0, 0, 0, 0.1);
            border-radius: 0 0 2px 2px;
            transform: rotateZ(0deg);
            transition: all 0.1s ease-out;
            border-bottom-width: 7px;
        }
        .login button .spinner {
            display: block;
            width: 40px;
            height: 40px;
            position: absolute;
            border: 4px solid #fff;
            border-top-color: rgba(255, 255, 255, 0.3);
            border-radius: 100%;
            left: 50%;
            top: 0;
            opacity: 0;
            margin-left: -20px;
            margin-top: -20px;
            animation: spinner 0.6s infinite linear;
            transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
            box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
        }
        .login:not(.loading) button:hover {
            box-shadow: 0px 1px 3px #2196f3;
        }
        .login:not(.loading) button:focus {
            border-bottom-width: 4px;
        }
        footer {
            display: block;
            padding-top: 50px;
            text-align: center;
            color: #ddd;
            font-weight: normal;
            text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.2);
            font-size: 0.8em;
        }
        footer a, footer a:link {
            color: #fff;
            text-decoration: none;
        }
        .help-block strong {
            color: red;
        }

    </style>
</head>
<body>
<div class="wrapper">
    <form class="login" method="POST" action="{{ url('/admin/login') }}">
        {{ csrf_field() }}
        <h2 style="text-align: center;">Vista Network</h2>
        <p class="title" style="text-align: center;">Admin Login</p>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        <input class="input100" type="text" name="name" placeholder="Username" value="{{ old('name') }}" autofocus>

        <i class="fa fa-user"></i>
        <input class="input100" type="password" name="password" placeholder="Password">

        <i class="fa fa-key"></i>

        <button type="submit">
            <i class="spinner"></i>
            <span class="state">Log in</span>
        </button>
    </form>
    <footer>{{$general->footer}}</footer>
</div>
</body>
</html>
