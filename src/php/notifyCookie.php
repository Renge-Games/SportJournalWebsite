<?php

if (isset($_POST["acceptCookie"])) {
    setcookie("disableCookieNotify", "true", time() + (10 * 365 * 24 * 60 * 60), '/');
}

header("Location: {$_SERVER['HTTP_REFERER']}");
