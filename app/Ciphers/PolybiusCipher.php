<?php

namespace App\Ciphers;

use App\Ciphers\Keys\PolybiusKey;

/**
 * Class PolybiusCipher
 * @package App\Ciphers
 */
class PolybiusCipher implements Cipher
{
    /**
     * @inheritDoc
     */
    public function encrypt(string $input, $key): string
    {
        $input = str_replace('J', 'I', strtoupper($input));
        $key = app(PolybiusKey::class)->generate($key);

        $plainText = str_split($input);
        $encryptedText = '';
        foreach ($plainText as $letter) {
            if ($letter === ' ') {
                continue;
            }
            $position = $key['alphabet'][$letter];
            $row = $position % $key['keys_size'];
            $column = (int)($position / $key['keys_size']);
            $encryptedText .= "{$key['keys'][$column]}{$key['keys'][$row]} ";
        }

        return $encryptedText;
    }

    /**
     * @inheritDoc
     */
    public function decrypt(string $input, $key): string
    {
        $coordinates = explode(' ', strtoupper($input));
        $key = app(PolybiusKey::class)->generate($key);

        $plainText = '';
        foreach ($coordinates as $coordinate) {
            [$x, $y] = str_split($coordinate);
            $plainText .= $key['matrix'][$x][$y];
        }

        return $plainText;
    }
}
