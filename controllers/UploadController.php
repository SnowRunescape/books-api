<?php

namespace app\controllers;

use app\services\UploadService;
use yii\rest\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    const MAX_FILE_SIZE_MB = 2;
    const ACCEPTED_FILE_FORMATS = ['jpg', 'png'];

    public function actionIndex()
    {
        $fileName = (new UploadService())->upload([
            'file' => UploadedFile::getInstanceByName('file'),
            'max_file_size' => self::MAX_FILE_SIZE_MB,
            'accepted_formats' => self::ACCEPTED_FILE_FORMATS,
        ]);

        $this->asJson([
            "file" => $fileName,
        ]);
    }
}
