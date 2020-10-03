<?php

namespace App\Ciphers\Keys;

use App\Ciphers\LatinAlphabet;
use function count;

/**
 * Class PolybiusKey
 * @package App\Ciphers\Keys
 */
class PolybiusKey implements Key
{
    private const KEYS = [
        'a' => [
            'from' => 'A',
            'to'   => 'E'
        ],
        '1' => [
            'from' => 1,
            'to'   => 5
        ]
    ];

    /**
     * @inheritDoc
     */
    public function generate($settings)
    {
        $settings = strtolower($settings);
        $alphabet = app(LatinAlphabet::class)->without(['J']);
        $keys = range(self::KEYS[$settings]['from'], self::KEYS[$settings]['to']);
        $size = count($keys);

        $lettersMatrix = [];
        for ($row = 0; $row < 5; $row++) {
            for ($column = 0; $column < 5; $column++) {
                $lettersMatrix[$keys[$row]][$keys[$column]] = $alphabet[$size * $row + $column];
            }
        }

        return [
            'alphabet'  => array_flip($alphabet),
            'keys'      => $keys,
            'keys_size' => $size,
            'matrix'    => $lettersMatrix
        ];
    }
}
