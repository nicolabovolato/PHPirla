<?php
    function is_current_page($page) {
        return ($_SERVER['REQUEST_URI'] == $page);
    }
?>