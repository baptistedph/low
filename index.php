<?php
require_once 'models/Post.php';

session_start();

$page_name = 'Worse than Medium';

$post = new Post();

$posts = $post->get_all();

if (!isset($_SESSION['user'])) {
  header('Location: /login.php');
}

$is_admin = $_SESSION['user']['is_admin'] === 1;

include 'shared/header.php';
?>

<?php if ($is_admin) : ?>
<header class="text-center text-white bg-red-500 py-2 fixed top-0 w-full">You are an administrator.</header>
<?php endif; ?>

<div class="max-w-3xl mx-auto p-6 <?php if ($is_admin) echo 'mt-12' ?>">
  <header class="flex justify-between items-center">
    <h2 class="text-xl">Welcome <?= $_SESSION['user']['username'] ?>,</h2>
    <a href="actions/logout.php" class="block text-blue-500 hover:underline text-right">Log out</a>
  </header>
  <form class="mt-20" action="actions/create_post.php" method="POST">
    <div class="mb-6">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
      <input required id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    </div>
    <div class="mb-6">
      <label for="body" class="block mb-2 text-sm font-medium text-gray-900">Body</label>
      <textarea required id="body" name="body" class="h-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
    </div>
    <button class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add post</button>
  </form>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
    <?php foreach (array_reverse($posts) as $post) : ?>
      <div class="bg-white shadow rounded-lg p-5">
        <h2 class="text-2xl font-bold mb-2"><?= $post['title'] ?></h2>
        <p class="text-gray-500 mb-2"><?= $post['body'] ?></p>
        <?php if ($_SESSION['user']['id'] === $post['user_id'] || $_SESSION['user']['is_admin']) : ?>
          <a href="actions/delete_post.php?id=<?= $post['id'] ?>" class="text-red-500">Delete</a>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if (empty($posts)) : ?>
    <p class="text-center">No post added yet.</p>
  <?php endif; ?>  
</div>

<?php include 'shared/footer.php'; ?>
