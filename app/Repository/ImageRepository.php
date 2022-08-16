<?php

namespace App\Repository;

use File;
use Image;

class ImageRepository
{
   public function saveImage($request, $path)
   {
      if ($request->hasFile('image')) {
         $this->createDirectory($path);
         $file = $request['image'];
         $image = Image::make($file);
         $imagename = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
         $image->save($this->imagePath . $imagename);
         $image->resize(400, 400);
         $image->save($this->thumbnailPath . $imagename);
         return $imagename;
      }
   }

   public function saveMultipleImage($file, $path)
   {
      $this->createDirectory($path);
      $image = Image::make($file);
      $imagename = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
      $image->save($this->imagePath . $imagename);
      $image->resize(400, 400);
      $image->save($this->thumbnailPath . $imagename);
      return $imagename;
   }

   public function createDirectory($path)
   {
      $paths = [
         'image_path' => public_path("uploads/images/" . $path . "/"),
         'thumbnail_path' => public_path("uploads/images/" . $path . "/thumbnail/"),
      ];
      foreach ($paths as $path) {
         if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
         }
         $this->imagePath = $paths['image_path'];
         $this->thumbnailPath = $paths['thumbnail_path'];
      }
   }

   public function removeImage($image, $path)
   {
      $paths = [
         'image_path' => public_path("uploads/images/" . $path . "/"),
         'thumbnail_image_path' => public_path("uploads/images/" . $path . "/thumbnail/"),
      ];

      foreach ($paths as $path) {
         if (file_exists($path . $image['image'])) {
            unlink($path . $image['image']);
         }
      }
   }
}
