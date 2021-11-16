<?php
    require_once 'php/session.php';
    require_once 'php/db.php';
    require_once 'php/data-model/transaction.php';
    require_once 'php/data-model/user.php';
    
    if(!$logged_in) header('Location: /index.php');

    $transfer_msg = false;

    $user = $user_repo->get_by_username($session_user);

    if(isset($_POST['iban']) && isset($_POST['amount'])) $transfer_msg = try_transfer();
        

    function try_transfer() {
        global $user_repo, $transaction_repo, $user;

        $to_iban = $_POST['iban'] ?? '';
        $amount = $_POST['amount'] ?? '';
        $notes = $_POST['notes'] ?? '';
        
        if (empty($to_iban) || empty($amount)) return 'Fill in all fields';
        if (strlen($to_iban) != 27 || $to_iban == $user->iban) return 'Invalid IBAN';
        if ($amount < 0 || $amount > $user->balance) return 'Invalid amount';

        $transaction = new Transaction();
        $transaction->from_iban = $user->iban;
        $transaction->to_iban = $to_iban;
        $transaction->amount = $amount;
        $transaction->notes = $notes;
        if(!$transaction_repo->create($transaction)) return 'Something went wrong';

        $user->balance -= $amount;
        if(!$user_repo->update($user)) return 'Something went wrong';

        $receiving_user = $user_repo->get_by_iban($to_iban);
        if($receiving_user) {
            $receiving_user->balance += $amount;
            if(!$user_repo->update($receiving_user)) return 'Something went wrong';
        }

        return "Transfered $amount$ to $to_iban!";
    }
?>
<? include 'php/components/header.php' ?>
<? include 'php/components/topbar.php' ?>

<main class="container">
    <h2>Logged in as: <?=$user->username?></h2>
    <h3>IBAN: <?=$user->iban?></h3>
    <h3>Balance: <?=$user->balance?>$</h3>

    <div class="pure-g">
        <div class="pure-u-1-3">
            <div class="card">
                <div class="card-heading"><b>New wire transfer</b></div>
                <div class="card-content text-center">
                    <form method="post" class="pure-form pure-form-stacked">
                        <input class="pure-input-1" type="text" placeholder="IBAN Number" name="iban" required/>
                        <textarea class="pure-input-1" type="number" min="0" max="<?=$user->balance?>" step="0.01" placeholder="Notes" name="notes"></textarea>
                        <input class="pure-input-1" type="number" min="0" max="<?=$user->balance?>" step="0.01" placeholder="Amount" name="amount" required/>
                        <input type="submit" class="pure-button pure-button-primary" value="Transfer funds"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <? if($transfer_msg): ?>
        <p><?=$transfer_msg?></p> 
    <? endif; ?>
</main>

<? include 'php/components/footer.php' ?>
