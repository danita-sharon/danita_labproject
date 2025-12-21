<?php
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout | Attendance Management Portal</title>

  <style>
    /* Reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Page */
body {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    background: #ffffff;
    color: #111827;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Logo */
.logo {
    width: 110px;
    position: absolute;
    top: 24px;
    right: 32px;
    opacity: 0.9;
}

/* Logout Card */
.logout-box {
    max-width: 480px;
    margin: auto;
    padding: 44px 36px;
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e5e7eb;
    text-align: center;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.06);
}

/* Heading */
h2 {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 14px;
}

/* Message */
p {
    font-size: 15px;
    color: #4b5563;
    margin-bottom: 30px;
    line-height: 1.6;
}

/* Button */
a button {
    background: #2563eb;
    color: #ffffff;
    border: none;
    padding: 12px 36px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.25s ease, transform 0.25s ease;
}

a button:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

/* Footer */
footer {
    margin-top: auto;
    background: #ffffff;
    border-top: 1px solid #e5e7eb;
    text-align: center;
    padding: 14px;
    font-size: 13px;
    color: #6b7280;
}


    /* Responsive Design */
    @media (max-width: 600px) {
      .logo {
        width: 90px;
        top: 10px;
        right: 20px;
      }

      .logout-box {
        width: 85%;
        padding: 30px;
      }

      h2 {
        font-size: 24px;
      }

      p {
        font-size: 16px;
      }
    }
  </style>
</head>

<body>
  <!-- Ashesi Logo -->
  <img src="ashesilogo.png"
       alt="Ashesi University Logo" class="logo">

  
  <div class="logout-box">
    <h2>You've Successfully Logged Out</h2>
    <p>Thank you for using the <strong>Ashesi Attendance Management Portal.</strong><br>
       We hope to see you again soon!</p>
    <a href="Login.php">
      <button>Log In</button>
    </a>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Ashesi University | Attendance Management System</p>
  </footer>
</body>
</html>
