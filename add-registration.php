<?php require_once('./database/connection.php'); ?>

<?php
$sql = "SELECT * FROM `students`";
$result = $conn->query($sql);
$students = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `courses`";
$result = $conn->query($sql);
$courses = $result->fetch_all(MYSQLI_ASSOC);

$student_id = $course_id = "";

if (isset($_POST['submit'])) {

    $student_id = htmlspecialchars($_POST['student_id']);
    $course_id = htmlspecialchars($_POST['course_id']);

    if (empty($student_id)) {
        $error = "Select the student!";
    } elseif (empty($course_id)) {
        $error = "Select the course!";
    } else {
        $sql = "INSERT INTO `registrations`(`student_id`, `course_id`) VALUES ('$student_id','$course_id')";
        if ($conn->query($sql)) {
            $success = "Magic has been spelled!";
        } else {
            $error = "Magic has failed to spell!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('./includes/head.php'); ?>

<body>
    <div class="wrapper">

        <?php require_once('./includes/sidenavbar.php'); ?>

        <div class="main">

            <?php require_once('./includes/topnavbar.php'); ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="h3 mb-3">Add Registration</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./show-registrations.php" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                        <?php require_once('./includes/flash-messages.php'); ?>

                                        <div class="mb-3">
                                            <label for="student_id" class="form-label">Student</label>
                                            <select name="student_id" id="student_id" class="form-select">
                                                <option value="" selected hidden>Select a student!</option>
                                                <?php
                                                foreach ($students as $student) {
                                                    if ($student_id === $student['id']) { ?>
                                                        <option value="<?php echo $student['id']; ?>" selected><?php echo $student['name']; ?></option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="<?php echo $student['id']; ?>"><?php echo $student['name']; ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="course_id" class="form-label">Course</label>
                                            <select name="course_id" id="course_id" class="form-select">
                                                <option value="" selected hidden>Select a course!</option>
                                                <?php
                                                foreach ($courses as $course) {
                                                    if ($course_id === $course['id']) { ?>
                                                        <option value="<?php echo $course['id']; ?>" selected><?php echo $course['name']; ?></option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div>
                                            <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php require_once('./includes/footer.php'); ?>

        </div>
    </div>

    <script src="assets/js/app.js"></script>
</body>

</html>