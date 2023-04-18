<?php

namespace App\Models\Repositories;

use App\Models\Star;

class StarRepository
{
    /**
     * Store the new star and save it.
     *
     * @param array $data The data used to store the star.
     *
     * @return \App\Models\Star
     */
    public static function store(array $data): Star
    {
        return Star::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'image' => $data['image_path'],
            'description' => $data['description']
        ]);
    }

    /**
     * Update the star data and save it.
     *
     * @param array $data The data used to update the star.
     * @param \App\Models\Star $star The star to update.
     *
     * @return \App\Models\Star
     */
    public static function update(array $data, Star $star): Star
    {
        $star->first_name = $data['first_name'];
        $star->last_name = $data['last_name'];
        $star->image = isset($data['image_path']) ? $data['image_path'] : $star->image;
        $star->description = $data['description'];
        $star->save();

        return $star;
    }
}
