<?php

namespace App\Models\Repositories;

use App\Models\Star;

class StarRepository
{
    /**
     * Store the new star and save it.
     *
     * @param array $data The data used to store the star.
     * @param string $imageName The name of the image of the star.
     *
     * @return \App\Models\Star
     */
    public static function store(array $data, string $imageName): Star
    {
        return Star::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'image' => $imageName,
            'description' => $data['description']
        ]);
    }
}
