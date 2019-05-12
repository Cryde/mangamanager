<?php

namespace App\Service;

class BookArrayValidator
{
    private $requiredFields = [
        'title',
        'type_id',
        'status_id',
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
