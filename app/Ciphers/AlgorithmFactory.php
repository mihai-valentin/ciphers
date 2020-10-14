<?php


namespace App\Ciphers;

/**
 * Class AlgorithmFactory
 * @package App\Ciphers
 */
class AlgorithmFactory
{
    private const ALGORITHMS = [
        'caesar'   => CaesarCipher::class,
        'affine'   => AffineCipher::class,
        'polybius' => PolybiusCipher::class,
        'playfair' => PlayfairCipher::class,
        'vigenere' => VigenereCipher::class,
        'rsa'      => RSACipher::class,
    ];

    public static function get(string $type): Cipher
    {
        return app(self::ALGORITHMS[$type]);
    }
}
