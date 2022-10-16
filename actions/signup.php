<?php
require_once '../models/User.php';

$user = new User();

[$username, $password] = array_values($_POST);

$response = $user->sign_up($username, $password);

isset($response['success']) ? header('Location: /') : header('Location: /signup.php?error=' . $response['message']);