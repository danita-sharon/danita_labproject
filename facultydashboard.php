<?php
$required_role = "faculty";
require "auth_check.php";
require "db_connect.php";
$faculty_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Dashboard | Attendance Management Portal</title>
  <style>
    /* Page Setup */
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
    line-height: 1.6;
}

/* Header */
header {
    background: #ffffff;
    padding: 50px 24px 30px;
    text-align: center;
    border-bottom: 1px solid #e5e7eb;
}

header h2 {
    font-size: 34px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 8px;
}

header h4 {
    font-size: 16px;
    font-weight: 400;
    color: #6b7280;
    max-width: 700px;
    margin: 0 auto;
}

/* Navigation */
nav {
    background: #ffffff;
    position: sticky;
    top: 0;
    z-index: 10;
    border-bottom: 1px solid #e5e7eb;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 22px;
    padding: 14px 16px;
    flex-wrap: wrap;
}

nav ul li a {
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    padding: 8px 14px;
    border-radius: 999px;
    transition: background 0.25s ease, color 0.25s ease;
}

nav ul li a:hover {
    background: #f3f4f6;
    color: #111827;
}

/* Content Sections */
section {
    max-width: 1000px;
    margin: 50px auto;
    padding: 36px 28px;
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

section h3 {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 12px;
    color: #111827;
}

section p {
    font-size: 15px;
    color: #4b5563;
    margin-bottom: 20px;
}

/* Section Links */
section ul {
    list-style: none;
    padding-left: 0;
}

section ul li {
    margin-bottom: 10px;
}

section ul li a {
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    color: #2563eb;
    transition: color 0.25s ease;
}

section ul li a:hover {
    color: #1d4ed8;
}

/* Footer */
footer {
    background: #ffffff;
    border-top: 1px solid #e5e7eb;
    text-align: center;
    padding: 16px;
    font-size: 13px;
    color: #6b7280;
}

  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h2>FACULTY DASHBOARD</h2>
    <h4>Hello Professor! This is your control center for managing courses, tracking sessions, and viewing attendance reports.</h4>
  </header>

  <!-- Navigation Bar -->
  <nav>
    <ul>
      <li><a href="course_management.php">Course Management</a></li>
      <li><a href="#session-overview">Session Overview</a></li>
      <li><a href="#attendance-reports">Attendance Reports</a></li>
      <li><a href="#student-performance">Student Performance</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </nav>

  <section id="session-overview">
    <h3>Session Overview</h3>
    <p>Monitor current and past sessions for your courses.</p>
    <ul>
      <li><a href="#new session">Start New Session</a></li>
      <li><a href="#current session">View Ongoing Sessions</a></li>
      <li><a href="#endsession">End Session</a></li>
    </ul>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Load pending requests
async function fetchRequests() {
    const res = await fetch('fetch_requests.php');
    const data = await res.json();
    const tbody = document.getElementById('requestsTableBody');
    tbody.innerHTML = '';
    data.forEach(req => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${req.request_id}</td>
            <td>${req.course_name}</td>
            <td>${req.student_id}</td>
            <td>${req.requested_at}</td>
            <td>
                <button onclick="processRequest(${req.request_id}, 'approve')">Approve</button>
                <button onclick="processRequest(${req.request_id}, 'reject')">Reject</button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Approve or reject requests
async function processRequest(requestId, action){
    const res = await fetch(`process_request.php?request_id=${requestId}&action=${action}`);
    const result = await res.json();
    if(result.success){
        Swal.fire('Success','Request processed','success');
        fetchRequests(); // Refresh table
    } else {
        Swal.fire('Error', result.message, 'error');
    }
}

// Create course
document.getElementById('createCourseForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const formData = new FormData(this);
    const res = await fetch('create_course.php', {method:'POST', body:formData});
    const result = await res.json();
    if(result.success){
        Swal.fire('Success', result.message, 'success');
    } else {
        Swal.fire('Error', result.message, 'error');
    }
});

// Initial load
fetchRequests();
</script>


  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Ashesi University | Attendance Management System</p>
  </footer>

</body>
</html>
