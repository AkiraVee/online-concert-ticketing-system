<?php
// login.php
session_start();

// Already logged in? Go home.
if (isset($_SESSION['UserID'])) {
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
        header("Location: admin.php");
    } else {
        header("Location: profile.php");
    }
    exit();
}

$error = '';

if (isset($_POST['submit'])) {
    $e = trim($_POST['email'] ?? '');
    $p = $_POST['password'] ?? '';

    if (empty($e) || empty($p)) {
        $error = 'Please enter your email and password.';
    } else {
        include('mysql-connect.php');

        // password column is lowercase in the DB, hashed with SHA()
        $query = "SELECT UserID, FullName, Email FROM usertb WHERE Email='$e' AND password=SHA('$p')";
        $result = @mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($row) {
            $_SESSION['UserID']   = $row['UserID'];
            $_SESSION['FullName'] = $row['FullName'];
            $_SESSION['Email']    = $row['Email'];

            if (strtolower($row['Email']) === 'admin@absolutecinema.com') {
                $_SESSION['is_admin'] = true;
                mysqli_close($conn);
                header("Location: admin.php");
                exit();
            } 
            // Regular user
            else {
                mysqli_close($conn);
                header("Location: profile.php");
                exit();
            }
        } else {
            $error = 'The email address and/or password you entered is incorrect.';
        }

        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Absolute Cinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Serif+Display&display=swap");
    body { font-family: "DM Sans", sans-serif; }
    h1, h2 { font-family: "DM Serif Display", serif; }
  </style>
</head>
<body class="bg-zinc-950 text-zinc-300 min-h-screen">

  <!-- Nav -->
  <nav class="border-b border-zinc-800 sticky top-0 z-50 bg-zinc-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-2 text-white">
        <i class="fa-solid fa-ticket text-violet-400 text-xl"></i>
        <span class="text-lg font-semibold tracking-tight">Absolute Cinema</span>
      </div>
      <div class="flex items-center gap-3">
        <a href="homepage.php" class="text-sm text-zinc-400 hover:text-white">← Back to Home</a>
      </div>
    </div>
  </nav>

  <div class="min-h-[calc(100vh-80px)] flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">
      <div class="text-center mb-10">
        <h1 class="text-4xl text-white mb-3">Welcome Back</h1>
        <p class="text-zinc-400">Sign in to access your tickets and events</p>
      </div>

      <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

        <?php if ($error): ?>
          <div class="mb-6 p-3 bg-red-950 border border-red-700 rounded-lg text-red-300 text-sm text-center">
            <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
          <div class="space-y-6">
            <div>
              <label class="block text-sm text-zinc-400 mb-2">Email Address</label>
              <input type="email" name="email" required
                class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-5 py-3 text-white focus:outline-none focus:border-violet-500 transition-colors"
                placeholder="you@example.com"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
            </div>

            <div>
              <label class="block text-sm text-zinc-400 mb-2">Password</label>
              <input type="password" name="password" required
                class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-5 py-3 text-white focus:outline-none focus:border-violet-500 transition-colors"
                placeholder="••••••••" />
            </div>

            <div class="flex items-center justify-between">
              <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" class="w-4 h-4 accent-violet-600" />
                <span class="text-zinc-400">Remember me</span>
              </label>
              <a href="#" class="text-sm text-violet-400 hover:text-violet-300">Forgot Password?</a>
            </div>

            <button type="submit" name="submit"
              class="w-full bg-violet-600 hover:bg-violet-500 text-white py-3.5 rounded-2xl font-medium text-base transition-colors">
              Sign In
            </button>
          </div>
        </form>

                <div class="mt-8 text-center">
          <p class="text-zinc-400">
            Don't have an account? 
            <a href="signup.php" class="text-violet-400 hover:text-violet-300 font-medium">Sign up</a>
          </p>
          
          <!-- NEW: Admin Login Button -->
          <p class="mt-6 pt-6 border-t border-zinc-800">
            <a href="admin-login.php" 
               class="inline-flex items-center gap-2 text-xs text-violet-400 hover:text-violet-300">
              <i class="fa-solid fa-shield-halved"></i>
              Admin Login
            </a>
          </p>
        </div>
      </div>

      <!-- Social Login (UI only) -->
      <div class="mt-6">
        <div class="relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-zinc-800"></div>
          </div>
          <div class="relative text-center">
            <span class="bg-zinc-950 px-4 text-xs text-zinc-500">OR</span>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-6">
          <button class="flex items-center justify-center gap-3 bg-zinc-900 border border-zinc-700 hover:border-zinc-600 py-3 rounded-2xl transition-colors">
            <i class="fa-brands fa-google text-red-500"></i>
            <span class="text-sm">Google</span>
          </button>
          <button class="flex items-center justify-center gap-3 bg-zinc-900 border border-zinc-700 hover:border-zinc-600 py-3 rounded-2xl transition-colors">
            <i class="fa-brands fa-facebook-f text-blue-500"></i>
            <span class="text-sm">Facebook</span>
          </button>
        </div>
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