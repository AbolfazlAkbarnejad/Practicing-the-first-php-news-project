<?php

namespace Admin;

use database\database;

class User extends Admin
{
    public function index()
    {
        $db = new database();
        $users = $db->select("SELECT * FROM users  WHERE position = ? OR   position = ?  ORDER BY id DESC", ["admin", "user"]);
        $liders = $db->select("SELECT * FROM users WHERE  position = ? ORDER BY id DESC", ["lider"])->fetchAll();
        $check_lider = $db->select("SELECT * FROM users WHERE id= ?" , [$_SESSION["user"]])->fetch();
        if (isset($_SESSION)) {
            $check_admin = $db->select("SELECT * FROM users WHERE id = ? OR id = ?", [$_SESSION["user"] , $_COOKIE["login"]])->fetch();
        }
        require_once(BASE_PATH . "/template/admin/user/index.php");
    }

    public function position($id)
    {
        $db = new database();
        $user = $db->select("SELECT * FROM users WHERE id = ?", [$id])->fetch();
        if ($user) {
            if ($user["position"] == "admin") {
                $db->update("users", $id, ["position"], ["user"]);
                $this->redirect("admin/user");
            } elseif ($user["position"] == "user") {
                $db->update("users", $id, ["position"], ["admin"]);
                $this->redirect("admin/user");
            }
        }
    }



    public function delete($id)
    {
        $db = new database();
        $user = $db->select("SELECT * FROM users WHERE id = ?", [$id])->fetch();
        if ($user) {
            $db->delete("users", $id);
            $this->redirect("admin/user");
        }
    }
}
