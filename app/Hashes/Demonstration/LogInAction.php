<?php

namespace App\Hashes\Demonstration;

use App\Hashes\Sha256;

/**
 * Class LogInAction
 * @package App\Hashes\Demonstration
 */
class LogInAction
{
    public function handle(string $login, string $password): bool
    {
        $passwordHash = app(UsersFake::class)->retrieve($login);

        return app(Sha256::class)->apply($password) === $passwordHash;
    }
}
