<?php


namespace App\Ciphers;


class LatinAlphabet
{
    private const LENGTH = 26;
    private const A_ORD = 65;
    private const FIRST_LETTER = 'A';
    private const LAST_LETTER = 'Z';

    public function all(): array
    {
        return range(self::FIRST_LETTER, self::LAST_LETTER);
    }

    public function from(int $start): array
    {
        $start = $this->normalizeOffset($start);
        $firstLetter = chr(self::A_ORD + $start);

        return range($firstLetter, self::LAST_LETTER);
    }

    public function to(int $end): array
    {
        $end = $this->normalizeOffset($end);
        $lastLetter = chr(self::A_ORD + $end);

        return range(self::FIRST_LETTER, $lastLetter);
    }

    private function normalizeOffset(int $step): int
    {
        if ($step < 0) {
            return self::LENGTH + $step - 1;
        }

        return $step - 1;
    }
}
