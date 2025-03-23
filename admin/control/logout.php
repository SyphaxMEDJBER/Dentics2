<?php
session_start();
session_destroy();
header("Location: ../templates/back/login.php");
exit();
