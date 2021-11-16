<? $root = realpath($_SERVER["DOCUMENT_ROOT"]) ?>
<? require_once "$root/php/session.php"?>
<? require_once "$root/php/utils.php"?>

<heading class="pure-menu pure-menu-horizontal">
    <style scoped>
        .pure-menu-list {
            float: right;
        }
    </style>

    <a class="pure-menu-heading" href=""><i class="bi bi-bank me-1"></i>Bank of PHP&lt;/i&gt;rla</a>

    <ul class="pure-menu-list">
        <li class="pure-menu-item <?= is_current_page('/') ? 'pure-menu-selected' : ''?>"><a href="/" class="pure-menu-link">Home</a></li>
        <? if ($logged_in): ?>
            <li class="pure-menu-item <?= is_current_page('/wire-transfer.php') ? 'pure-menu-selected' : ''?>"><a href="wire-transfer.php" class="pure-menu-link">Wire transfer</a></li>
            <li class="pure-menu-item <?= is_current_page('/movements.php') ? 'pure-menu-selected' : ''?>"><a href="movements.php" class="pure-menu-link">Movements</a></li>
            <li class="pure-menu-item <?= is_current_page('/logout.php') ? 'pure-menu-selected' : ''?>"><a href="logout.php" class="pure-menu-link">Logout</a></li>
        <? else: ?>
            <li class="pure-menu-item <?= is_current_page('/login.php') ? 'pure-menu-selected' : ''?>"><a href="login.php" class="pure-menu-link">Login</a></li>
            <li class="pure-menu-item <?= is_current_page('/register.php') ? 'pure-menu-selected' : ''?>"><a href="register.php" class="pure-menu-link">Register</a></li>
        <? endif; ?>
    </ul>
</heading>
