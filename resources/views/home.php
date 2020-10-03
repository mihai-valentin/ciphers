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
<div class="flex flex-col md:flex-row flex-wrap">
    <div class="m-2">
        <a href="/cipher/caesar"
           class="flex py-2 px-5 bg-yellow-400 rounded-lg shadow-md hover:shadow-lg transition  duration-500 ease">
            <div class="flex-shrink-0">
                <img class="h-12" src="/public/img/caesar.jpg" alt="Caesar">
            </div>
            <div class="ml-3 flex items-center">
                <h4 class="text-xl text-gray-900">Caesar cipher</h4>
            </div>
        </a>
    </div>
    <div class="m-2">
        <a href="/cipher/affine"
           class="flex py-2 px-5 bg-pink-400 rounded-lg shadow-md hover:shadow-lg transition  duration-500 ease">
            <div class="flex-shrink-0">
                <img class="h-12" src="/public/img/affine.jpg" alt="Affine">
            </div>
            <div class="ml-3 flex items-center">
                <h4 class="text-xl text-gray-900">Affine cipher</h4>
            </div>
        </a>
    </div>
    <div class="m-2">
        <a href="/cipher/polybius"
           class="flex py-2 px-5 bg-green-400 rounded-lg shadow-md hover:shadow-lg transition  duration-500 ease">
            <div class="flex-shrink-0">
                <img class="h-12" src="/public/img/polybius.jpg" alt="Polybius">
            </div>
            <div class="ml-3 flex items-center">
                <h4 class="text-xl text-gray-900">Polybius cipher</h4>
            </div>
        </a>
    </div>
</div>
</body>
</html>
