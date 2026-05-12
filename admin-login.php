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
<body class="bg-zinc-950 text-zinc-300 min-h-screen flex flex-col">

  <!-- Sticky Navigation -->
  <nav class="border-b border-zinc-800 sticky top-0 z-50 bg-zinc-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-2 text-white">
        <i class="fa-solid fa-ticket text-violet-400 text-xl"></i>
        <span class="text-lg font-semibold tracking-tight">Absolute Cinema</span>
      </div>
      <div>
        <a href="index.php" 
           class="inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors">
          ← Back to Home
        </a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="flex-1 flex items-center justify-center p-6">
    <div class="w-full max-w-md">

      <!-- Login Card -->
      <div class="bg-zinc-900 border border-zinc-700 rounded-3xl p-8">

        <div class="text-center mb-8">
          <i class="fa-solid fa-ticket text-violet-400 text-5xl mb-4"></i>
          <h1 class="text-3xl font-bold text-white">Admin Login</h1>
          <p class="text-zinc-500 mt-2">Secure Admin Dashboard</p>
        </div>

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
                class="w-full bg-zinc-950 border border-zinc-700 rounded-2xl px-5 py-3 focus:outline-none focus:border-violet-500 transition-colors">
            </div>
            <div>
              <label class="block text-sm text-zinc-400 mb-2">Password</label>
              <input type="password" name="password" value="" required
                class="w-full bg-zinc-950 border border-zinc-700 rounded-2xl px-5 py-3 focus:outline-none focus:border-violet-500 transition-colors">
            </div>

            <button type="submit" name="submit"
              class="w-full bg-violet-600 hover:bg-violet-500 py-4 rounded-2xl font-semibold text-lg transition-colors">
              Login to Admin Dashboard
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="border-t border-zinc-800 py-8 text-center text-zinc-600 text-sm">
    <div class="flex justify-center items-center gap-2 text-zinc-400 mb-3">
      <i class="fa-solid fa-ticket text-violet-400"></i>
      <span class="font-medium">Absolute Cinema</span>
    </div>
    <div class="flex justify-center gap-6 text-xs mb-4">
      <a href="faqs.php" class="hover:text-zinc-300">FAQs</a>
      <a href="https://www.facebook.com/jersey1705" target="_blank" class="hover:text-zinc-300">Contact</a>
      <a href="terms.php" class="hover:text-zinc-300">Terms</a>
    </div>
    <p>© 2026 Absolute Cinema. All rights reserved.</p>
  </footer>

</body>
</html>