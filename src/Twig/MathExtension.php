<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MathExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('round', function ($number) {
                return round($number);
            }),
        ];
    }

}
