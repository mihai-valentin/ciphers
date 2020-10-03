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
    <form action="/cipher"
          method="post"
          class="w-4/5 md:w-auto flex items-center flex-col justify-center items-center bg-gray-200 py-10 px-5  rounded shadow-lg">
        <input type="hidden" name="type" value="{{ $type }}">
        <h2 class="text-center text-lg font-bold text-green-500 mb-10">
            {{ ucfirst($type) }} cipher
        </h2>
        @if (!empty($result))
            <div class="mb-5 p-3 rounded-lg shadow-lg bg-green-300">
                Result: {{ $result }}
            </div>
        @endif
        <div class="flex flex-col justify-center items-center mb-5">
            <label for="input_text">Initial text</label>
            <textarea name="input_text"
                      id="input_text"
                      cols="20"
                      rows="3"
                      class="resize-none rounded-lg p-2 border shadow"
                      placeholder="{{ $type }}..."
                      required>{{ $initialText ?? '' }}</textarea>
        </div>
        <div class="flex flex-col justify-center items-center mb-5">
            <label for="key">Key</label>
            <input type="text"
                   name="key"
                   id="key"
                   class="resize-none rounded-lg p-2 border shadow"
                   value="{{ $key ?? '' }}"
                   placeholder="Key..."
                   required>
        </div>
        <div class="flex flex-col mb-5">
            <div class="flex items-center">
                <label for="operation_encrypt" class="mr-2">Encrypt</label>
                <input type="radio"
                       name="operation_type"
                       id="operation_encrypt"
                       value="encrypt"
                       required>
            </div>
            <div class="flex items-center">
                <label for="operation_decrypt" class="mr-2">Decrypt</label>
                <input type="radio"
                       name="operation_type"
                       id="operation_decrypt"
                       value="decrypt"
                       required>
            </div>
        </div>
        <button type="submit"
                name="cipher"
                value="execute"
                class="border shadow px-5 py-2 rounded bg-blue-500 text-white focus:outline-none focus:shadow-outline mb-5">
            Execute
        </button>
    </form>
</div>
</body>
</html>
