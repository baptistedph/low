<?php
require_once '../models/User.php';

$user = new User();

[$username, $password] = array_values($_POST);

$response = $user->log_in($username, $password);

isset($response['success']) ? header('Location: /') : header('Location: /login.php?error=' . $response['message']);