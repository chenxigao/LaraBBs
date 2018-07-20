<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laravist email</title>
</head>
<body>
Welcome To Laravist  {{ $name }}
<p>请点击以下链接激活：<a href="{{ route('confirm_email',$token) }}">
        {{  route('confirm_email',$token) }}</a></p>
</body>

</html>