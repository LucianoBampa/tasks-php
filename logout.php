<?php
session_start();
session_unset();  // limpa as variáveis de sessão
session_destroy(); // destrói a sessão

header('Location: login.php');
exit();
