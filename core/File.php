<?php


class File
{
    public function __construct()
    {
    }

    public function setFile(array $file, $relativePath, $customName = "")
    {
        if ($file['size'] > 0) {
            $path = PROOT . DS . 'images' . DS . $relativePath;
            $nameArray = explode(".", $file['name']);
            $extension = end($nameArray);
            $filename = empty($customName) ? $file['name'] : $customName . "." . $extension;
            $nameArray = explode(".", $filename);
            array_pop($nameArray);
            $name = join(".", $nameArray);
            $newName = $name;

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (file_exists($path . "/" . $filename)) {
                $newPath = $path . "/" . $filename;
                $i = 1;
                while (file_exists($newPath)) {
                    $newPath = $path . "/" . $name . "-$i." . $extension;
                    $newName = $name . "-$i";
                    $i++;
                }
            }

            $destination = $path . "/" . $newName . "." . $extension;

            if (copy($file['tmp_name'], $destination)) {
                if (!file_exists($destination)) {
                    return false;
                } else {
                    $this->extension = $extension;
                    $this->fileName = $newName . "." . $extension;
                    $this->path = $relativePath;
                    return true;
                }
            }
        }
        return false;
    }


    public static function remapMultiFile(array $file)
    {
        return array_map(function ($name, $type, $tmp_name, $error, $size) {
            return array(
                'name' => $name,
                'type' => $type,
                'tmp_name' => $tmp_name,
                'error' => $error,
                'size' => $size,
            );
        }, (array)$file['name'],
            (array)$file['type'],
            (array)$file['tmp_name'],
            (array)$file['error'],
            (array)$file['size']);
    }

    private function validateImage($file)
    {
        $valid = true;
        if (!empty($file['tmp_name'])) { // no image
            if (!getimagesize($file['tmp_name'])) {
                $valid = false;
            }
            if ($file['size'] > 5000000) { //can not be over 5 MB
                $valid = false;
            }
        }
        return $valid;
    }

    private function validateMultipleImages(array $files)
    {
        $valid = true;
        foreach ($files as $file) {
            if (!$this->validateImage($file)) {
                $valid = false;
            }
        }
        return $valid;
    }
}