<?php


namespace App\Services;


class FilePathProvider
{

    /**
     * @param $directory
     *
     * @return array
     */
    public function provideFilePathsByDirectory($directory): array
    {
        $files = [];
        foreach (scandir($directory) as $f) {
            if ($f != "." && $f != "..") {
                $files [] = $directory.DIRECTORY_SEPARATOR.$f;
            }
        }

        return $files;
    }

}
