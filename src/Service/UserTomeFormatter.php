<?php

namespace App\Service;

use App\Entity\UserTome;

class UserTomeFormatter
{
    /**
     * @param array|UserTome[] $userTomes
     *
     * @return array
     */
    public function formatFromList(array $userTomes)
    {
        $result = [];

        foreach ($userTomes as $userTome) {
            $result[$userTome->getTome()->getId()] = $userTome;
        }

        return $result;
    }
}
