<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/php/db.php";

    if(session_status() === PHP_SESSION_NONE) session_start();

    function is_logged_in() {
        return isset($_SESSION['session_id']);
    }

    function logout() {
        session_destroy();
        header("Location: /index.php");
    }

    function login($username, $password) {
        
        global $user_repo;

        $user = $user_repo->get_by_username($username);
        if(!$user) return "User '$username' not found";
        if($user->password != $password) return "Wrong password";

        session_regenerate_id();
        $_SESSION['session_id'] = session_id();
        $_SESSION['session_user'] = $username;

        header('Location: /index.php');
        return true;
    }

    $logged_in = is_logged_in();
    $session_user = $_SESSION['session_user'] ?? '';

?>