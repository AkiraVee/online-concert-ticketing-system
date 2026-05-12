<?php
// faqs.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Absolute Cinema - FAQs</title>
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
        <a href="login.php"
           class="text-sm text-zinc-400 hover:text-white px-3 py-1.5">
          Login
        </a>
        <a href="signup.php"
           class="text-sm bg-violet-600 hover:bg-violet-500 text-white px-4 py-1.5 rounded-lg">
          Sign Up
        </a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="py-20 px-6 text-center"
    style="background: radial-gradient(ellipse at 50% 0%, rgba(124, 58, 237, 0.15) 0%, transparent 70%);">
    <p class="text-violet-400 text-sm font-medium mb-3 tracking-widest uppercase">
      Support Center
    </p>
    <h1 class="text-5xl text-white mb-4">Frequently Asked Questions</h1>
    <p class="text-zinc-400 max-w-2xl mx-auto text-sm md:text-base">
      Find answers to common questions about ticket purchases, payments, 
      E-tickets, refunds, and account management.
    </p>
  </section>

  <!-- FAQ SECTION -->
  <main class="max-w-4xl mx-auto px-6 pb-20">
    <div class="space-y-4">

      <!-- FAQ 1 -->
      <div class="faq-item bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="w-full flex items-center justify-between px-6 py-5 text-left">
          <span class="text-white font-medium text-lg">How do I purchase tickets?</span>
          <i class="fa-solid fa-circle-question text-violet-400"></i>
        </div>
        <div class="px-6 pb-5 text-zinc-400 text-sm leading-7">
          You can purchase tickets directly through the Absolute Cinema 
          website by browsing available events, selecting your preferred 
          seats, and completing the payment process online.
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="faq-item bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="w-full flex items-center justify-between px-6 py-5 text-left">
          <span class="text-white font-medium text-lg">How do I purchase tickets online?</span>
          <i class="fa-solid fa-circle-question text-violet-400"></i>
        </div>
        <div class="px-6 pb-5 text-zinc-400 text-sm leading-7">
          <ol class="list-decimal ml-5 space-y-2">
            <li>Browse available events from the homepage.</li>
            <li>Select the event you want to attend.</li>
            <li>Choose your preferred ticket section and seat(s).</li>
            <li>Click the Buy Ticket button.</li>
            <li>Login or create an account.</li>
            <li>Review your order summary.</li>
            <li>Select your payment method.</li>
            <li>Complete the payment process.</li>
            <li>Your ticket will appear under My Account → My Tickets.</li>
          </ol>
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="faq-item bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="w-full flex items-center justify-between px-6 py-5 text-left">
          <span class="text-white font-medium text-lg">What payment methods are accepted?</span>
          <i class="fa-solid fa-circle-question text-violet-400"></i>
        </div>
        <div class="px-6 pb-5 text-zinc-400 text-sm leading-7">
          We currently accept Debit Cards, Credit Cards, GCash, Maya, and GrabPay.
        </div>
      </div>

      <!-- FAQ 4 -->
      <div class="faq-item bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="w-full flex items-center justify-between px-6 py-5 text-left">
          <span class="text-white font-medium text-lg">Where can I view my purchased tickets?</span>
          <i class="fa-solid fa-circle-question text-violet-400"></i>
        </div>
        <div class="px-6 pb-5 text-zinc-400 text-sm leading-7">
          You can view your purchased tickets under: 
          <span class="text-violet-400">My Account → My Tickets</span>
        </div>
      </div>

      <!-- FAQ 5 -->
      <div class="faq-item bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="w-full flex items-center justify-between px-6 py-5 text-left">
          <span class="text-white font-medium text-lg">Can I download my E-ticket?</span>
          <i class="fa-solid fa-circle-question text-violet-400"></i>
        </div>
        <div class="px-6 pb-5 text-zinc-400 text-sm leading-7">
          Yes. E-tickets can be downloaded from: 
          <span class="text-violet-400">My Account → My Tickets → My E-Tickets</span>
        </div>
      </div>

      <!-- FAQ 6 -->
      <div class="faq-item bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="w-full flex items-center justify-between px-6 py-5 text-left">
          <span class="text-white font-medium text-lg">I can't download my E-ticket. What should I do?</span>
          <i class="fa-solid fa-circle-question text-violet-400"></i>
        </div>
        <div class="px-6 pb-5 text-zinc-400 text-sm leading-7">
          If you cannot download your E-ticket:
          <ul class="list-disc ml-5 mt-2 space-y-2">
            <li>Check if your browser has a pop-up blocker enabled.</li>
            <li>Try using another browser.</li>
            <li>Ensure you have a PDF reader installed.</li>
          </ul>
        </div>
      </div>

      <!-- FAQ 7 -->
      <div class="faq-item bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="w-full flex items-center justify-between px-6 py-5 text-left">
          <span class="text-white font-medium text-lg">Can I cancel or refund my ticket?</span>
          <i class="fa-solid fa-circle-question text-violet-400"></i>
        </div>
        <div class="px-6 pb-5 text-zinc-400 text-sm leading-7">
          Tickets are generally non-refundable and non-transferable unless 
          the event is canceled or officially rescheduled.
        </div>
      </div>

      <!-- FAQ 8 -->
      <div class="faq-item bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
        <div class="w-full flex items-center justify-between px-6 py-5 text-left">
          <span class="text-white font-medium text-lg">Are minors allowed to attend events?</span>
          <i class="fa-solid fa-circle-question text-violet-400"></i>
        </div>
        <div class="px-6 pb-5 text-zinc-400 text-sm leading-7">
          Some events may require parental guidance for attendees below 18 
          years old. Please check the event details page for age restrictions.
        </div>
      </div>

    </div>
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