<?php

namespace Admin;

use database\database;

class Post extends Admin
{

    public function index()
    {
        $db = new database();
        // $posts = $db->select("SELECT * FROM posts")->fetchAll();
        $posts = $db->select("SELECT posts.* ,(SELECT name FROM catgoreis WHERE posts.cat_id = catgoreis.id )AS catgory ,(SELECT username FROM users WHERE posts.admin_id = users.id) AS usersname FROM posts ORDER BY created_at DESC");
        $check_newsHot = $db->select("SELECT COUNT(*) FROM posts WHERE news_hot = 'enable' ")->fetch();

        require_once BASE_PATH . "/template/admin/posts/index.php";
    }

    public function create()
    {
        $db = new database();
        $catgorys = $db->select("SELECT * FROM catgoreis")->fetchAll();

        require_once BASE_PATH . "/template/admin/posts/create.php";
    }

    public function store($request)
    {
        date_default_timezone_set('Iran');
        $specialRequest = array_map("htmlspecialchars", $request);
        $db = new database();
        $type = explode("/", $request["image"]['type'])[1];
        if (!empty($request)) {
            if ($type == "jpeg" or $type == "png") {

                $specialRequest["admin_id"] = $_SESSION["user"];
                $specialRequest["image"] =  $this->saveImage($request["image"], "post_image");

                $d =  $db->insert("posts", array_keys($specialRequest), $specialRequest);
                // dd($d);
                $this->redirect("admin/post");
            } else {
                flash("error_post", "تایپ فایل نادرست است");
                $this->redirectBack();
            }
        }
    }


    public function delete($id)
    {
        $db  = new database;

        $post = $db->select("SELECT * FROM posts WHERE id = ?", [$id])->fetch();

        if ($post) {
            $db->delete("posts", $id);
            $this->removeImage($post["image"]);
            $this->redirectBack();
        } else {
            $this->redirectBack();
        }
    }

    public function selected($id)
    {
        $db  = new database;

        $post = $db->select("SELECT * FROM posts WHERE id = ?", [$id])->fetch();

        if ($post["selected"] == "no") {
            $db->update("posts", $id, ["selected"], ["yes"]);
            $this->redirectBack();
        } else {
            $db->update("posts", $id, ["selected"], ["no"]);
            $this->redirectBack();
        }
    }


    public function edit($id)
    {
        $db  = new database;
        $post = $db->select("SELECT * FROM posts WHERE id = ?", [$id])->fetch();
        $catgorys = $db->select("SELECT * FROM catgoreis")->fetchAll();

        if ($post) {
            require_once(BASE_PATH . "/template/admin/posts/edit.php");
        } else {
            $this->redirect("admin/post");
        }
    }


    public function update($request, $id)
    {
        date_default_timezone_set('Iran');

        $db  = new database;
        $post = $db->select("SELECT * FROM posts WHERE id = ?", [$id])->fetch();
        $specialRequest = array_map("htmlspecialchars", $request);
        $catgorys = $db->select("SELECT * FROM catgoreis")->fetchAll();
        $type = explode("/", $request["image"]['type'])[1];
        if ($post) {

            if (!empty($request["image"]["name"])) {

                if ($type == "jpeg" or $type == "png") {
                    $specialRequest["image"] = $this->saveImage($request["image"], "post_image");
                    $this->removeImage($post["image"]);
                } else {
                    flash("error_post", "تایپ فایل نا مناسب است");
                    $this->redirectBack();
                }
            } else {
                $specialRequest["image"] = $post["image"];
            }
            $db->update("posts", $id, array_keys($specialRequest), ($specialRequest));
            $this->redirect("admin/post");
        } else {
            $this->redirect("admin/post");
        }
    }


    public function newshot($id)
    {

        $db  = new database;
        $post = $db->select("SELECT * FROM posts WHERE id = ?", [$id])->fetch();

        if ($post) {
            // dd($post["news_hot"]);
            if ($post["news_hot"] == "enable") {
                $d =    $db->update("posts", $id, ["news_hot"], ["desable"]);

                $this->redirect("admin/post");
            } else {
                $db->update("posts", $id, ["news_hot"], ["enable"]);
                $this->redirect("admin/post");
            }
        } else {
            $this->redirect("admin/post");
        }
    }
}
