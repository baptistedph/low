<?php
require_once '../models/Post.php';

$post_id = $_GET['id'];

$post = new Post();

$response = $post->delete($post_id);

isset($response['success']) ? header('Location: /') : header('Location: /login.php');