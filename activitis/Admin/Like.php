<?php

namespace Admin;

use database\database;

class Like extends Admin
{
    public function index()
    {
        $db = new database();
        $likes = $db->select("SELECT * FROM note  ORDER BY id DESC");
        $check_Limitation = $db->select("SELECT COUNT(*) FROM note WHERE Limitation > NOW() AND status = 'enable' ")->fetch();
        // dd($check_Limitation["COUNT(*)"]);
        require_once(BASE_PATH . "/template/admin/note/index.php");
    }



    public function status_enable($id)
    {

        $db = new database();
        $like = $db->select("SELECT * FROM note WHERE id = ?", [$id])->fetch();
        $check_Limitation = $db->select("SELECT COUNT(*) FROM note WHERE Limitation > NOW() AND status = 'enable' ")->fetch();

        if ($like and $like["status"] == "desable" and $check_Limitation["COUNT(*)"] <= 6) {
            $db->update("note", $id, ["status"], ["enable"]);
            $this->redirectBack();
        } else {
            $this->redirectBack();
        }
    }

    public function status_desable($id)
    {
        $db = new database();

        $check_Limitation = $db->select("SELECT COUNT(*) FROM note WHERE Limitation > NOW() AND status = 'enable' ")->fetch();

        $like = $db->select("SELECT * FROM note WHERE id = ?", [$id])->fetch();
        if ($like and $like["status"] == "enable") {
            $db->update("note", $id, ["status"], ["desable"]);


            $this->redirectBack();
        } else {
            $this->redirectBack();
        }
    }



    public function create()
    {
        $this->checkCont_note();

        require_once(BASE_PATH . "/template/admin/note/create.php");
    }

    public function store($request)
    {
        $db = new database();
        if (!empty($request) and ($request["status"] > 0 and  $request["status"] < 3)) {

            $time = time() + (60 * 60 *12);
            
            $request["Limitation"] = date("Y-m-d H:i:s", (int)$time);
            // dd($request);
            $request["status"] = $request["status"] == 1 ? "enable" : "desable";

            $db->insert("note", array_keys($request), $request);

            $this->redirect("admin/note");
        }
        require_once(BASE_PATH . "/template/admin/note/create.php");
    }


    public function delete($id)
    {
        $db = new database();
        $note = $db->select("SELECT * FROM note WHERE id = ?", [$id])->fetch();

        if ($note) {
            $db->delete("note", $id);
            $this->redirectBack();
        }
        require_once(BASE_PATH . "/template/admin/note/create.php");
    }

    public function edit($id)
    {
        $db = new database();
        $note = $db->select("SELECT * FROM note WHERE id = ?", [$id])->fetch();

        if ($note) {
        }
        require_once(BASE_PATH . "/template/admin/note/edit.php");
    }

    public function update($request, $id)
    {
        $db = new database();
        $note = $db->select("SELECT * FROM note WHERE id = ?", [$id])->fetch();

        if (empty($request)) {
            flash("error_update", "فیلد های پایین را کامل  پر کنیدد");

            $this->redirectBack();
        } elseif (!$note) {
            flash("error_update", "فیلد های پایین را کامل  پر کنیدد");
            $this->redirectBack();
        } else {
            if ($request["status"] == 1) {
                $request["status"] = "enable";
            } elseif ($request["status"] == 2) {
                $request["status"] = "desable";
            }
            $db->update("note", $id, array_keys($request), $request);
            $this->redirect("admin/note");
        }
    }


    //tools
    public function checkCont_note()
    {
        $db = new database();
        $check_Limitation = $db->select("SELECT COUNT(*) FROM note WHERE Limitation > NOW() AND status = 'enable' ")->fetch();

        if ($this->direct("/", $_SERVER["REDIRECT_URL"], 2, 3, 4) == "admin/note/create") {
            if ($check_Limitation["COUNT(*)"] < 7) {
            } else {
                $this->redirect("admin/note");
            }
        }
    }
}
