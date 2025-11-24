<?php
class User {

    public function authenticate($username, $password) {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $username = strtolower(trim($username));
        $db = db_connect();

        // SESSION LOCKOUT LOGIC
        if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3) {
            $elapsed = time() - ($_SESSION['lastFailedTime'] ?? 0);

            if ($elapsed < 60) {
                $remaining = 60 - $elapsed;
                $_SESSION['error'] = "Too many login attempts. Try again in {$remaining} seconds.";
                header('Location: /login');
                exit;
            } else {
                // Lockout expired
                $_SESSION['failedAuth'] = 0;
                unset($_SESSION['lastFailedTime']);
            }
        }

        // Check credentials
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            $_SESSION['success'] = "Welcome, " . ucwords($username) . "!";
            unset($_SESSION['failedAuth'], $_SESSION['lastFailedTime']);
            $this->logAttempt($username, 'success');
            header('Location: /movie/search');
            exit;
        } else {
            // Failed attempt
            $_SESSION['failedAuth'] = ($_SESSION['failedAuth'] ?? 0) + 1;
            $_SESSION['lastFailedTime'] = time();
            $_SESSION['error'] = "Invalid username or password.";
            $this->logAttempt($username, 'fail');
            header('Location: /login');
            exit;
        }
    }

    public function register($username, $password) {
        $db = db_connect();
        $username = strtolower(trim($username));

        // Check if username exists
        if ($this->userExists($username)) {
            throw new Exception('Username already taken.');
        }

        // Insert new user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->execute();
    }

    public function userExists($username) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindValue(':username', strtolower($username));
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    private function logAttempt($username, $status) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO login_logs (username, was_success) VALUES (:username, :was_success)");
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':was_success', $status === 'success' ? 1 : 0, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function test() {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM users;");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
