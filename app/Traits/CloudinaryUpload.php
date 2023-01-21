<?php

namespace App\Traits;

trait CloudinaryUpload
{
   protected function uploadImage($file, $folder)
   {
      $result = $file->storeOnCloudinary('superoagrobase/' . $folder);
      $image = [
         'img_url' => $result->getSecurePath(),
         'img_id' => $result->getPublicId(),
      ];
      return json_encode($image);
   }
   protected function searchImage($public_id)
   {
      $result = cloudinary()->search()->expression('public_id=' . $public_id)->execute();
      return $result;
   }
   protected function deleteImage($public_id)
   {
      $result = cloudinary()->uploadApi()->destroy($public_id);
      return $result;
   }
}