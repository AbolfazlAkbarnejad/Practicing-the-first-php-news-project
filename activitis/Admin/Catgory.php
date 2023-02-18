<?php

namespace Admin;

use database\database;

class Category extends Admin
{
    public function index()
    {
        $db = new database();
        // $catgoreis = $db->select("SELECT * FROM catgoreis")->fetchAll();
        $catgoreis = $db->select("SELECT  catgoreis . * ,(SELECT COUNT(*) FROM posts WHERE catgoreis.id = posts.cat_id)AS countPost FROM catgoreis ORDER BY id")->fetchAll();
        require_once BASE_PATH . "/template/admin/catgoreis/index.php";
    }

    public function create()
    {
        require_once BASE_PATH . "/template/admin/catgoreis/create.php";
    }


    public function store($request)
    {
        $db = new database();

        $catgory = $db->select("SELECT * FROM catgoreis WHERE name = ?", [$request['name']])->fetchAll();
        $specialRequest = array_map("htmlspecialchars", $request);

        if (!empty($request["name"]) && !$catgory) {

            $db->insert("catgoreis", array_keys($specialRequest), $specialRequest);
            $this->redirect("admin/catgory");
        } else {
            // $this->redirect("admin/catgory");
        }
    }


    public function edit($id)
    {
        $db = new database();
        $catgory = $db->select("SELECT * FROM catgoreis WHERE id  = ?", [$id])->fetch();
        if ($catgory) {
            require_once BASE_PATH . "/template/admin/catgoreis/edit.php";
        } else {
            $this->redirect("admin/catgory");
        }
    }


    public function delete($id)
    {
        $db = new database();
        $catgory = $db->select("SELECT * FROM catgoreis WHERE id  = ?", [$id])->fetch();
        $cont_post = $db->select("SELECT COUNT(*) FROM posts WHERE cat_id = ?", [$catgory["id"]])->fetch();
        if (!$catgory) {
            $this->redirect("admin/catgory");
        } elseif (!empty($cont_post["COUNT(*)"])) {
            flash("error_cargory", "تا زمانی که پستی زیر مجموعه این دسته یندی است شما اجازه حذف آن را ندارید");
            $this->redirect("admin/catgory");
        } else {
            $db->delete("catgoreis", $id);
            $this->redirectBack();
        }
    }
}
