<?php

namespace Admin;

use database\database;

class Cpmment extends Admin
{
    public function index()
    {

        $db = new database();
        $chek_seen = $db->select("SELECT * FROM coments WHERE status = ? ", ["unseen"])->fetchAll();
        foreach ($chek_seen as $chek) {

            $db->update("coments", $chek["id"], ["status"], ["seen"]);
        }

        $comments = $db->select("SELECT coments.* ,(SELECT title FROM posts WHERE coments.post_id = posts.id)AS post_id FROM coments ORDER BY id DESC");

        require_once(BASE_PATH . "/template/admin/comment/index.php");
    }


    public function status($id)
    {

        $db = new database();

        $status = $db->select("SELECT * FROM coments WHERE id = ? ", [$id])->fetch();
        if ($status) {
            if ($status["status"] == "seen") {
                $db->update("coments", $id, ["status"], ["enable"]);
                $this->redirect("admin/comment");
            } else {
                $db->update("coments", $id, ["status"], ["seen"]);
                $this->redirect("admin/comment");
            }
        }
    }
}
