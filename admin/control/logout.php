<?php
session_start();
session_unset();      // Vide la session
session_destroy();    // Détruit la session
header("Location: ../templates/back/login.php"); // Redirection vers login
exit();
