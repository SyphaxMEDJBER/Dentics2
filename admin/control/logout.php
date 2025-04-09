<?php
session_start();
session_unset();      // Vide la session
session_destroy();    // Détruit la session
header("Location: /Dentics2/admin/login"); // Redirection propre avec rewriting
exit();
