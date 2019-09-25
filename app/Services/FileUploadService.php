<?php 

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class FileUploadService {
	
	protected $destination = '';
	
	 public function __construct()
    {
		$this->destination = public_path('uploads');
	}
	
	/**
     * Upload files
     *
     * @params file,type
     * @return boolean
     */
	public function upload($file,$type)
    {
        $originalFileName = $file->getClientOriginalName();
        $encryptedFileName = $this->getUniqueFilename($originalFileName);
        $mimeType = $file->getMimeType();
        $fileSize = $file->getClientSize();
		if($type == 'user_profile'){
			$this->destination = $this->destination.'/users';
			$basePath = asset('uploads/users');
			$filePath = public_path('uploads/users');
		}else{
			$this->destination = $this->destination.'/media';
			$basePath = asset('uploads/media');
			$filePath = public_path('uploads/media');
		}
		if( Auth::guard('api')->check() ){
			$user = Auth::guard('api')->user();
			$user_id = $user->id;
		}else{
			$user_id = 0;
		}
        if($file->move($this->destination, $encryptedFileName)) {
			Image::make($filePath.'/'. $encryptedFileName)->resize(null, 350, function ($constraint) {$constraint->aspectRatio();$constraint->upsize();})
						->save($filePath.'/'. $encryptedFileName);
			$uploadedFileInfo = [
                'name'       => $originalFileName,
				'size'       => $fileSize,
				'extension'  => $file->getClientOriginalExtension(),
				'file_path'  => $basePath .'/'. $encryptedFileName,
                'mime_type'  => $mimeType,
				'usage_type' => $type,
				'user_id'    => $user_id
            ];
			
			//$uploadedFileInfo['file_id'] = $storage->id;
            return $uploadedFileInfo;
        }

        return false;
    }
	
	/**
     * function to generate unique filename for files.
     *
     * @param string $filename
     *
     * @return string
     */
    protected function getUniqueFilename($filename)
    {
        $uniqueName = uniqid();
        $fileext = explode('.', $filename);
        $mimeType = end($fileext);
        $filename = $uniqueName.'.'.$mimeType;

        return $filename;
    }
}