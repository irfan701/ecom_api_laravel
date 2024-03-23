<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Throwable;

class UtilityService
{
    function MailProcess($request, $className)
    {
        try {
            return Mail::to($request)->send($className);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    function FileProcess($file_URL)
    {
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $file_URL->getClientOriginalExtension();
        $file_path = "upload/products/" . $name_gen;
        $img = $manager->read($file_URL)->resize(370, 246);
        $img->toJpeg(90)->save($file_path);
        return $this->ChangeURLName($file_path);
    }

    function ChangeURLName($fileName)
    {
        $name1 = explode('/', $fileName)[1];
        $name2 = explode('/', $fileName)[2];
        $generateName = 'upload' . '/' . $name1 . '/' . $name2;
        return "http://" . $_SERVER['HTTP_HOST'] . '/' . $generateName;
    }

    function ExplodeURLName($oldFile, $indexNumber)
    {
        return explode('/', $oldFile)[$indexNumber];
    }

    public function RemoveFile($pathName, $old_db_file)
    {
        $old_file = $this->ExplodeURLName($old_db_file, 5);
        if (File::exists(public_path($pathName . $old_file))) {
            return File::delete(public_path($pathName . $old_file));

        }
    }

    function QuickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
