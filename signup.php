<?php
// signup.php

$message = '';
if (isset($_POST['submit'])) {
    // Field names match the HTML form's name="" attributes below
    $fullName      = trim($_POST['fullName'] ?? '');
    $email         = trim($_POST['email'] ?? '');
    $birthday      = $_POST['birthday'] ?? '';
    $age           = $_POST['age'] ?? '';
    $contactNumber = trim($_POST['contactNumber'] ?? '');
    $password      = $_POST['password'] ?? '';
    $confirm       = $_POST['confirmPassword'] ?? '';

    if (empty($fullName) || empty($email) || empty($password) || empty($birthday) || empty($age) || empty($contactNumber)) {
        $message = '<p class="text-red-400 text-sm">Please fill in all required fields.</p>';
    } elseif ($password !== $confirm) {
        $message = '<p class="text-red-400 text-sm">Passwords do not match.</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<p class="text-red-400 text-sm">Please enter a valid email address.</p>';
    } else {
        include('mysql-connect.php');

        // Check if email already exists
        $checkQuery = "SELECT UserID FROM usertb WHERE Email='$email'";
        $checkResult = @mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            $message = '<p class="text-red-400 text-sm">An account with that email already exists.</p>';
        } else {
            // Column names match exactly what's in the DB: FullName, Email, Birthdate, Age, ContactNumber, password
            $query = "INSERT INTO usertb (FullName, Email, Birthdate, Age, ContactNumber, password)
            VALUES ('$fullName', '$email', '$birthday', '$age', '$contactNumber', SHA('$password'))";

            $result = @mysqli_query($conn, $query);

            if ($result) {
                $message = '<p class="text-emerald-400 text-sm">Account created successfully! Redirecting to login...</p>';
                echo "<script>
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 1500);
                </script>";
            } else {
                $message = '<p class="text-red-400 text-sm">Something went wrong. Please try again.</p>';
            }

            mysqli_close($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Absolute Cinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Serif+Display&display=swap');
    body { font-family: 'DM Sans', sans-serif; }
    h1, h2 { font-family: 'DM Serif Display', serif; }

    .form-input {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .form-input:focus {
      border-color: rgb(167 139 250);
      box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.15);
      transform: translateY(-1px);
    }
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
      <a href="homepage.php" class="text-sm text-zinc-400 hover:text-white flex items-center gap-1">
        ← Back to Home
      </a>
    </div>
  </nav>

  <div class="min-h-[calc(100vh-80px)] flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">
      <div class="text-center mb-10">
        <h1 class="text-5xl text-white mb-3 tracking-tight">Create Account</h1>
        <p class="text-zinc-400 text-lg">Join the ultimate cinema experience</p>
      </div>

      <!-- Main Card -->
      <div class="bg-zinc-900 border border-zinc-700/50 rounded-3xl p-10 shadow-2xl shadow-black/60">
        
        <?php if ($message): ?>
          <div class="mb-8 text-center">
            <?= $message ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="signup.php">
          <div class="space-y-6">
            
            <!-- Full Name -->
            <div>
              <label class="block text-sm text-zinc-400 mb-2">Full Name</label>
              <div class="relative">
                <i class="fa-solid fa-user absolute left-5 top-1/2 -translate-y-1/2 text-zinc-500"></i>
                <input type="text" name="fullName" required
                  class="form-input w-full bg-zinc-950 border border-zinc-700 rounded-2xl pl-12 pr-5 py-4 text-white placeholder-zinc-500 focus:outline-none"
                  placeholder="Juan Dela Cruz"
                  value="<?= htmlspecialchars($_POST['fullName'] ?? '') ?>">
              </div>
            </div>

            <!-- Email -->
            <div>
              <label class="block text-sm text-zinc-400 mb-2">Email Address</label>
              <div class="relative">
                <i class="fa-solid fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-zinc-500"></i>
                <input type="email" name="email" required
                  class="form-input w-full bg-zinc-950 border border-zinc-700 rounded-2xl pl-12 pr-5 py-4 text-white placeholder-zinc-500 focus:outline-none"
                  placeholder="you@example.com"
                  value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
              </div>
            </div>

            <!-- Birthday & Age -->
            <div class="grid grid-cols-2 gap-5">
              <div>
                <label class="block text-sm text-zinc-400 mb-2">Birthday</label>
                <div class="relative">
                  <i class="fa-solid fa-calendar absolute left-5 top-1/2 -translate-y-1/2 text-zinc-500"></i>
                  <input type="date" name="birthday" required
                    class="form-input w-full bg-zinc-950 border border-zinc-700 rounded-2xl pl-12 pr-5 py-4 text-white focus:outline-none"
                    value="<?= htmlspecialchars($_POST['birthday'] ?? '') ?>">
                </div>
              </div>

              <div>
                <label class="block text-sm text-zinc-400 mb-2">Age </label>
                <input type="number" name="age" min="18" max="100" required
                  class="form-input w-full bg-zinc-950 border border-zinc-700 rounded-2xl px-5 py-4 text-white placeholder-zinc-500 focus:outline-none"
                  placeholder="18"
                  value="<?= htmlspecialchars($_POST['age'] ?? '') ?>">
                  <p class="text-xs text-amber-500 mt-2">Must be 18+</p>
              </div>
            </div>

            <!-- Contact Number -->
            <div>
              <label class="block text-sm text-zinc-400 mb-2">Contact Number</label>
              <div class="relative">
                <i class="fa-solid fa-phone absolute left-5 top-1/2 -translate-y-1/2 text-zinc-500"></i>
                <input type="tel" 
                       name="contactNumber"
                       required
                       maxlength="11"
                       pattern="09[0-9]{9}"
                       class="form-input w-full bg-zinc-950 border border-zinc-700 rounded-2xl pl-12 pr-5 py-4 text-white placeholder-zinc-500 focus:outline-none"
                       placeholder="09123456789"
                       value="<?= htmlspecialchars($_POST['contactNumber'] ?? '') ?>">
              </div>
              <p class="text-xs text-amber-500 mt-2">Must start with 09 (11 digits)</p>
            </div>

            <!-- Password -->
            <div>
              <label class="block text-sm text-zinc-400 mb-2">Password</label>
              <div class="relative">
                <i class="fa-solid fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-zinc-500"></i>
                <input type="password" name="password" required
                  class="form-input w-full bg-zinc-950 border border-zinc-700 rounded-2xl pl-12 pr-5 py-4 text-white placeholder-zinc-500 focus:outline-none"
                  placeholder="Create a strong password">
              </div>
            </div>

            <!-- Confirm Password -->
            <div>
              <label class="block text-sm text-zinc-400 mb-2">Confirm Password</label>
              <div class="relative">
                <i class="fa-solid fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-zinc-500"></i>
                <input type="password" name="confirmPassword" required
                  class="form-input w-full bg-zinc-950 border border-zinc-700 rounded-2xl pl-12 pr-5 py-4 text-white placeholder-zinc-500 focus:outline-none"
                  placeholder="Confirm your password">
              </div>
            </div>

            <!-- Terms -->
            <div class="flex items-start gap-3 pt-2">
              <input type="checkbox" required class="mt-1 w-5 h-5 accent-violet-600 bg-zinc-950 border-zinc-600">
              <p class="text-xs text-zinc-500 leading-relaxed">
                I agree to the <a href="terms.php" class="text-violet-400 hover:text-violet-300">Terms of Service</a> and 
                <a href="terms.php" class="text-violet-400 hover:text-violet-300">Privacy Policy</a>
              </p>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="submit"
              class="w-full bg-gradient-to-r from-violet-600 to-fuchsia-600 hover:from-violet-500 hover:to-fuchsia-500 text-white py-4 rounded-2xl font-semibold text-lg tracking-wide transition-all duration-300 shadow-lg shadow-violet-500/30 hover:shadow-xl hover:-translate-y-0.5">
              Create Account
            </button>

          </div>
        </form>

        <div class="mt-8 text-center">
          <p class="text-zinc-400">
            Already have an account? 
            <a href="login.php" class="text-violet-400 hover:text-violet-300 font-medium">Sign in</a>
          </p>
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