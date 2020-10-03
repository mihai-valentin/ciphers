<?php

use App\Ciphers\Caesar;

class CaesarCipherTest extends TestCase
{
    public function testCaesarEncryption(): void
    {
        $encryptedText = app(Caesar::class)->encrypt('cAeSaR', 3);

        self::assertEquals('FDHVDU', $encryptedText);
    }

    public function testCaesarEncryptionWithZeroKey(): void
    {
        $encryptedText = app(Caesar::class)->encrypt('cAeSaR', 0);

        self::assertEquals('CAESAR', $encryptedText);
    }

    public function testCaesarEncryptionWithOverlappingKey(): void
    {
        $encryptedText = app(Caesar::class)->encrypt('cAeSaR', 27);

        self::assertEquals('BZDRZQ', $encryptedText);
    }

    public function testCaesarEncryptionWithLongInput(): void
    {
        $longInput = 'cAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaRcAeSaR';
        $encryptedLongInput = 'FDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDUFDHVDU';
        $encryptedText = app(Caesar::class)->encrypt($longInput, 3);

        self::assertEquals($encryptedLongInput, $encryptedText);
    }

    public function testCaesarDecryption(): void
    {
        $encryptedText = app(Caesar::class)->decrypt('FDHVDU', 3);

        self::assertEquals('CAESAR', $encryptedText);
    }
}
