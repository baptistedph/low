<?php
$page_name = 'Sign up';

if (isset($_GET['error'])) {
  $error = $_GET['error'];
}

include 'shared/header.php';
?>

<?php if (isset($error)) : ?>
<header class="text-center text-white bg-red-500 py-2 fixed top-0 w-full"><?= $error ?></header>
<?php endif; ?>

<div class="flex justify-center items-center h-screen p-6">
  <form class="mt-20 w-80" action="actions/signup.php" method="POST">
    <div class="mb-6">
      <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
      <input required id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
      <input required type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    </div>
    <div class="flex flex-col gap-2 md:flex-row">
      <button class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Sign up</button>
      <a href="login.php" class="text-blue-500 hover:text-blue-600 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Log in</a>
    </div>
  </form>
</div>

<?php include 'shared/footer.php'; ?>
