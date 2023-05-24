<?php

namespace Reval;

class BoxHelper
{
    public function calculateVolumeInCm3(array $box): float
    {
        $volume = array_product($box['dimensions']) / 1000;

        return (float)$volume;
    }

    public function sortBoxesByVolume(array $boxes): array
    {
        $boxVolume = array_column($boxes, 'volumeCm3');
        array_multisort($boxVolume, SORT_ASC, $boxes);

        return $boxes;
    }
}
