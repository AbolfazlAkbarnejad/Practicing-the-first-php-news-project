<?php

namespace Admin;

use database\database;

class Setting extends Admin
{
    public function index()
    {
        $db = new database;
        $setting = $db->select("SELECT * FROM setting")->fetch();
        //user check Lider
        //save in Admin.php
        $this->checkLider();

        require_once(BASE_PATH . "/template/admin/Setting/index.php");
    }


    public function show_set()
    {
        $db = new database;
        $setting = $db->select("SELECT * FROM setting")->fetch();
        //user check Lider
        $this->checkLider();
        require_once(BASE_PATH . "/template/admin/Setting/set.php");
    }


    public function set($request)
    {
        $db = new database;
        $setting = $db->select("SELECT * FROM setting")->fetch();
        $specialRequest = array_map("htmlspecialchars", $request);

        //user check Lider
        $this->checkLider();

        if (empty($request["logo"]["name"])) {
            $specialRequest["logo"] = $setting["logo"];
        }

        if (empty($request["icon"]["name"])) {
            $specialRequest["icon"] = $setting["icon"];
        }
        if (empty($request)) {
            flash("error_update_setting", "فیلد های پایین باید کامل پر شوند");
            $this->redirectBack();
        } else {
            if (!empty($request["logo"]["name"])) {
                $specialRequest["logo"] = $this->saveImage($request["logo"], "setting", "logo2");
            }
            if (!empty($request["icon"]["name"])) {

                $specialRequest["icon"] = $this->saveImage($request["icon"], "setting", "icon2");
            }
            // dd($request);
            $specialRequest["text_footer"] = $request["text_footer"];
            $specialRequest["phone_number"] = $request["phone_number"];
            $db->update("setting", 1, array_keys($specialRequest), $specialRequest);
            $this->redirect("admin/setting");
        }
    }

    public function checkLider()
    {
        $db = new database;
        $user = $db->select("SELECT * FROM users WHERE id = ?", [$_SESSION["user"]])->fetch();
        if ($user["position"] == "lider") {
        } else {
            $this->redirect("admin");
        }
    }
}
