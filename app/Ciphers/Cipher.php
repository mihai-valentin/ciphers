<?php


namespace App\Ciphers;

/**
 * Interface Cipher
 * @package App\Ciphers
 */
interface Cipher
{
    public function encrypt(string $input, $key): string;

    public function decrypt(string $input, $key): string;
}
