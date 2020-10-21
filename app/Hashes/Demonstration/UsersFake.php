<?php

namespace App\Hashes\Demonstration;

use RuntimeException;

/**
 * Class UsersFake
 * @package App\Hashes\Demonstration
 */
class UsersFake
{
    private const USERS = [
        'valentin-mihai' => 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad',
        'guest'          => 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'
    ];

    public function retrieve(string $login): string
    {
        if (empty(self::USERS[$login])) {
            throw new RuntimeException('User not found.');
        }

        return self::USERS[$login];
    }
}
