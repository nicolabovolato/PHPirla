<?php
    require_once 'php/session.php';
    require_once 'php/db.php';
    require_once 'php/data-model/transaction.php';
    require_once 'php/data-model/user.php';
    
    if(!$logged_in) header('Location: /index.php');

    $movements_msg = false;

    $user = $user_repo->get_by_username($session_user);

    if(isset($_GET['search']) && !empty($_GET['search'])) {
        $text = $_GET['search'] ?? '';
        $transactions = $transaction_repo->get_by_iban_and_text($user->iban, $text);
    }
    else $transactions = $transaction_repo->get_by_iban($user->iban);
    
    if(!$transactions) $movements_msg = 'No transactions found';
?>
<? include 'php/components/header.php' ?>
<? include 'php/components/topbar.php' ?>

<main class="container">
    <h2>Logged in as: <?=$user->username?></h2>
    <h3>IBAN: <?=$user->iban?></h3>
    <h3>Balance: <?=$user->balance?>$</h3>

    <form class="pure-form">
        <input type="text" placeholder="Search transactions..." name="search" value="<?=$_GET['search'] ?? ''?>"/>
        <input class="pure-button pure-button-primary" type="submit" value="search"/>
    </form>

    <br/>
    
    <table class="pure-table pure-table-horizontal">
        <thead>
            <tr>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Amount</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?=$transaction->datetime?></td>
                    <td><?=$transaction->from_iban?></td>
                    <td><?=$transaction->to_iban?></td>
                    <td><?=$transaction->amount?></td>
                    <td><?=$transaction->notes?></td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>

    <? if($movements_msg): ?>
        <p><?=$movements_msg?></p> 
    <? endif; ?>
</main>

<? include 'php/components/footer.php' ?>
