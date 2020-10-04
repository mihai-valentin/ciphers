<?php

namespace App\Ciphers\Keys;

use App\Ciphers\LatinAlphabet;
use function array_slice;
use function count;

/**
 * Class PlayfairKey
 * @package App\Ciphers\Keys
 */
class PlayfairKey implements Key
{
    public const MATRIX_ORDER = 5;

    /**
     * @inheritDoc
     */
    public function generate($settings)
    {
        $secreteWord = $this->normalizeSecreteWord($settings);
        $alphabet = app(LatinAlphabet::class)->without([...$secreteWord, 'J']);
        $alphabet = array_merge($secreteWord, $alphabet);

        $matrix = [];
        for ($row = 0; $row < self::MATRIX_ORDER; $row++) {
            for ($column = 0; $column < self::MATRIX_ORDER; $column++) {
                $matrix[$row][$column] = $alphabet[self::MATRIX_ORDER * $row + $column];
            }
        }

        return [
            'alphabet' => array_flip($alphabet),
            'matrix'   => $matrix
        ];
    }

    private function normalizeSecreteWord(string $settings): array
    {
        $settings = strtoupper($settings);
        $secreteWord = array_slice(str_split($settings), 0, LatinAlphabet::LENGTH - 1);

        return array_keys(array_flip($secreteWord));
    }
}
