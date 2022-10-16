<?php
require_once '../models/User.php';

$user = new User();

$response = $user->log_out();

header('Location: /login.php');