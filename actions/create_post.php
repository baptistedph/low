<?php
require_once '../models/Post.php';

session_start();

$post = new Post();

[$title, $body] = array_values($_POST);

$response = $post->create($title, $body, $_SESSION['user']['id']);

isset($response['success']) ? header('Location: /') : header('Location: /login.php');