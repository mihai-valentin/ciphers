<?php


namespace App\Ciphers\Keys;

/**
 * Interface Key
 * @package App\Ciphers\Keys
 */
interface Key
{
    /**
     * @param $settings
     * @return mixed
     */
    public function generate($settings);
}
