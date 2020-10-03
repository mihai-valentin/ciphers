<?php


namespace App\Ciphers;

use App\Ciphers\Keys\AffineKey;
use App\Exceptions\AffineCipherInvalidKeyException;
use App\Exceptions\CipherKeyException;

/**
 * Class AffineCipher
 * @package App\Ciphers
 */
class AffineCipher implements Cipher
{
    /**
     * @param string $input
     * @param $key
     * @return string
     * @throws CipherKeyException
     */
    public function encrypt(string $input, $key): string
    {
        $input = strtoupper($input);
        $key = $this->validateKey($key);

        $alphabet = array_flip(app(LatinAlphabet::class)->all());
        $plainText = str_split($input);

        $encryptedText = '';
        foreach ($plainText as $letter) {
            if ($letter === ' ') {
                $encryptedText .= ' ';
                continue;
            }

            $encryptedPosition = ($key['a'] * $alphabet[$letter] + $key['b']) % LatinAlphabet::LENGTH;
            $encryptedText .= app(LatinAlphabet::class)->getLetter($encryptedPosition);
        }

        return $encryptedText;
    }

    /**
     * @param string $input
     * @param $key
     * @return string
     * @throws CipherKeyException
     */
    public function decrypt(string $input, $key): string
    {
        $input = strtoupper($input);
        $key = $this->validateKey($key);
        $key['a'] = app(AffineKey::class)->getInvertedA($key['a']);

        $alphabet = array_flip(app(LatinAlphabet::class)->all());
        $encryptedText = str_split($input);

        $plainText = '';
        foreach ($encryptedText as $letter) {
            if ($letter === ' ') {
                $plainText .= ' ';
                continue;
            }

            $decryptedPosition = $key['a'] * ($alphabet[$letter] - $key['b']) % LatinAlphabet::LENGTH;
            $plainText .= app(LatinAlphabet::class)->getLetter($decryptedPosition);
        }

        return $plainText;
    }

    /**
     * @param $key
     * @return array
     * @throws CipherKeyException
     */
    private function validateKey($key): array
    {
        try {
            $key = app(AffineKey::class)->generate($key);
        } catch (AffineCipherInvalidKeyException $exception) {
            throw new CipherKeyException($exception->getMessage());
        }
        return $key;
    }
}
