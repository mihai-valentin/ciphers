<?php


namespace App\Ciphers;

use App\Ciphers\Keys\RSAKey;

/**
 * Class RSACipher
 * @package App\Ciphers
 */
class RSACipher implements Cipher
{
    /**
     * @inheritDoc
     */
    public function encrypt(string $input, $key): string
    {
        $publicKey = app(RSAKey::class)->generate($key)['public'];

        $input = strtoupper(str_replace(' ', '', $input));
        $plainText = str_split($input);

        $encryptedText = [];
        foreach ($plainText as $char) {
            $position = app(LatinAlphabet::class)->getPosition($char);
            $encryptedText[] = ($position ** $publicKey['e']) % $publicKey['n'];
        }

        return implode('::', $encryptedText);
    }

    /**
     * @inheritDoc
     */
    public function decrypt(string $input, $key): string
    {
        $privateKey = app(RSAKey::class)->generate($key)['private'];
        $encryptedText = array_map('\intval', explode('::', $input));

        $decryptedText = '';

        foreach ($encryptedText as $code) {
            $position = $this->powerModulo((int)$code, $privateKey['d'], $privateKey['n']);
            $decryptedText .= app(LatinAlphabet::class)->getLetter($position);
        }

        return $decryptedText;
    }

    private function powerModulo(int $base, int $exp, int $mod): int
    {
        $result = 1;
        while ($exp > 2) {
            if ($exp % 2 !== 0) {
                $result *= $base;
                $exp--;
            }
            $exp /= 2;
            $base = ($base ** 2) % $mod;
        }

        return $result * ($base ** 2 % $mod) % $mod;
    }
}
