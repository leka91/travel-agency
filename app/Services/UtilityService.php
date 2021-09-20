<?php

namespace App\Services;

use Illuminate\Support\Str;

class UtilityService
{
    public static function checkForExistingRows($records, $model) 
    {   
        $recordsArr = [];

        foreach ($records as $record) {
            $existingRecord = $model::find($record);

            if (is_null($existingRecord)) {
                $newRecord = $model::create([
                    'name' => $record,
                    'slug' => Str::slug($record)
                ]);
                $recordsArr[] = (string) $newRecord->id; 
                continue;
            }

            $recordsArr[] = $record;
        }

        return $recordsArr;
    }
}
