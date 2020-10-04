<?php

namespace App\Ciphers\Keys;

/**
 * Class VigenereKey
 * @package App\Ciphers\Keys
 */
class VigenereKey implements Key
{
    /**
     * @inheritDoc
     */
    public function generate($settings)
    {
        $settings = strtoupper(str_replace(' ', '', $settings));

        return str_split($settings);
    }
}
