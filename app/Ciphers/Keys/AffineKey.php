<?php


namespace App\Ciphers\Keys;

use App\Ciphers\LatinAlphabet;
use App\Exceptions\AffineCipherInvalidKeyException;

/**
 * Class AffineKey
 * @package App\Ciphers\Keys
 */
class AffineKey implements Key
{
    /**
     * @var mixed|string
     */
    private $a;
    /**
     * @var mixed|string
     */
    private $b;

    /**
     * @inheritDoc
     * @return array
     * @throws AffineCipherInvalidKeyException
     */
    public function generate($settings): array
    {
        [$this->a, $this->b] = explode(',', str_replace(' ', '', $settings));

        $this->checkInput($settings);
        $this->checkA();

        return [
            'a' => $this->a,
            'b' => $this->b
        ];
    }

    /**
     * @param $settings
     * @throws AffineCipherInvalidKeyException
     */
    private function checkInput($settings): void
    {
        $this->a = (int)$this->a;
        $this->b = (int)$this->b;
        if (empty($this->a) || empty($this->b)) {
            throw new AffineCipherInvalidKeyException("Invalid input for cipher key: [{$settings}]");
        }
    }

    /**
     * @return $this
     * @throws AffineCipherInvalidKeyException
     */
    private function checkA(): self
    {
        return $this
            ->compareAWithAlphabetLength()
            ->findCommonDividers();
    }

    /**
     * @return $this
     * @throws AffineCipherInvalidKeyException
     */
    private function compareAWithAlphabetLength(): self
    {
        $alphabetLength = LatinAlphabet::LENGTH;
        if ($this->a < 1 || $this->a > $alphabetLength) {
            throw new AffineCipherInvalidKeyException("Key part a [{$this->a}] is greater than [{$alphabetLength}].");
        }

        return $this;
    }

    /**
     * @return $this
     * @throws AffineCipherInvalidKeyException
     */
    private function findCommonDividers(): self
    {
        $alphabetLength = LatinAlphabet::LENGTH;
        $dividersCount = 0;
        foreach (range(2, $alphabetLength - 1) as $number) {
            if ($this->a % $number === 0 && $alphabetLength % $number === 0) {
                $dividersCount++;
            }
        }

        if (!empty($dividersCount)) {
            throw new AffineCipherInvalidKeyException("Key part a [{$this->a}] is invalid.");
        }

        return $this;
    }

    /**
     * @param int $a
     * @return int
     */
    public function getInvertedA(int $a): int
    {
        foreach (range(0, LatinAlphabet::LENGTH) as $number) {
            if (($a * $number) % 26 === 1) {
                return $number;
            }
        }

        return 1;
    }
}
