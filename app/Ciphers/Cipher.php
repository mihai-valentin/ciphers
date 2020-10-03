<?php


namespace App\Ciphers;

use App\Exceptions\CipherKeyException;

/**
 * Interface Cipher
 * @package App\Ciphers
 */
interface Cipher
{
    /**
     * @param string $input
     * @param $key
     * @return string
     * @throws CipherKeyException
     */
    public function encrypt(string $input, $key): string;

    /**
     * @param string $input
     * @param $key
     * @return string
     * @throws CipherKeyException
     */
    public function decrypt(string $input, $key): string;
}
