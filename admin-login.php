<?php
// admin-login.php
session_start();

$error = '';
if (isset($_POST['submit'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Invalid admin credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Absolute Cinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="bg-zinc-950 text-zinc-300 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md p-6">
    <div class="text-center mb-10">
      <i class="fa-solid fa-ticket text-violet-400 text-5xl mb-4"></i>
      <h1 class="text-3xl font-bold text-white">Admin Login</h1>
    </div>

    <div class="bg-zinc-900 border border-zinc-700 rounded-3xl p-8">
      <?php if ($error): ?>
        <div class="bg-red-900 border border-red-700 text-red-300 p-4 rounded-xl mb-6 text-center">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST">
        <div class="space-y-6">
          <div>
            <label class="block text-sm text-zinc-400 mb-2">Username</label>
            <input type="text" name="username" value="" required
              class="w-full bg-zinc-950 border border-zinc-700 rounded-2xl px-5 py-3 focus:outline-none focus:border-violet-500">
          </div>
          <div>
            <label class="block text-sm text-zinc-400 mb-2">Password</label>
            <input type="password" name="password" value="" required
              class="w-full bg-zinc-950 border border-zinc-700 rounded-2xl px-5 py-3 focus:outline-none focus:border-violet-500">
          </div>

          <button type="submit" name="submit"
            class="w-full bg-violet-600 hover:bg-violet-500 py-4 rounded-2xl font-semibold text-lg">
            Login to Admin Dashboard
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>