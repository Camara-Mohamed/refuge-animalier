<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <style>
        body {
            margin: 0; padding: 0;
            background-color: #edddd4;
            font-family: Arial, sans-serif;
            color: #283e3b;
        }
        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .header {
            background-color: #772f25;
            padding: 32px 40px;
            text-align: center;
        }
        .header-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }
        .body {
            padding: 40px;
        }
        .body h1, .body h2 {
            color: #772f25;
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .body p {
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 14px;
        }
        .body strong {
            color: #772f25;
        }
        .body a.btn {
            display: inline-block;
            margin-top: 12px;
            padding: 12px 28px;
            background-color: #772f25;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
        }
        .divider {
            border: none;
            border-top: 1px solid #edddd4;
            margin: 24px 0;
        }
        .note {
            font-size: 12px;
            color: #999;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <p class="header-title">Les Pattes Heureuses</p>
        </div>
        <div class="body">
            @yield('content')
        </div>
    </div>
</body>
</html>
