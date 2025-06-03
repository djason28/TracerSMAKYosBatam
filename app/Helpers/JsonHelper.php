<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class JsonHelper
{
    public static function updateCitiesJson($newCity)
    {
        $path = public_path('data/cities.json');

        if (!File::exists($path)) {
            File::put($path, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        $cities = json_decode(File::get($path), true) ?? [];

        // Pastikan data array dan unik (case-insensitive)
        $exists = collect($cities)->contains(function ($item) use ($newCity) {
            return strtolower($item) === strtolower($newCity);
        });

        if (!$exists && $newCity) {
            $cities[] = $newCity;
            sort($cities); // Optional: urutkan
            File::put($path, json_encode($cities, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }



    public static function updateUnivJson($newUniv)
    {
        $path = public_path('data/universities.json');

        if (!File::exists($path)) {
            File::put($path, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        $Univs = json_decode(File::get($path), true) ?? [];

        // Pastikan data array dan unik (case-insensitive)
        $exists = collect($Univs)->contains(function ($item) use ($newUniv) {
            return strtolower($item) === strtolower($newUniv);
        });

        if (!$exists && $newUniv) {
            $Univs[] = $newUniv;
            sort($Univs); // Optional: urutkan
            File::put($path, json_encode($Univs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }


    public static function updateMajorsJson($newMajors)
    {
        $path = public_path('data/majors.json');

        if (!File::exists($path)) {
            File::put($path, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        $Majors = json_decode(File::get($path), true) ?? [];

        // Pastikan data array dan unik (case-insensitive)
        $exists = collect($Majors)->contains(function ($item) use ($newMajors) {
            return strtolower($item) === strtolower($newMajors);
        });

        if (!$exists && $newMajors) {
            $Majors[] = $newMajors;
            sort($Majors); // Optional: urutkan
            File::put($path, json_encode($Majors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }



}
