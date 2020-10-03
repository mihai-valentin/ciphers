<?php


namespace App\Ciphers;

use App\Ciphers\Keys\CaesarKey;

/**
 * Class Caesar
 * @package App\Ciphers
 */
class Caesar implements Cipher
{
    public function encrypt(string $input, $key): string
    {
        $input = strtoupper($input);
        $key = app(CaesarKey::class)->generate($key);
        $alphabet = array_flip(app(LatinAlphabet::class)->all());

        $plainText = str_split($input);
        $encryptedText = '';
        foreach ($plainText as $char) {
            $encryptedText .= $key[$alphabet[$char]];
        }

        return $encryptedText;
    }

    public function decrypt(string $input, $key): string
    {
        $input = strtoupper($input);
        $key = array_flip(app(CaesarKey::class)->generate($key));
        $alphabet = app(LatinAlphabet::class)->all();

        $encryptedText = str_split($input);
        $plainText = '';
        foreach ($encryptedText as $char) {
            $plainText .= $alphabet[$key[$char]];
        }

        return $plainText;
    }
}
