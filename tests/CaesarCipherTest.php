<?php

use App\Ciphers\CaesarCipher;

class CaesarCipherTest extends TestCase
{
    public function testCaesarEncryption(): void
    {
        $encryptedText = app(CaesarCipher::class)->encrypt('cAeSaR', 3);

        self::assertEquals('FDHVDU', $encryptedText);
    }

    public function testCaesarEncryptionWithZeroKey(): void
    {
        $encryptedText = app(CaesarCipher::class)->encrypt('cAeSaR', 0);

        self::assertEquals('CAESAR', $encryptedText);
    }

    public function testCaesarEncryptionWithOverlappingKey(): void
    {
        $encryptedText = app(CaesarCipher::class)->encrypt('cAeSaR', 27);

        self::assertEquals('BZDRZQ', $encryptedText);
    }

    public function testCaesarEncryptionWithLongInput(): void
    {
        $longInput = 'cAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaR';
        $encryptedLongInput = 'FDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDU';
        $encryptedText = app(CaesarCipher::class)->encrypt($longInput, 3);

        self::assertEquals($encryptedLongInput, $encryptedText);
    }

    public function testCaesarDecryption(): void
    {
        $encryptedText = app(CaesarCipher::class)->decrypt('FDHVDU', 3);

        self::assertEquals('CAESAR', $encryptedText);
    }
}
