<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ciphers</title>
    <link rel="shortcut icon" href="/public/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/public/favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-100">
<div class="flex justify-between py-2 px-5 bg-black shadow-md">
    <a href="/"
       class="transition duration-500 ease text-white font-bold hover:text-blue-500">
        Ciphers
    </a>
    <a href="https://github.com/mihai-valentin/ciphers"
       class="transition duration-500 ease text-white font-bold hover:text-blue-500"
       target="_blank">
        View on Github
    </a>
</div>
<div class="flex justify-center mt-10">
    <div class="text-center p-2 rounded bg-green-500 text-white fon">
        <p>Success</p>
        <p>Your hash: {{ $hash }}</p>
    </div>
</div>
</body>
</html>
