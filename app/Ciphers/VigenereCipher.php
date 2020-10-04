<?php

namespace App\Ciphers;

use App\Ciphers\Keys\VigenereKey;
use function count;

/**
 * Class VigenereCipher
 * @package App\Ciphers
 */
class VigenereCipher implements Cipher
{
    /**
     * @inheritDoc
     */
    public function encrypt(string $input, $key): string
    {
        $key = app(VigenereKey::class)->generate($key);
        $input = strtoupper(str_replace(' ', '', $input));
        $plainText = str_split($input);
        $secreteWord = $this->getSecreteWord($plainText, $key);

        $encryptedText = '';
        foreach ($plainText as $index => $letter) {
            $plainPosition = app(LatinAlphabet::class)->getPosition($letter);
            $secretePosition = app(LatinAlphabet::class)->getPosition($secreteWord[$index]);
            $encryptedPosition = $plainPosition + $secretePosition;
            if ($encryptedPosition >= LatinAlphabet::LENGTH) {
                $encryptedPosition -= LatinAlphabet::LENGTH;
            }

            $encryptedText .= app(LatinAlphabet::class)->getLetter($encryptedPosition);
        }

        return $encryptedText;
    }

    /**
     * @inheritDoc
     */
    public function decrypt(string $input, $key): string
    {
        $key = app(VigenereKey::class)->generate($key);
        $input = strtoupper(str_replace(' ', '', $input));
        $encryptedText = str_split($input);
        $secreteWord = $this->getSecreteWord($encryptedText, $key);

        $plainText = '';
        foreach ($encryptedText as $index => $letter) {
            $encryptedPosition = app(LatinAlphabet::class)->getPosition($letter);
            $secretePosition = app(LatinAlphabet::class)->getPosition($secreteWord[$index]);
            $plainPosition = $encryptedPosition - $secretePosition;
            if ($plainPosition < 0) {
                $plainPosition += LatinAlphabet::LENGTH;
            }

            $plainText .= app(LatinAlphabet::class)->getLetter($plainPosition);
        }

        return $plainText;
    }

    /**
     * @param array $text
     * @param array $key
     * @return array
     */
    private function getSecreteWord(array $text, array $key): array
    {
        $secreteWord = [];
        $keyLength = count($key);
        foreach (range(0, count($text) - 1) as $index) {
            $position = $index - (int)($index / $keyLength) * $keyLength;
            $secreteWord[] = $key[(int)$position];
        }

        return $secreteWord;
    }
}
