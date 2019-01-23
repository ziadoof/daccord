<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 16/01/19
 * Time: 15:52
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        if ($file !==null){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            try {
                $file->move($this->getTargetDirectory(), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            return $fileName;
        }
        else
            return null;

    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}