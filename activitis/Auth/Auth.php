<?php


namespace Auth;

use Admin\Admin;
use database\database;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Auth
{
    protected function redirect($url)
    {
        header('Location: ' . trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ '));
        exit;
    }

    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    protected function hash($password)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        return $hashPassword;
    }


    protected function random()
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }

    protected function activationMassage($username, $verifyToken)
    {
        $massage = '
        <h1> فعال سازی حساب کاربری </h1>
         <p> ' . $username . ' عزیز برای فعال سازی حساب کاربری خود روی لینک زیر کلیک نمایید</p>
         <div><a href="' . url("activation/" . $verifyToken) . '"> فعال سازی حساب</a></div>
         ';
        return $massage;
    }


    protected function ForgotPasswordreset($username, $ForgotPassword)
    {
        $massage = '
        <h1> بازیابی رمز عبور</h1>
         <p> ' . $username . ' عزیز برای باز یابی رمز عبور حساب کاربری خود روی لینک زیر کلیک نمایید</p>
         <div><a href="' . url("ForgotPassword/" . $ForgotPassword) . '"> فعال سازی حساب</a></div>
         ';
        return $massage;
    }


    public function sendMail($emailAddress, $subject, $body)
    {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->CharSet = "UTF-8"; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = MAIL_HOST; //Set the SMTP server to send through
            $mail->SMTPAuth = SMTP_AUTH; //Enable SMTP authentication
            $mail->Username = MAIL_USERNAME; //SMTP username
            $mail->Password = MAIL_PASSWORD; //SMTP password
            $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
            $mail->Port = MAIL_PORT; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(SENDER_MAIL, SENDER_NAME);
            $mail->addAddress($emailAddress);


            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            $result = $mail->send();
            echo 'Message has been sent';
            return $result;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }


    public function register()
    {
        require_once(BASE_PATH . "/template/auth/register.php");
    }

    public function updoad($request)
    {
        $db = new database();
        $users = $db->select("SELECT * FROM users WHERE email = ?", [$request["email"]])->fetch();
        $specialRequest = array_map("htmlspecialchars", $request);
        $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
        // $pattern = "/ain/i";

        if (empty($request)) {
            flash("error_register", "فیلد های پایین باید پر شوند");
            $this->redirect("register");
        } elseif ($users) {
            flash("error_register", "این کاربر قبلا ثیت نام کرده است");
            $this->redirect("register");
        } elseif (!preg_match($pattern, $request["password"])) {
            flash("error_register", "رمز عبور حداقل باید دارای 8 کاراکتر و شمامل حروف و اعداد باشد");
            $this->redirect("register");
        } else {
            $random = $this->random();
            $token_register = $this->activationMassage($request["username"], $random);
            $this->sendMail($request["email"], "فعال سازی حساب کاربری", $token_register);
            $specialRequest["token_login"] = $random;
            $specialRequest["password"] = $this->hash($request["password"]);
            $db->insert("users", array_keys($specialRequest), $specialRequest);
            $this->redirect("login");
        }
    }

    public function activ($token)
    {
        $db = new database();
        $check_token = $db->select("SELECT * FROM users WHERE token_login = ?", [$token])->fetch();
        if (empty($token)) {
            flash("error_confirmation", "کد اشتباه است");
            $this->redirect("register");
        } elseif ($check_token == false) {
            flash("error_confirmation", "کد اشتباه است");
            // dd("Sd");
            $this->redirect("register");
        } else {

            $db->update("users", $check_token["id"], ["status"], ["2"]);
            $this->redirect("login");
        }
    }



    public function login()
    {
        require_once(BASE_PATH . "/template/auth/login.php");
    }


    public function comme($request)
    {
        $db = new database();
        $users = $db->select("SELECT * FROM users WHERE email = ?", [$request["email"]])->fetch();
        // if (!empty($request)) {
        //     if ($users and $users["status"] == 2) {
        //         if (password_verify($request["password"], $users["password"])) {
        //             $_SESSION["user"] = $users["id"];
        //             dd($_SESSION);
        //         }
        //     }
        // }
        if (empty($request)) {
            flash("error_login", "فیلد های پایین باید کامل پر شوند");
            $this->redirect("login");
        } elseif (!$users) {
            flash("error_login", "ایمیل یا پسور اشتباه است");
            $this->redirect("login");
        } elseif ($users["status"] != 2) {
            flash("error_login", "احراز هویت کاربر هنوز انجام نشده");
            $this->redirect("login");
        } elseif (!password_verify($request["password"], $users["password"])) {
            flash("error_login", "ایمیل یا پسور اشتباه است");
            $this->redirect("login");
        } else {
            $_SESSION["user"] = $users["id"];
            $hash_user = password_hash($request["id"], PASSWORD_DEFAULT);
            setcookie("login", $users["id"], time() + (60 * 60 * 24 * 365), "/");
            $this->redirect("admin");
        }
    }


    public function check_admin()
    {
        if (isset($_SESSION["user"]) or isset($_COOKIE["login"])) {
            $db = new database();


            $users = $db->select("SELECT * FROM users WHERE id = ? OR id = ?", [$_COOKIE["login"], $_SESSION["user"]])->fetch();
            if ($users) {
                if ($users["position"] == "admin" or $users["position"] == "lider") {
                } else {
                    $this->redirect("");
                }
            } else {
                $this->redirect("home");
            }
        } else {
            $this->redirect("home");
        }
    }


    public function forgot()
    {
        require_once(BASE_PATH . "/template/auth/forgot_password.php");
    }

    public function check_forgot($request)
    {
        $db = new database;
        $user = $db->select("SELECT * FROM users WHERE email =? ", [$request["email"]])->fetch();
        if (!empty($request)) {
            if ($user) {
                $random = $this->random();
                $forgot_token = $this->ForgotPasswordreset($user["username"], $random);
                $this->sendMail($request["email"], "باز یابی رمز عبور", $forgot_token);
                $db->update("users", $user["id"], ["token_password"], [$random]);
                $this->redirect("ok_semdEmail_password");
            } else {
                $this->redirect("");
            }
        } else {
            flash("error_forgotPassword", "فیلد پایین را پر کنید");
        }
    }
    public function oksendEmailPassword()
    {
        require_once(BASE_PATH . "/template/auth/ok_sendEmail.php");
    }
    public function reset_password($token)
    {
        $db = new database;
        $check_token = $db->select("SELECT * FROM users WHERE token_password = ?", [$token])->fetch();
        // $specialRequest = array_map("htmlspecialchars", $request);
        if ($check_token) {
            require_once(BASE_PATH . "/template/auth/resetPassword.php");
        } else {
            $this->redirect("");
        }
    }

    public function password_reset($request)
    {
        $db = new database;
        $url = explode("/", $_SERVER["HTTP_REFERER"])[5];
        $user = $db->select("SELECT * FROM users WHERE token_password = ?", [$url])->fetch();
        $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";

        if (empty($request)) {
            flash("error_resetPassword", "فیلد پایین باید پر شود");
            $this->redirectBack();
        } elseif (!$user) {
            flash("error_resetPassword", "کد وارد شده اشتباه است");
            $this->redirectBack();
        } elseif (!preg_match($pattern, $request["password"])) {
            flash("error_resetPassword", "رمز عبور حداقل باید دارای 8 کاراکتر و شمامل حروف و اعداد باشد");
            $this->redirectBack();
        } else {

            $specialRequest = array_map("htmlspecialchars", $request);
            $password_hash = $this->hash($specialRequest["password"]);
            $db->update("users", $user["id"], ["password", "token_password"], [$password_hash, ""]);

            $this->redirect("login");
        }
    }

    protected function logaut()
    {
        dd('s');
        $_SESSION["User"] = "";

        unset($_COOKIE["login"]);
        // setcookie("login", NULL, -1, "/");
    }
}
