<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

trait FileTrait
{
    // Upload image form
    public function uploadFile($request, $fileUpload, $pathUpload, $oldFile = "")
    {
        if ($request->hasFile($fileUpload)) {
            $pathUpload = env('APP_ENV') === 'local' ? $pathUpload : base_path() . '/' . 'public_html/' .$pathUpload;
            // save file
            $fileExtension = $request->file($fileUpload)->getClientOriginalExtension();
            $fileName = time() . rand() . "." . strtolower($fileExtension);
            $request->file($fileUpload)->move($pathUpload, $fileName);
            $this->removeFile(public_path($pathUpload) . $oldFile);
            
            return $fileName;
        }
        return $oldFile;
    }

    // Image base64
    public function createImageBase64($image, $folderPath, $oldFile = "")
    {
        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $imageName = time() . rand() . '.'. $image_type;

        Storage::disk('public_path')->put($folderPath . $imageName, base64_decode($image_parts[1]));

        $pathRemove = env('APP_ENV') === 'local' ? public_path($folderPath) : base_path() . DIRECTORY_SEPARATOR . 'public_html/' . $folderPath;

        $this->removeFile($pathRemove . $oldFile);
        
        return $imageName;
    }

    public function deleteImage($folderPath, $oldFile = "")
    {
        $pathRemove = env('APP_ENV') === 'local' ? public_path($folderPath) : base_path() . DIRECTORY_SEPARATOR . 'public_html/' . $folderPath;

        $this->removeFile($pathRemove . $oldFile);
        
        return null;
    }

    public function removeFile($pathImg)
    {
        if (is_file($pathImg)) {
            unlink($pathImg);
        }
    }

    // get image
    public function getImage($image, $folderPath)
    {
        $imageURL = "";

        $isFile = $folderPath . $image;
        $imageDefault = $folderPath . 'default.png';
        $imageURL = is_file($isFile) ? $isFile :  $imageDefault;

        return URL::to($imageURL);
    }
}