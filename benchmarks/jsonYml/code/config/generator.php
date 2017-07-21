<?php

/**
 * Faker Configuration to Generate dinamically data for JSON and YAML
 *
 * @see https://github.com/fzaninotto/Faker
 */

return [
    'address' => [
        'cityPrefix' => ['Address@cityPrefix'],
        'secondaryAddress' => ['Address@secondaryAddress'],
        'state' => ['Address@state'],
        'stateAbbr' => ['Address@stateAbbr'],
        'city' => ['Address@city'],
        'streetName' => ['Address@streetName'],
        'streetAddress' => ['Address@streetAddress'],
        'postcode' => ['Address@postcode'],
        'address' => ['Address@address'],
        'country' => ['Address@country'],
        'latitude' => ['Address@latitude'],
        'longitude' => ['Address@longitude']
    ],
    'person' => [
        'gender' => ['Base@randomElement', [['male', 'female']]],
        'title' => ['Person@title'],
        'firstName' => ['Person@firstName'],
        'lastName' => ['Person@lastName'],
        'phoneNumber' => ['PhoneNumber@phoneNumber']
    ],
    'company' => [
        'catchPhrase' => ['Company@catchPhrase'],
        'company' => ['Company@company'],
        'companySuffix' => ['Company@companySuffix'],
        'jobTitle' => ['Company@jobTitle']
    ]
];