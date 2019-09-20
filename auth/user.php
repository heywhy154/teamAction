<?php
require_once(dirname(__DIR__) . "/includes/db.php");
class User
{
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function call_method($method, $data)
    {
        switch ($method) {
            case 'signup':
                return $this->signup($data);
                break;

            default:
                return "no method found";
                break;
        }
    }

    public function verify_user($email)
    {
        $verify = $this->conn->exec("UPDATE users SET `verified` = 'true'
            WHERE `email`='{$email}'");
        if ($verify == true) {
            return $this->set_users_profile($email);
        }
    }

    private function set_users_profile($email)
    {
        $this->conn->exec("INSERT INTO users_profile (`user_id`, `name`, `username`, `email`, `status`)
        SELECT `user_id`, `name`, `username`, `email`, `status` FROM users_tmp
        WHERE `email`='{$email}'");
        return $this->conn->exec("DELETE FROM users_tmp
            WHERE email='{$email}'");
    }

    private function check_username($username)
    {
        return $this->conn->query("SELECT `username` FROM users where `username`='{$username}'")->rowCount();
    }

    private function check_email($email)
    {
        return $this->conn->query("SELECT `email` FROM users where `email`='{$email}'")->rowCount();
    }

    private function send_verification_link($email)
    {
        // code for sending confirmation link to users email address
    }

    private function create_newUser($user)
    {
        $hashed_password = password_hash($user['p2'], 1);
        $query = $this->conn->prepare("INSERT INTO users VALUES(null, 
        '{$user['username']}', 
        '{$user['email']}', 
        '{$hashed_password}', 
        'false') ")->execute();
        if ($query == true) {
            $userid = $this->conn->lastInsertId();
            $unconfirmed = $this->conn->prepare("INSERT INTO users_tmp VALUES(null, '$userid',
            '{$user['name']}', 
            '{$user['username']}', 
            '{$user['email']}', 
            '{$user['position']}') ")->execute();
            if ($unconfirmed == true) {
                // $this->send_verification_link($user['email']);
                return true;
            }
        }
    }

    private function signup($data)
    {
        $validate = true;
        $message = "";
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $p1 = $data['p1'];
        $p2 = $data['p2'];
        if ($this->check_username(strtolower($data['username'])) > 0) {
            $validate = false;
            $message = "Sorry, the username <b> {$data['username']} </b> is already taken";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validate = false;
            $message = "Please enter a valid email";
        }
        if ($this->check_email(strtolower($data['email'])) > 0) {
            $validate = false;
            $message = "This email already exists";
        }
        if ((strlen($p1) || strlen($p2)) < 4) {
            $validate = false;
            $message = "Password must be a minimum of 4 characters";
        }
        if ($p1 !== $p2) {
            $validate = false;
            $message = "Passwords does not match";
        }
        if ($validate == true) {
            if ($this->create_newUser($data) == true) {
                $encode_email = bin2hex($data['email']);
                $message = "Registration successful. click on <a href='./verifyaccount/{$encode_email}'>this link</a> to confirm your registration...";
                return json_encode(["status" => true, "msg" => $message]);
            }
        } else {
            return json_encode(["status" => false, "msg" => $message]);
        }
    }

    public function login($user)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE `email` = ? AND `verified` = 'true'");
        $stmt->execute([$user['em']]);

        return $stmt->fetch();
    }

    public function user_profile($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users_profile WHERE `user_id` = ? ");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }
}

$user = new User($conn);
if (isset($_POST['title']) == "signup") {
    parse_str($_POST['obj'], $arr);
    echo $user->call_method("signup", $arr);
}
