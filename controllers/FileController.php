<?php


//https://code.tutsplus.com/tutorials/how-to-upload-a-file-in-php-with-example--cms-31763
class FileController
{
    const DOCUMENT_DIR = "./upload/document/";
    const DOCUMENT_MAX_SIZE = 1024 * 1024 * 2;

    public function uploadDocument()
    {
        if (isset($_FILES) && !empty($_FILES) && count($_FILES) == 1) {
            $allowedFileExtensions = [
                'jpeg', 'jpg', 'png', 'gif',
                'docx', 'doc', 'xlsx', 'xls', 'ppt', 'pptx',
                'pdf', 'txt'
            ];

            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            if (!in_array($fileExtension, $allowedFileExtensions)) {
                return Output::returnWithErrorMessage(Lang::get("error_file_extension"));
            }

            if ($fileSize > self::DOCUMENT_MAX_SIZE) {
                return Output::returnWithErrorMessage(Lang::get("error_file_size", (self::DOCUMENT_MAX_SIZE / 1024 / 1024)));
            }

            $uploadURL = null;

            do {
                $uploadURL = md5(time() . $fileName) . "." . $fileExtension;
            } while (file_exists(self::DOCUMENT_DIR . $uploadURL));

            if (move_uploaded_file($fileTmpPath, self::DOCUMENT_DIR . $uploadURL)) {
                return Output::returnWithData($uploadURL);
            } else {
                return Output::returnWithErrorMessage(Lang::get('error_file_upload'));
            }
        } else {
            return new Output(false, Lang::get('no_file'));
        }
    }
}