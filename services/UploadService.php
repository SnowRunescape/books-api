<?php

namespace app\services;

use Yii;

class UploadService
{
    public function upload(array $config)
    {
        $file = $config['file'];
        $maxFileSize = $config['max_file_size'];
        $acceptedFormats = $config['accepted_formats'];

        if (empty($file)) {
            throw new \Exception('No file provided.');
        }

        if (!in_array($file->extension, $acceptedFormats)) {
            throw new \Exception('Invalid file format.');
        }

        if ($file->size > ($maxFileSize * 1024 * 1024)) {
            throw new \Exception('File is too large.');
        }

        $fileName = bin2hex(random_bytes(16)) . '.' . $file->extension;

        $fileContent = file_get_contents($file->tempName);

        Yii::$app->flysystem->write($fileName, $fileContent);

        return $fileName;
    }
}
