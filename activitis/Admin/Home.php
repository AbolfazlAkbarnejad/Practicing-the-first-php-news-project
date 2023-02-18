<?php



namespace Admin;

use database\database;

class Home extends Admin
{
    public function index()
    {
        $db = new database();
        $ContCatgory = $db->select("SELECT COUNT(*) FROM catgoreis")->fetch();
        $ContUser = $db->select("SELECT COUNT(*) FROM users WHERE position = 'user' ")->fetch();
        $ContAdmin = $db->select("SELECT COUNT(*) FROM users WHERE position = 'admin'")->fetch();
        $ContLider = $db->select("SELECT COUNT(*) FROM users WHERE position = 'lider'")->fetch();


        $ContPost = $db->select("SELECT COUNT(*) FROM posts")->fetch();
        $ContView = $db->select("SELECT SUM(view) FROM posts")->fetch();


        $ContComment = $db->select("SELECT COUNT(*) FROM coments ")->fetch();
        $ContComment_Unseen = $db->select("SELECT COUNT(*) FROM coments WHERE status = 'unseen' ")->fetch();
        $ContComment_enable = $db->select("SELECT COUNT(*) FROM coments WHERE status = 'enable' ")->fetch();


        $posts_view = $db->select("SELECT * FROM posts  ORDER BY view DESC LIMIT 0,5");
        $posts_comment = $db->select("SELECT posts.* ,(SELECT COUNT(*) FROM coments WHERE posts.id= coments.post_id AND status = 'enable')AS CountComment FROM posts ORDER BY CountComment DESC LIMIT 0,5")->fetchAll();

        $comments = $db->select("SELECT * FROM coments ORDER BY id DESC LIMIT 0,8");
        require_once(BASE_PATH . "/template/admin/dashbord.php");
    }



}
