<?php


namespace App\Ciphers;


class AlgorithmFactory
{
    private const ALGORITHMS = [
        'caesar' => Caesar::class
    ];

    public static function get(string $type): Cipher
    {
        return app(self::ALGORITHMS[$type]);
    }
}
