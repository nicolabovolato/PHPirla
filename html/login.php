<?php
    require_once 'php/session.php';

    $login_msg = false;

    if(isset($_POST['username']) && isset($_POST['password'])) $login_msg = try_register();

    function try_register() {

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) return 'Fill in all fields';

        return login($username, $password);
    }
?>
<? include 'php/components/header.php' ?>
<? include 'php/components/topbar.php' ?>

<main class="pure-g">
    <div class="pure-u-1-4 center">

        <div class="card text-center">
            <div class="card-heading">Login</div>
            <div class="card-content">
                <form method="post" class="pure-form pure-form-stacked">
                    <input class="pure-input-1" type="text" placeholder="Username" name="username" required/>
                    <input class="pure-input-1" type="password" placeholder="Password" name="password" required/>
                    <input type="submit" class="pure-button pure-button-primary" value="Submit"/>
                </form>
            </div>
        </div>

        <? if($login_msg): ?>
            <p class="text-center"><?=$login_msg?></p> 
        <? endif; ?>

    </div>
</main>

<? include 'php/components/footer.php' ?>
