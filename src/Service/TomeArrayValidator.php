<?php

namespace App\Service;

class TomeArrayValidator
{
    private $requiredFields = [
        'title',
        'book_id',
        'number',
        'publication_datetime',
        'description',
        'cover_url',
    ];

    public function validate(array $data)
    {
        foreach ($this->requiredFields as $requiredField) {
            if (!isset($data[$requiredField])) {
                throw new \InvalidArgumentException('Missing field : ' . $requiredField);
            }
        }

        if(!\DateTime::createFromFormat(\DateTimeInterface::ISO8601, $data['publication_datetime']))  {
            throw new \InvalidArgumentException('Invalid data in field : publication_datetime');
        }
    }
}
