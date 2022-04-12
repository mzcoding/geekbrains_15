<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;

class UploadService
{
   public function uploadFile(UploadedFile $file): string
   {
       $completedFile = $file->storeAs('news', $file->hashName(), 'public');
	   if(!$completedFile) {
		   throw new Exception("File wasn't upload");
	   }

	   return $completedFile;
   }
}