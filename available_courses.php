<?php
$required_role = "student";
require "auth_check.php";
require "db_connect.php";

$student_id = $_SESSION['user_id'];

$query = "
    SELECT course_id, course_name, description
    FROM courses
    WHERE course_id NOT IN (
        SELECT course_id FROM course_requests WHERE student_id = ?
    )
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Courses</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Global Reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Page Layout */
body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    min-height: 100vh;
    padding: 40px 20px;
    color: #eaeaea;
}

/* Heading */
h2 {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 25px;
    text-align: center;
    letter-spacing: 0.5px;
}

/* Course Grid */
.course-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    max-width: 1100px;
    margin: 0 auto;
}

/* Course Card */
.course-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(12px);
    border-radius: 18px;
    padding: 22px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: 1px solid rgba(255, 255, 255, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.course-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
}

/* Card Title */
.course-card h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 12px;
    color: #ffffff;
}

/* Card Description */
.course-card p {
    font-size: 14px;
    line-height: 1.6;
    color: #d0d6dc;
    margin-bottom: 20px;
}

/* Button */
.course-card button {
    align-self: flex-start;
    padding: 10px 18px;
    font-size: 14px;
    font-weight: 500;
    color: #ffffff;
    background: linear-gradient(135deg, #ff512f, #dd2476);
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: opacity 0.25s ease, transform 0.25s ease;
}

.course-card button:hover {
    opacity: 0.85;
    transform: scale(1.05);
}

/* Empty State */
.no-courses {
    margin-top: 60px;
    text-align: center;
    font-size: 17px;
    color: #f3b6c8;
    opacity: 0.9;
}

    </style>
</head>
<body>

<h2>New Courses Available</h2>

<?php if ($result->num_rows === 0): ?>


<div class="no-courses">No new courses available.</div>


<?php else: ?>


<div class="course-container">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="course-card">
            <h3><?php echo htmlspecialchars($row['course_name']); ?></h3>
            <p><?php echo htmlspecialchars($row['description'] ?: 'No description'); ?></p>
            <button onclick="requestJoin(<?php echo $row['course_id']; ?>)">Request to Join</button>
        </div>
    <?php endwhile; ?>
</div>


<?php endif; ?>

<script>
function requestJoin(courseId) {
    Swal.fire({
        title: 'Request to join this course?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, request',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('request_join.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'course_id=' + courseId
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    Swal.fire('Success', 'Request sent successfully!', 'success')
                    .then(() => location.reload());
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error', 'Unexpected error occurred.', 'error');
            });
        }
    });
}
</script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
