<?php

use Auth\Auth;

session_start();



define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/last_project');
define('DISPLAY_ERROR', true);
define('DB_HOST', 'localhost');
define('DB_NAME', 'last_project');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

//email
define('MAIL_HOST', 'smtp.gmail.com');
define('SMTP_AUTH', true);
define('MAIL_USERNAME', 'testemaillllll513@gmail.com');
define('MAIL_PASSWORD', 'qugdgddnbuvijudm');
define('MAIL_PORT', 587);
define('SENDER_MAIL', 'testemaillllll513@gmail.com');
define('SENDER_NAME', 'دوره آنلاین php جامع');


//Admin
require_once BASE_PATH . "/database/database.php";
require_once BASE_PATH . "/activitis/Admin/Admin.php";
require_once BASE_PATH . "/activitis/Admin/Home.php";
require_once BASE_PATH . "/activitis/Admin/Catgory.php";
require_once BASE_PATH . "/activitis/Admin/post.php";
require_once BASE_PATH . "/activitis/Admin/banner.php";
require_once BASE_PATH . "/activitis/Admin/Comment.php";
require_once BASE_PATH . "/activitis/Admin/User.php";
require_once BASE_PATH . "/activitis/Admin/Setting.php";
require_once BASE_PATH . "/activitis/Admin/Like.php";

//Auth
require_once BASE_PATH . "/activitis/Auth/Auth.php";


//home
require_once BASE_PATH . "/activitis/App/App.php";








spl_autoload_register(function ($className) {
    $path = BASE_PATH . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR; //lib The place where the calendar file is saved
    include $path . $className . '.php';
    // include $path . "PHPMailer/PHPMailer/PHPMailer.php" . '.php';
});



function uri($reservedUrl, $class, $method, $requestMethod = 'GET')
{

    //current url array
    $currentUrl = explode('?', currentUrl())[0];
    $currentUrl = str_replace(CURRENT_DOMAIN, '', $currentUrl);
    $currentUrl = trim($currentUrl, '/');
    $currentUrlArray = explode('/', $currentUrl);
    $currentUrlArray = array_filter($currentUrlArray);

    //reserved Url array
    $reservedUrl = trim($reservedUrl, '/');
    $reservedUrlArray = explode('/', $reservedUrl);
    $reservedUrlArray = array_filter($reservedUrlArray);

    if (sizeof($currentUrlArray) != sizeof($reservedUrlArray) || methodField() != $requestMethod) {
        return false;
    }

    $parameters = [];
    for ($key = 0; $key < sizeof($currentUrlArray); $key++) {
        if ($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "}") {
            array_push($parameters, $currentUrlArray[$key]);
        } elseif ($currentUrlArray[$key] !== $reservedUrlArray[$key]) {
            return false;
        }
    }

    if (methodField() == 'POST') {
        $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
        $parameters = array_merge([$request], $parameters);
    }

    $object = new $class;
    call_user_func_array(array($object, $method), $parameters);
    exit();
}



function protocol()
{
    return  stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
}



function currentDomain()
{
    return protocol() . $_SERVER['HTTP_HOST'];
}



function asset($src)
{

    $domain = trim(CURRENT_DOMAIN, '/ ');
    $src = $domain . '/' . trim($src, '/');
    return $src;
}


function url($url)
{

    $domain = trim(CURRENT_DOMAIN, '/ ');
    $url = $domain . '/' . trim($url, '/');
    return $url;
}

function currentUrl()
{
    return currentDomain() . $_SERVER['REQUEST_URI'];
}

function methodField()
{
    return $_SERVER['REQUEST_METHOD'];
}

function displayError($displayError)
{

    if ($displayError) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);
    }
}

displayError(DISPLAY_ERROR);


global $flashMessage;
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}


function flash($name, $value = null)
{
    if ($value === null) {
        global $flashMessage;
        $message = isset($flashMessage[$name]) ? $flashMessage[$name] : '';
        return $message;
    } else {
        $_SESSION['flash_message'][$name] = $value;
    }
}



function dd($var)
{
    echo '<pre>';
    var_dump($var);
    exit;
}


if (isset($_SESSION["user"]) || isset($_COOKIE["login"])) {

//home
uri("admin", "Admin\Home", "index");

    //catgory
    uri("admin/catgory", "Admin\Category", "index");
    uri("admin/catgory/create", "Admin\Category", "create");
    uri("admin/catgory/store", "Admin\Category", "store", "POST");
    uri("admin/catgory/edit/{id}", "Admin\Category", "edit");
    uri("admin/catgory/delete/{id}", "Admin\Category", "delete");


    //post
    uri("admin/post", "Admin\post", "index");
    uri("admin/post/create", "Admin\post", "create");
    uri("admin/post/store", "Admin\post", "store", "POST");
    uri("admin/post/delet/{id}", "Admin\post", "delete");
    uri("admin/post/edit/{id}", "Admin\post", "edit");
    uri("admin/post/update/{id}", "Admin\post", "update", "POST");
    uri("admin/post/selected/{id}", "Admin\post", "selected");
    uri("admin/post/news_hot/{id}", "Admin\post", "newshot");


    //baner
    uri("admin/banner", "Admin\banner", "index");
    uri("admin/banner/create", "Admin\banner", "create");
    uri("admin/banner/store", "Admin\banner", "store", "POST");
    uri("admin/banner/delete/{id}", "Admin\banner", "delete");
    uri("admin/banner/status/{id}", "Admin\banner", "status");
    uri("admin/banner/edit/{id}", "Admin\banner", "edit");
    uri("admin/banner/update/{id}", "Admin\banner", "update", "POST");


    //comment
    uri("admin/comment", "Admin\Cpmment", "index");
    uri("admin/comment/status/{id}", "Admin\Cpmment", "status");



    //user
    uri("admin/user", "Admin\User", "index");
    uri("admin/user/position/{id}", "Admin\User", "position");
    uri("admin/user/delete/{id}", "Admin\User", "delete");

    //noth
    uri("admin/note", "Admin\Like", "index");
    uri("admin/note/create", "Admin\Like", "create");
    uri("admin/note/store", "Admin\Like", "store", "POST");
    uri("admin/note_desable/{id}", "Admin\Like", "status_desable");
    uri("admin/note_enable/{id}", "Admin\Like", "status_enable");
    uri("admin/note/edit/{id}", "Admin\Like", "edit");
    uri("admin/note/update/{id}", "Admin\Like", "update", "POST");
    uri("admin/delete/{id}", "Admin\Like", "delete");

    //web_setting
    uri("admin/setting", "Admin\Setting", "index");
    uri("admin/setting/set", "Admin\Setting", "show_set");
    uri("admin/setting/update", "Admin\Setting", "set", "POST");

    //logAoth
    // uri("admin/logaoth", "Auth\Auth", "logaut");

}

if (!isset($_SESSION["user"]) and !isset($_COOKIE["login"])) {

    //Auth 
    //register
    uri("register", "Auth\Auth", "register");
    uri("register/upload", "Auth\Auth", "updoad", "POST");
    uri("activation/{token}", "Auth\Auth", "activ");



    //login 
    uri("login", "Auth\Auth", "login");
    uri("login/upload", "Auth\Auth", "comme", "POST");

    //forgot password
    uri("forgotPassword", "Auth\Auth", "forgot");
    uri("check_email_password", "Auth\Auth", "check_forgot", "POST");
    uri("ok_semdEmail_password", "Auth\Auth", "oksendEmailPassword");
    uri("ForgotPassword/{token}", "Auth\Auth", "reset_password");
    uri("resetPassword", "Auth\Auth", "password_reset", "POST");
}


//home
uri("/", "App\App", "index");
uri("home", "App\App", "index");
uri("show/{id}", "App\App", "show");
uri("catgory/{id}", "App\App", "catgory");
uri("sendComment/{id}", "App\App", "sendComment", "POST");
uri("like/{id}", "App\App", "like");
uri("navgation/{id}", "App\App", "navgation");
uri("catgory/{id}/navgation/{id}", "App\App", "navgation");







require_once(BASE_PATH . "/template/app/error404.php");
