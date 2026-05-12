<?php
// terms.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Absolute Cinema - Terms & Privacy</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-zinc-950 text-zinc-300">

  <!-- NAVBAR -->
  <nav class="border-b border-zinc-800 sticky top-0 z-50 bg-zinc-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-2 text-white">
        <i class="fa-solid fa-ticket text-violet-400 text-xl"></i>
        <span class="text-lg font-semibold tracking-tight">Absolute Cinema</span>
      </div>

      <div class="hidden md:flex items-center gap-6 text-sm text-zinc-400">
        <a href="index.php" class="hover:text-white">Home</a>
        <a href="profile.php" class="hover:text-white">My Profile</a>
      </div>

      <div class="flex items-center gap-3">
        <a href="login.php" class="text-sm text-zinc-400 hover:text-white px-3 py-1.5">Login</a>
        <a href="signup.php" class="text-sm bg-violet-600 hover:bg-violet-500 text-white px-4 py-1.5 rounded-lg">Sign Up</a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="py-20 px-6 text-center"
    style="background: radial-gradient(ellipse at 50% 0%, rgba(124, 58, 237, 0.15) 0%, transparent 70%);">
    <p class="text-violet-400 text-sm font-medium mb-3 tracking-widest uppercase">
      Policies & Guidelines
    </p>
    <h1 class="text-5xl text-white mb-4">Terms of Use & Privacy Policy</h1>
    <p class="text-zinc-400 max-w-3xl mx-auto text-sm md:text-base leading-7">
      Please read these terms carefully before using Absolute Cinema services. 
      By accessing and using this website, you agree to comply with our privacy 
      policies, ticketing guidelines, and terms of service.
    </p>
  </section>

  <!-- CONTENT -->
  <main class="max-w-5xl mx-auto px-6 pb-20 space-y-8">

    <!-- PRIVACY POLICY -->
    <section class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">
      <div class="flex items-center gap-3 mb-6">
        <i class="fa-solid fa-shield-halved text-violet-400 text-2xl"></i>
        <h2 class="text-3xl text-white">Privacy Policy</h2>
      </div>

      <div class="space-y-8 text-sm leading-8 text-zinc-400">
        <div>
          <h3 class="text-white text-xl mb-3">1. Privacy Statement</h3>
          <p>Absolute Cinema collects, processes, and stores personal data when users access the platform, purchase tickets, create accounts, or use any of our services. We are committed to protecting your information in compliance with the Data Privacy Act of 2012 and related Philippine laws.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">2. Collection of Personal Data</h3>
          <p>We may collect personal information such as your full name, email address, mobile number, billing information, and account details when you register, purchase tickets, contact support, or interact with our services.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">3. Use and Processing of Personal Data</h3>
          <p>Your information may be used to process ticket purchases, verify transactions, improve our services, provide customer support, and send announcements, promotions, or event-related updates.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">4. Sharing of Personal Data</h3>
          <p>Absolute Cinema may share data with payment gateways, technical service providers, event organizers, and government authorities when legally required.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">5. Storage and Protection of Personal Data</h3>
          <p>We implement appropriate security measures to protect user data against unauthorized access, misuse, or disclosure.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">6. Use of Cookies</h3>
          <p>Our website uses cookies to improve user experience, remember preferences, and analyze site traffic.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">7. User Responsibility</h3>
          <p>Users are responsible for keeping their account credentials secure.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">8. Your Rights Under the Data Privacy Act</h3>
          <ul class="list-disc ml-6 space-y-2">
            <li>Right to be informed</li>
            <li>Right to object</li>
            <li>Right to access your personal data</li>
            <li>Right to correct inaccurate information</li>
            <li>Right to suspend or remove personal data</li>
            <li>Right to data portability</li>
            <li>Right to compensation for damages</li>
          </ul>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">9. Changes to the Privacy Policy</h3>
          <p>Absolute Cinema reserves the right to update this Privacy Policy at any time.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">10. Contact Us</h3>
          <p>For questions regarding privacy, please contact our support team.</p>
        </div>
      </div>
    </section>

    <!-- TERMS OF USE -->
    <section class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8">
      <div class="flex items-center gap-3 mb-6">
        <i class="fa-solid fa-file-contract text-violet-400 text-2xl"></i>
        <h2 class="text-3xl text-white">Terms of Use</h2>
      </div>

      <div class="space-y-8 text-sm leading-8 text-zinc-400">
        <div>
          <h3 class="text-white text-xl mb-3">Disclaimer</h3>
          <p>Absolute Cinema provides this platform as an online ticketing service. We strive to maintain secure and reliable services but do not guarantee uninterrupted access.</p>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">Purchases</h3>
          <ul class="list-disc ml-6 space-y-2">
            <li>Tickets are generally non-refundable and non-transferable.</li>
            <li>Refunds are only issued for officially canceled or rescheduled events.</li>
            <li>Users are responsible for the accuracy of their payment information.</li>
          </ul>
        </div>

        <div>
          <h3 class="text-white text-xl mb-3">Governing Laws</h3>
          <p>These Terms shall be governed by the laws of the Republic of the Philippines.</p>
        </div>
      </div>
    </section>

  </main>

  <!-- FOOTER -->
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