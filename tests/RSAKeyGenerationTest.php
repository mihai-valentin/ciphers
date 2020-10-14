<?php

use App\Ciphers\Keys\RSAKey;

/**
 * Class RSAKeyGenerationTest
 */
class RSAKeyGenerationTest extends TestCase
{
    public function testKnownKeyGeneration()
    {
        $rsaKey = new RSAKey();
        $keys = $rsaKey->generate('7, 19');

        self::assertEquals(
            [
                'public' => [
                    'e' => 5,
                    'n' => 133
                ],
                'private' => [
                    'd' => 65,
                    'n' => 133
                ]
            ],
            $keys
        );
    }
}
