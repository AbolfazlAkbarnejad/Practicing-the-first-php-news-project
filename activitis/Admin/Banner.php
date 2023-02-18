<?php

namespace Admin;

use database\database;

class Banner extends Admin
{
    public function index()
    {
        $db = new database();
        $banners = $db->select("SELECT * FROM baners");
        require_once(BASE_PATH  . "/template/admin/baner/index.php");
    }

    public function create()
    {
        require_once(BASE_PATH  . "/template/admin/baner/create.php");
    }

    public function store($request)
    {
        $type_file = explode('/', $request["image"]["type"])[1];
        // dd($type_file);
        $specialRequest = array_map("htmlspecialchars", $request);

        if (empty($request)) {
            $this->redirect("admin/banner/create");
            flash("error_banner", "فیلد های پایین باید کامل پر شوند");

        } elseif ($request["image"]["size"] > 11100000) {
            // dd($request["image"]['size']);
            flash("error_banner", "اندازه فایل وارد شده بیشتر از حد مجاز است");
            $this->redirect("admin/banner/create");
        } else {
            $db = new database();
            if ($request["status"] == 1) {
                $specialRequest["status"] = "anable";
            } else {
                $specialRequest["status"] = "desable";
            }


            date_default_timezone_set('Iran');
            $specialRequest["image"] = $this->saveImage($request["image"], "banner_image");

            $realTimestampt = substr($request['expiry_date'], 0, 10);
            $specialRequest['expiry_date'] = date("Y-m-d H:i:s", (int)$realTimestampt);
            $db->insert("baners", array_keys($specialRequest), $specialRequest);
            $this->redirect("admin/banner");
        }
    }
    public function delete($id)
    {
        $db = new database();
        $banners = $db->select("SELECT * FROM baners WHERE id = ?", [$id])->fetch();
        if ($banners) {
            $db->delete("baners", $id);
            $this->redirect("admin/banner");
        } else {
            $this->redirect("admin/banner");
        }
    }

    public function status($id)
    {
        $db = new database();
        $banners = $db->select("SELECT * FROM baners WHERE id = ?", [$id])->fetch();
        if ($banners) {
            if ($banners["status"] == "anable") {
                $db->update("baners", $id, ["status"], ["desable"]);
                $this->redirect("admin/banner");
            } else {
                $db->update("baners", $id, ["status"], ["anable"]);
                $this->redirect("admin/banner");
            }
        } else {
            $this->redirect("admin/banner");
        }
    }


    public function edit($id)
    {
        $db = new database();
        $banners = $db->select("SELECT * FROM baners WHERE id = ?", [$id])->fetch();
        if ($banners) {
            require_once(BASE_PATH   . "/template/admin/baner/edit.php");
        } else {
            $this->redirect("admin/banner");
        }
    }

    public function update($request, $id)
    {
        $db = new database();
        $banners = $db->select("SELECT * FROM baners WHERE id = ?", [$id])->fetch();
        $type_file = explode('/', $request["image"]["type"])[1];
        $specialRequest = array_map("htmlspecialchars", $request);

        if ($banners) {

            if (empty($request)) {
                flash("updateBanner_error", "تمام فیلد های پایین باید کامل پر شوند");
                $this->redirect("admin/banner/edit/{id}");
            } else {
                if (!empty($request["image"]["name"])) {

                    if ($type_file == "jpeg") {
                        $specialRequest["image"] = $this->saveImage($request["image"], "banner_image");
                    }
                } else {
                    $specialRequest["image"] = $banners["image"];
                }
            }

            if ($request["status"] == 1) {
                $specialRequest["status"] = "anable";
            } else {
                $specialRequest["status"] = "desable";
            }

            date_default_timezone_set('Iran');
            $realTimestampt = substr($request['expiry_date'], 0, 10);
            $specialRequest['expiry_date'] = date("Y-m-d H:i:s", (int)$realTimestampt);


            $db->update("baners", $id, array_keys($specialRequest), $specialRequest);
            $this->redirect("admin/banner");
        } else {

            $this->redirect("admin/banner");
        }
    }
}
