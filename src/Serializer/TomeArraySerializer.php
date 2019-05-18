<?php

namespace App\Serializer;

use App\Entity\Tome;

class TomeArraySerializer
{
    public function toArray(Tome $tome)
    {
        return [
            'id' => $tome->getId(),
            'title' => $tome->getTitle(),
        ];
    }
}
