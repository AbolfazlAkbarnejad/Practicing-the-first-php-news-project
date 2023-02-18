<?php

namespace Admin;

use Auth\Auth;
use database\database;

class Admin
{

    public $currentDomain;
    public $basePath;

    function __construct()
    {
        $db = new Auth;
        $db->check_admin();


        $this->currentDomain = CURRENT_DOMAIN;
        $this->basePath = BASE_PATH;
    }


    protected function redirect($url)
    {
        header('Location: ' . trim($this->currentDomain, '/ ') . '/' . trim($url, '/ '));
        exit;
    }

    protected function direct($According_to, $fils, $index, $index_2, $index_3)
    {
        $Direction1 = explode($According_to, $fils)[$index];
        $Direction2 = explode($According_to, $fils)[$index_2];
        $Direction3 = explode($According_to, $fils)[$index_3];
        return $Direction1 . "/" . $Direction2 . "/" . $Direction3;
    }

    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    protected function saveImage($image, $imagePath, $imageName = null)
    {

        if ($imageName) {
            $extension = explode('/', $image['type'])[1];
            $imageName = $imageName . '.' . $extension;
        } else {
            $extension = explode('/', $image['type'])[1];
            $imageName = date("Y-m-d-H-i-s") . '.' . $extension;
        }

        $imageTemp = $image['tmp_name'];
        $imagePath = 'public/' . $imagePath . '/';

        if (is_uploaded_file($imageTemp)) {
            if (move_uploaded_file($imageTemp, $imagePath . $imageName)) {
                return $imagePath . $imageName;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    protected function removeImage($path)
    {
        $path = trim($this->basePath, '/ ') . '/' . trim($path, '/ ');
        if (file_exists($path)) {
            unlink($path);
        }
    }

    // protected function logAoth()
    // {
    //     dd('s');
    //     $_SESSION["User"] = "";

    //     unset($_COOKIE["login"]);
    //     // setcookie("login", NULL, -1, "/");
    // }
}
