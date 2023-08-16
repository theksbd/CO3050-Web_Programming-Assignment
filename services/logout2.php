<?php
session_start();
unset($_SESSION["user"]);
header("location: /loginPage2.php");
