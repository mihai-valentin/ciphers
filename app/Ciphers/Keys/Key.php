<?php


namespace App\Ciphers\Keys;


interface Key
{
    public function generate($settings);
}
