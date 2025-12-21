<?php
$required_role = "faculty";
require "auth_check.php";
require "db_connect.php";

$query = "SELECT * FROM courses WHERE faculty_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']); 
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Course to Edit</title>
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
    padding: 40px 24px;
    color: #111827;
}

/* Table */
table {
    width: 90%;
    max-width: 1000px;
    margin: 20px auto;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
}

/* Table Head */
th {
    background: #f9fafb;
    color: #374151;
    font-size: 14px;
    font-weight: 600;
    padding: 14px 16px;
    border-bottom: 1px solid #e5e7eb;
}

/* Table Body */
td {
    padding: 14px 16px;
    font-size: 14px;
    color: #111827;
    border-bottom: 1px solid #f1f5f9;
}

/* Row Hover */
tr:hover td {
    background: #f9fafb;
}

/* Edit Button */
a.edit-btn {
    display: inline-block;
    padding: 7px 16px;
    font-size: 13px;
    font-weight: 500;
    color: #2563eb;
    background: #eff6ff;
    border-radius: 999px;
    text-decoration: none;
    transition: background 0.25s ease, color 0.25s ease;
}

a.edit-btn:hover {
    background: #2563eb;
    color: #ffffff;
}

    </style>
</head>
<body>

<h2>Select a Course to Edit</h2>

<?php if ($result->num_rows === 0): ?>
    <p>No courses found for your account.</p>
<?php else: ?>
<table>
    <tr>
        <th>Course Code</th>
        <th>Course Name</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo htmlspecialchars($row['course_code']); ?></td>
        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
        <td>
            <a class="edit-btn" href="update_course.php?id=<?php echo $row['course_id']; ?>">Edit</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php endif; ?>

</body>
</html>
