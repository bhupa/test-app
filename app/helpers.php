<?php 
use Illuminate\Support\Facades\Storage;


function uploadImageStoragePublic($image,$foldername){
    
    

    if ($image != '') {
        $disk = Storage::disk('public');
        $disk->put($image->store($foldername), file_get_contents($image));

        $imagepath = $disk->url($image->store($foldername));
    } else {
        $imagepath = '';
    }

    return $imagepath;

}
