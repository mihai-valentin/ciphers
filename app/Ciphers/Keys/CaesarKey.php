<?php


namespace App\Ciphers\Keys;


use App\Ciphers\LatinAlphabet;

class CaesarKey implements Key
{
    /**
     * @param $step
     * @return array
     */
    public function generate($step): array
    {
        $step = (int)$step;
        if ($step < 0) {
            return $this->toRight($step);
        }

        return $this->toLeft($step);
    }

    private function toLeft(int $step): array
    {
        $thrown = app(LatinAlphabet::class)->to($step);
        $shifted = app(LatinAlphabet::class)->from($step);
        array_shift($shifted);

        return array_merge($shifted, $thrown);
    }

    private function toRight(int $step): array
    {
        $shifted = app(LatinAlphabet::class)->to($step);
        $thrown = app(LatinAlphabet::class)->from($step);
        array_shift($thrown);

        return array_merge($thrown, $shifted);
    }
}
