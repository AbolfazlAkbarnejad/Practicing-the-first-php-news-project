<?php

namespace App;

use database\database;
use PDO;


class App
{
    public $currentDomain = CURRENT_DOMAIN;
    public $basePath = BASE_PATH;




    protected function redirect($url)
    {
        header('Location: ' . trim($this->currentDomain, '/ ') . '/' . trim($url, '/ '));
        exit;
    }


    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function index()
    {
        $db = new database();
        $selecteds = $db->select("SELECT posts.* ,(SELECT COUNT(*) FROM coments WHERE posts.id = coments.post_id)AS countComment FROM posts WHERE selected = 'yes' ORDER BY id DESC LIMIT 0, 4");

        $comments = $db->select("SELECT posts.* ,(SELECT COUNT(*) FROM coments WHERE posts.id = coments.post_id )AS countComment FROM posts ORDER BY countComment DESC LIMIT 0, 4");
        $populars  = $db->select("SELECT posts.* ,(SELECT COUNT(*) FROM coments WHERE posts.id = coments.post_id )AS countComment ,(SELECT name FROM catgoreis WHERE posts.cat_id = catgoreis.id)AS catgory FROM posts ORDER BY view DESC LIMIT 0, 4")->fetchAll();
        $catgoreis = $db->select("SELECT catgoreis . * ,(SELECT COUNT(*) FROM posts WHERE catgoreis.id = posts.cat_id)AS countPost FROM catgoreis ORDER BY id DESC LIMIT 0,11");

        $posts = $db->select("SELECT posts.* ,(SELECT COUNT(*) FROM coments WHERE posts.id = coments.post_id)AS countComment FROM posts  ORDER BY id DESC LIMIT 0, 8");
        $news_hots = $db->select("SELECT * FROM posts WHERE news_hot = 'enable' ORDER BY id DESC LIMIT 0,3");
        $banners = $db->select("SELECT * FROM baners WHERE status = 'anable' AND expiry_date > NOW()  ORDER BY  Priority   DESC LIMIT 0,2")->fetchAll();
        $likes = $db->select("SELECT * FROM note WHERE status = 'enable' ORDER BY id DESC LIMIT 0,7")->fetchAll();



        //note
        $check_time = $db->select("SELECT * FROM note WHERE Limitation <= now() ")->fetchAll();
        // dd($check_time);

        foreach ($check_time as $s) {
            if ($check_time) {

                $db->delete("note", $s["id"]);
            }
        }

        require_once(BASE_PATH . "/template/app/index.php");
    }


    public function show($id)
    {
        $db = new database();
        $this->view($id);
        $view = $db->select("SELECT * FROM posts WHERE id = ?", [$id])->fetch();
        // dd($view);

        $check_post = $db->select("SELECT * FROM posts WHERE id = ? ", [$id])->fetch();
        $post = $db->select("SELECT posts.* ,(SELECT COUNT(*) FROM coments WHERE posts.id = coments.post_id)AS countComment , (SELECT name FROM catgoreis WHERE posts.cat_id = catgoreis.id)AS nameCatgory FROM posts  WHERE id =? ORDER BY id DESC LIMIT 0, 8", [$id])->fetch();
        if ($check_post) {
            require_once(BASE_PATH . "/template/app/show.php");
        } else {
            $this->redirect("/");
        }
    }


    public function catgory($id)
    {
        $db = new database();
        // $cc =$id;
        $check_catgory = $db->select("SELECT * FROM catgoreis WHERE id = ?", [$id])->fetch();
        $countCatgory = $db->select("SELECT * FROM posts WHERE cat_id = ?", [$check_catgory["id"]])->fetchAll();
        if ($check_catgory) {
            $posts = $db->select("SELECT posts.* ,(SELECT name FROM catgoreis WHERE catgoreis.id = '$id' )AS catgory ,(SELECT COUNT(*) FROM coments WHERE posts.id = coments.post_id)AS countComment  FROM posts WHERE posts.cat_id = ? ORDER BY id DESC LIMIT 0,8", [$id])->fetchAll();
            $catgoreis = $db->select("SELECT catgoreis . * ,(SELECT COUNT(*) FROM posts WHERE catgoreis.id = posts.cat_id)AS countPost FROM catgoreis ORDER BY id DESC LIMIT 0,11");

            require_once(BASE_PATH . "/template/app/catgory.php");
        } else {
            $this->redirect("");
        }
    }


    public function navgation($catgory_id, $nav_id)
    {
        $db = new database;
        // dd($grop);
        $check_catgory = $db->select("SELECT * FROM catgoreis WHERE id = ?", [$catgory_id])->fetch();
        $countCatgory = $db->select("SELECT * FROM posts WHERE cat_id = ?", [$check_catgory["id"]])->fetchAll();
        $po = $db->select("SELECT COUNT(*) FROM posts  WHERE cat_id = ?", [$catgory_id])->fetch();
        $s1 = $nav_id * 6 - 6;
        $posts = $db->select("SELECT posts.* ,(SELECT name FROM catgoreis WHERE catgoreis.id = '$catgory_id' )AS catgory ,(SELECT COUNT(*) FROM coments WHERE posts.id = coments.post_id)AS countComment  FROM posts WHERE posts.cat_id = ? ORDER BY id DESC LIMIT $s1,6", [$catgory_id])->fetchAll();
        $catgoreis = $db->select("SELECT catgoreis . * ,(SELECT COUNT(*) FROM posts WHERE catgoreis.id = posts.cat_id)AS countPost FROM catgoreis ORDER BY id DESC LIMIT 0,11");
        // $set = $po["COUNT(*)"] / 6.1;
        $set2 = $po["COUNT(*)"] / 6.1;
        $mah = explode(".", $set2)[0];

        if (!$check_catgory) {
            $this->redirect("/");
        } elseif (empty($posts)) {
            $this->redirect("/");
        } else {
            require_once(BASE_PATH . "/template/app/catgory.php");
        }
    }

    public function sendComment($reuest, $id)
    {
        $db = new database();
        if (empty($reuest["user_name"]) or empty($reuest["user_email"]) or empty($reuest["comment"])) {
            flash("error_sendComment", "فیلد های پایین باید کامل پر شوند");
            $this->redirect("show/{id}");
        } elseif (!filter_var($reuest["user_email"], FILTER_VALIDATE_EMAIL)) {

            flash("error_sendComment", "ایمیل معتبری را وارد کنید");
            $this->redirectBack();
        } else {

            $reuest["post_id"] = $id;
            $req = htmlspecialchars($reuest["user_name"]);
            // dd(array_keys($reuest));
            $array = array_combine(array_keys($reuest), $reuest);
            $specialRequest = array_map("htmlspecialchars", $reuest);
            $db->insert("coments", array_keys($specialRequest), $specialRequest);

            flash("error_sendComment", "ایمیل شما ارسال شد");

            $this->redirectBack();
        }
    }

    public function like($id)
    {
        $db = new database();
        $check_like = $db->select("SELECT * FROM note  WHERE id = ? ", [$id])->fetch();

        if ($check_like) {
            if ($_COOKIE["like_" . $id] == 0) {
                Setcookie('like_' . $id, '1', time() + (60 * 60 * 24), "/");
                $d =   $db->update("note", $id, ["like"], [$check_like["like"] + 1]);
                // dd($d);
                $this->redirectBack();
            } elseif ($_COOKIE["like_" . $id] == 1) {
                Setcookie('like_' . $id, '0', time() + (60 * 60 * 24), "/");
                $d = $db->update("note", $id, ["like"], [$check_like["like"] - 1]);
                $this->redirectBack();
            }
        }
    }
    public function delete_note()
    {
        $db = new database();

        $check_time = $db->select("SELECT * FROM note WHERE Limitation < now() ")->fetchAll();
        dd($check_time);
        foreach ($check_time as $s) {
            if ($s) {

                $db->delete("note", $s["id"]);
            }
        }
    }
    public function view($id)
    {
        $db = new database();
        if (!isset($_COOKIE["view_" . $id])) {
            setcookie("view_" . $id, '1', time() + (60 * 60 * 24 * 365), "/");
            $view = $db->select("SELECT * FROM posts WHERE id = ?", [$id])->fetch();
            $db->update("posts", $id, ["view"], [$view["view"] + 1]);
        }
    }
}
