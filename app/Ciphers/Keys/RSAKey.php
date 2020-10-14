<?php


namespace App\Ciphers\Keys;


use Exception;
use function random_int;

class RSAKey implements Key
{
    private int $m;
    private int $e;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function generate($settings)
    {
        [$p, $q] = explode(',', str_replace(' ', '', $settings));

        $n = $p * $q;
        $this->m = ($p - 1) * ($q - 1);

        $this->e = $this->getE();
        $d = $this->getD();

        return [
            'public'  => [
                'e' => $this->e,
                'n' => $n
            ],
            'private' => [
                'd' => $d,
                'n' => $n
            ]
        ];
    }

    private function getE(): int
    {
        $e = 2;
        for ($newE = $e; $e < $this->m; $newE++) {
            $found = true;

            for ($divider = 2; $divider < $this->m / 2; $divider++) {
                if ($newE % $divider !== 0 || $this->m % $divider !== 0) {
                    continue;
                }

                $found = false;
                break;
            }

            if (!$found) {
                continue;
            }

            $e = $newE;
            break;
        }

        return $e;
    }

    private function getD(): int
    {
        $d = 1;
        for (; $d <= $this->m; $d++) {
            if (($d * $this->e) % $this->m === 1) {
                return $d;
            }
        }

        return $d;
    }
}
