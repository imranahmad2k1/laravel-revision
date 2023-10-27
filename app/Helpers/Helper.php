<?php
namespace App\Helpers;

class Helper{
    public static function pictureUpload($file){
        // Saving File Locally and Getting File Path to Store in Database
        $filename = "pfp".uniqid().'.'.$file->getClientOriginalExtension();
        $directory = "profile_pictures";
        $file_path = $file->storeAs($directory, $filename, 'public');
        return $file_path;
    }

    public static function getCountries(){
        return ['Pakistan', 'Afghanistan', 'Turkey', 'China', 'Malaysia'];
    }
}