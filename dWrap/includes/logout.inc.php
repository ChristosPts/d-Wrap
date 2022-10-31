<?php
/*By destroying the session variables we can log out the user */

session_start();
session_unset();
session_destroy();

header("location: ../index?page=1");
exit();
