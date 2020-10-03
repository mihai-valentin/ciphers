<?php


namespace App\Ciphers;

use App\Ciphers\Keys\CaesarKey;

/**
 * Class Caesar
 * @package App\Ciphers
 */
class CaesarCipher implements Cipher
{
    /**
     * @param string $input
     * @param $key
     * @return string
     */
    public function encrypt(string $input, $key): string
    {
        $input = strtoupper($input);
        $key = app(CaesarKey::class)->generate($key);
        $alphabet = array_flip(app(LatinAlphabet::class)->all());

        $plainText = str_split($input);
        $encryptedText = '';
        foreach ($plainText as $char) {
            if ($char === ' ') {
                $encryptedText .= ' ';
                continue;
            }

            $encryptedText .= $key[$alphabet[$char]];
        }

        return $encryptedText;
    }

    /**
     * @param string $input
     * @param $key
     * @return string
     */
    public function decrypt(string $input, $key): string
    {
        $input = strtoupper($input);
        $key = array_flip(app(CaesarKey::class)->generate($key));

        $encryptedText = str_split($input);
        $plainText = '';
        foreach ($encryptedText as $char) {
            if ($char === ' ') {
                $plainText .= ' ';
                continue;
            }

            $plainText .= app(LatinAlphabet::class)->getLetter($key[$char]);
        }

        return $plainText;
    }
}
