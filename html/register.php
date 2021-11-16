<?php
    require_once 'php/session.php';
    require_once 'php/db.php';
    require_once 'php/data-model/user.php';    

    $registration_msg = false;

    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) $registration_msg = try_register();

    function try_register() {

        global $user_repo;

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';


        if (empty($username) || empty($password) || empty($confirm_password)) {
            return 'Fill in all fields';
        }
        
        if($password != $confirm_password) return "Passwords don't match";

        if($user_repo->get_by_username($username)) return "User '$username' already exists";

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->balance = 500;
        $user->iban = strtoupper(substr(md5(time()), 0, 27));

        if(!$user_repo->create($user)) return "Error during registration";

        echo login($username, $password);
    }
?>
<? include 'php/components/header.php' ?>
<? include 'php/components/topbar.php' ?>

<main class="pure-g">
    <div class="pure-u-1-4 center">

        <div class="card text-center">
            <div class="card-heading">Register</div>
            <div class="card-content">
                <form method="post" class="pure-form pure-form-stacked">
                <input class="pure-input-1" type="text" placeholder="Username" name="username" required/>
                <input class="pure-input-1" type="password" placeholder="Password" name="password" required/>
                <input class="pure-input-1" type="password" placeholder="Confirm password" name="confirm_password" required/>
                <input type="submit" class="pure-button pure-button-primary" value="Submit"/>
                </form>
            </div>
        </div>

        <? if($registration_msg): ?>
            <p class="text-center"><?=$registration_msg?></p> 
        <? endif; ?>

    </div>
</main>

<? include 'php/components/footer.php' ?>
