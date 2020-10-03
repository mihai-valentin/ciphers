<?php

namespace App\Ciphers;

use function chr;
use function in_array;
use function ord;

/**
 * Class LatinAlphabet
 * @package App\Ciphers
 */
class LatinAlphabet
{
    public const LENGTH = 26;

    private const FIRST_LETTER_ORD = 65;

    private const FIRST_LETTER = 'A';

    private const LAST_LETTER = 'Z';

    public function all(): array
    {
        return range(self::FIRST_LETTER, self::LAST_LETTER);
    }

    public function without(array $excluded): array
    {
        $filteredList = array_filter($this->all(), static function ($letter) use ($excluded) {
            return !in_array($letter, $excluded, true);
        });

        return array_values($filteredList);
    }

    public function from(int $start): array
    {
        $start = $this->normalizeOffset($start);
        $firstLetter = chr(self::FIRST_LETTER_ORD + $start);

        return range($firstLetter, self::LAST_LETTER);
    }

    public function to(int $end): array
    {
        $end = $this->normalizeOffset($end);
        $lastLetter = chr(self::FIRST_LETTER_ORD + $end);

        return range(self::FIRST_LETTER, $lastLetter);
    }

    private function normalizeOffset(int $step): int
    {
        if ($step < 0) {
            return self::LENGTH + $step - 1;
        }

        return $step - 1;
    }

    public function getLetter(int $position): string
    {
        if ($position < 0) {
            $position = self::LENGTH + $position;
        }

        return chr(self::FIRST_LETTER_ORD + $position);
    }

    public function getPosition(string $letter): int
    {
        return ord($letter) - self::FIRST_LETTER_ORD;
    }
}
