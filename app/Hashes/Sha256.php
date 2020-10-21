<?php

namespace App\Hashes;

/**
 * Class Sha256
 * @package App\Hashes
 */
class Sha256
{
    public function apply(string $input): string
    {
        return hash('sha256', $input);
    }
}
