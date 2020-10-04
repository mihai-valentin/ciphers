<?php

namespace App\Ciphers;

use App\Ciphers\Keys\PlayfairKey;
use function count;

/**
 * Class PlayfairCipher
 * @package App\Ciphers
 */
class PlayfairCipher implements Cipher
{
    /**
     * @inheritDoc
     */
    public function encrypt(string $input, $key): string
    {
        $key = app(PlayfairKey::class)->generate($key);
        $plainText = $this->normalizeInput($input);
        $charsCount = count($plainText);

        $encryptedText = '';
        for ($index = 0; $index < $charsCount; $index += 2) {
            $coordinates = $this->getCoordinates($key['alphabet'], $plainText, $index);
            $coordinates = $this->normalizeCoordinatesForEncryption($coordinates);

            $encryptedText .= $key['matrix'][$coordinates[0]['y']][$coordinates[1]['x']];
            $encryptedText .= $key['matrix'][$coordinates[1]['y']][$coordinates[0]['x']];
        }

        return $encryptedText;
    }

    /**
     * @inheritDoc
     */
    public function decrypt(string $input, $key): string
    {
        $key = app(PlayfairKey::class)->generate($key);
        $plainText = $this->normalizeInput($input);
        $charsCount = count($plainText);

        $encryptedText = '';
        for ($index = 0; $index < $charsCount; $index += 2) {
            $coordinates = $this->getCoordinates($key['alphabet'], $plainText, $index);
            $coordinates = $this->normalizeCoordinatesForDecryption($coordinates);

            $encryptedText .= $key['matrix'][$coordinates[0]['y']][$coordinates[1]['x']];
            $encryptedText .= $key['matrix'][$coordinates[1]['y']][$coordinates[0]['x']];
        }

        return $encryptedText;
    }

    private function normalizeInput(string $input): array
    {
        $input = str_replace(' ', '', strtoupper($input));

        $normalized = [];
        $plainText = str_split($input);

        $charsCount = count($plainText);
        for ($index = 0; $index < $charsCount - 1; $index += 2) {
            $normalized[] = $plainText[$index];
            if ($plainText[$index] === $plainText[$index + 1]) {
                $normalized[] = 'X';
            }
            $normalized[] = $plainText[$index + 1];
        }
        if (count($plainText) % 2 !== 0) {
            $normalized[] = end($plainText);
        }

        if (count($normalized) % 2 !== 0) {
            $normalized[] = 'X';
        }

        return $normalized;
    }

    private function getCoordinates(array $alphabet, array $encryptedText, int $index): array
    {
        $first = $alphabet[$encryptedText[$index]];
        $second = $alphabet[$encryptedText[$index + 1]];

        return [
            [
                'x' => $first % PlayfairKey::MATRIX_ORDER,
                'y' => (int)($first / PlayfairKey::MATRIX_ORDER)
            ],
            [
                'x' => $second % PlayfairKey::MATRIX_ORDER,
                'y' => (int)($second / PlayfairKey::MATRIX_ORDER)
            ]
        ];
    }

    private function normalizeCoordinatesForDecryption(array $coordinates): array
    {
        if ($coordinates[0]['y'] === $coordinates[1]['y']) {
            [$coordinates[1]['x'], $coordinates[0]['x']] = [--$coordinates[0]['x'], --$coordinates[1]['x']];
            if ($coordinates[0]['x'] < 0) {
                $coordinates[0]['x'] = PlayfairKey::MATRIX_ORDER - 1;
            }
            if ($coordinates[1]['x'] < 0) {
                $coordinates[1]['x'] = PlayfairKey::MATRIX_ORDER - 1;
            }
        } elseif ($coordinates[0]['x'] === $coordinates[1]['x']) {
            [$coordinates[0]['y'], $coordinates[1]['y']] = [--$coordinates[0]['y'], --$coordinates[1]['y']];
            if ($coordinates[0]['y'] < 0) {
                $coordinates[0]['y'] = PlayfairKey::MATRIX_ORDER - 1;
            }
            if ($coordinates[1]['y'] < 0) {
                $coordinates[1]['y'] = PlayfairKey::MATRIX_ORDER - 1;
            }
        }

        return $coordinates;
    }

    private function normalizeCoordinatesForEncryption(array $coordinates): array
    {
        if ($coordinates[0]['y'] === $coordinates[1]['y']) {
            [$coordinates[1]['x'], $coordinates[0]['x']] = [++$coordinates[0]['x'], ++$coordinates[1]['x']];
            if ($coordinates[0]['x'] >= PlayfairKey::MATRIX_ORDER) {
                $coordinates[0]['x'] = 0;
            }
            if ($coordinates[1]['x'] >= PlayfairKey::MATRIX_ORDER) {
                $coordinates[1]['x'] = 0;
            }
        } elseif ($coordinates[0]['x'] === $coordinates[1]['x']) {
            [$coordinates[0]['y'], $coordinates[1]['y']] = [++$coordinates[0]['y'], ++$coordinates[1]['y']];
            if ($coordinates[0]['y'] >= PlayfairKey::MATRIX_ORDER) {
                $coordinates[0]['y'] = 0;
            }
            if ($coordinates[1]['y'] >= PlayfairKey::MATRIX_ORDER) {
                $coordinates[1]['y'] = 0;
            }

        }

        return $coordinates;
    }
}
