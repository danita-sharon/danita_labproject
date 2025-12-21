<?php
$required_role = "faculty";
require "auth_check.php";
require "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Management</title>

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
    min-height: 100vh;
    color: #1f2933;
}

/* Header */
h2 {
    text-align: center;
    font-size: 28px;
    font-weight: 600;
    padding: 40px 20px 10px;
    color: #111827;
}

/* Description */
p {
    text-align: center;
    font-size: 16px;
    max-width: 600px;
    margin: 10px auto 40px;
    color: #6b7280;
    line-height: 1.6;
}

/* Menu Grid */
ul {
    list-style: none;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    max-width: 1000px;
    margin: 0 auto 60px;
    padding: 0 24px;
}

/* Menu Card */
ul li {
    background: #ffffff;
    border-radius: 16px;
    padding: 28px 20px;
    text-align: center;
    font-size: 18px;
    font-weight: 500;
    border: 1px solid #e5e7eb;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover Effect */
ul li:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12);
}

/* Links */
ul li a {
    text-decoration: none;
    color: #111827;
    display: block;
    transition: color 0.25s ease;
}

/* Link Hover */
ul li a:hover {
    color: #2563eb;
}


    </style>
</head>

<body>

<h2>COURSE MANAGEMENT</h2>
<p>Manage your courses — create, edit, delete, and approve student join requests.</p>

<ul>
    <li><a href="createCourse.php">Create New Course</a></li>
    <li><a href="edit_course_form.php">Edit Course</a></li>
    <li><a href="delete_course.html">Delete Course</a></li>
    <li><a href="view_enrolled_students.php">Pending Student Requests</a></li>
    <li><a href="list_courses.php">View Courses</a></li>
</ul>

</body>
</html>
