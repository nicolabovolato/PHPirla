<? require_once 'php/session.php' ?>

<? include 'php/components/header.php' ?>
<? include 'php/components/topbar.php' ?>

<main class="text-center">
    <h1>Page not found</h1>
    <p>The page your requested <b><?=$_SERVER['REQUEST_URI']?></b> could not be found.</p>
    <a class="pure-button pure-button-primary button-xlarge" href="/">Back to the homepage</a>
</main>

<? include 'php/components/footer.php' ?>
