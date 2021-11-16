<?php 
    require_once 'php/session.php';
    require_once 'php/data-model/user.php';
    require_once 'php/data-model/review.php';
    
    if(isset($_POST['text'])) try_review();

    $reviews = $review_repo->get_all();

    function try_review() {
        global $logged_in, $review_repo, $session_user;

        $text = $_POST['text'] ?? '';

        if (!$logged_in || empty($text)) return;

        $review = new Review();
        $review->text = $text;
        $review->username = $session_user;
        
        $review_repo->create($review);
    }

?>
<? include 'php/components/header.php' ?>
<? include 'php/components/topbar.php' ?>

<main>
    <style scoped>
        .hero {
            font-size: 1.5em;
            padding-top: 20vh;
            padding-bottom: 20vh;
            width: 50%;
        }
        .hero > *:first-child {
            padding: 1em;
            border: 0.25em solid;
        }
    </style>

    <div class="hero center text-center">
        <h1>PHP&lt;/i&gt;rla</h1>
        <p><u>The safest bank in the world</u></p>
    </div>

    <h2 class="text-center mt-5">Why you should choose us</h2>
    <div class="pure-g container">
        <div class="pure-u-1-3">
            <div class="card text-center">
                <div class="card-heading-lg" style="background-color: #3fcb20"><i class="bi bi-cash-coin"></i></div>
                <div class="card-content">
                    <h3>FREE MONEY</h3>
                    <p>You will receive free 500$ credit just by signing up. You also do not need to give us any of your personal information! Isn't that just wonderful?</p>
                </div>
            </div>
        </div>
        <div class="pure-u-1-3">
            <div class="card text-center">
                <div class="card-heading-lg"><i class="bi bi-shield-check"></i></div>
                <div class="card-content">
                    <h3>SUPER SAFE</h3>
                    <p>Our website uses PHP, the safest <i>- and also the best -</i> programming language. We use only vanilla PHP, no frameworks in between just slowing down things.</p>
                </div>
            </div>
        </div>
        <div class="pure-u-1-3">
            <div class="card text-center">
                <div class="card-heading-lg" style="background-color: #cb7b20"><i class="bi bi-bank"></i></div>
                <div class="card-content">
                    <h3>WE ARE A BANK</h3>
                    <p>Banks are known to be extremely reliable and they will never use your money for sketchy things like generating debt. We also do not snitch.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center mt-5">Reviews</h2>
    <p class="text-center">Still not trusting us? Have a look at what our clients have to say!</h3>
    <div class="pure-g container">

        <? foreach($reviews as $review): ?>
            <div class="pure-u-1-2">
                <div class="card">
                    <div class="card-heading pure-g">
                        <div class="pure-u-1-2"><b><?= $review->username ?></b></div>
                        <div class="pure-u-1-2 text-right"><b><?= $review->datetime ?></b></div>
                    </div>
                    <div class="card-content"><?= $review->text ?></div>
                </div>
            </div>
        <? endforeach; ?>

    </div>

    <? if($logged_in): ?>
        <div class="container mt-5">
            <div class="card">
                <div class="card-heading text-center">ADD A REVIEW</div>
                <div class="card-content text-center">
                    <form method="post" class="pure-form pure-form-stacked">
                        <textarea class="pure-input-1" placeholder="Your review" name="text" required></textarea>
                        <input type="submit" class="pure-button pure-button-primary" value="Post review"/>
                    </form>
                </div>
            </div>
        </div>
    <? endif; ?>    
</main>

<? include 'php/components/footer.php' ?>
