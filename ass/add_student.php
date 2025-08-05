<?php
require_once 'StudentManager.php';

// Initialize student manager
$studentManager = new StudentManager();
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentID = trim($_POST['student_id'] ?? '');
    $fullName = trim($_POST['full_name'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $yearLevel = trim($_POST['year_level'] ?? '');

    // Validation
    if (empty($studentID) || empty($fullName) || empty($course) || empty($yearLevel)) {
        $message = 'All fields are required!';
        $messageType = 'danger';
    } elseif (!preg_match('/^\d{4}-\d{4}$/', $studentID)) {
        $message = 'Student ID must be in NDDU format: YYYY-XXXX (e.g., 2023-1234)';
        $messageType = 'danger';
    } elseif (!is_numeric($yearLevel) || $yearLevel < 1 || $yearLevel > 4) {
        $message = 'Year level must be between 1 and 4!';
        $messageType = 'danger';
    } else {
        // Check if student ID exists
        if ($studentManager->findStudentByID($studentID)) {
            $message = 'Student ID already exists in the system!';
            $messageType = 'danger';
        } else {
            // Create and add new student
            $student = new Student($studentID, $fullName, $course, $yearLevel);
            
            if ($studentManager->addStudent($student)) {
                $message = 'Student record added successfully!';
                $messageType = 'success';
                $_POST = array(); // Clear form
            } else {
                $message = 'Error saving student record. Please try again.';
                $messageType = 'danger';
            }
        }
    }
}

// Set page title
$pageTitle = "New Student Registration - NDDU SIS";
require_once 'header.php';
?>
<link rel="stylesheet" href="style.css">
<div class="container main-content">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="nddu-form">
                <h2 class="text-center mb-4"><i class="fas fa-user-graduate me-2"></i>New Student Registration</h2>
                
                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $messageType; ?> nddu-alert alert-dismissible fade show">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" 
                               value="<?php echo htmlspecialchars($_POST['student_id'] ?? ''); ?>" 
                               placeholder="2023-1234" required
                               pattern="\d{4}-\d{4}"
                               title="NDDU Student ID format: YYYY-XXXX">
                        <div class="form-text">Official NDDU Student ID format (e.g., 2023-1234)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" 
                               value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>" 
                               placeholder="Last Name, First Name Middle Initial" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="course" class="form-label">Degree Program</label>
                        <select class="form-select" id="course" name="course" required>
                            <option value="">Select Degree Program</option>
                            <option value="BS in Information Technology" <?php echo ($_POST['course'] ?? '') === 'BS in Information Technology' ? 'selected' : ''; ?>>BS in Information Technology</option>
                            <option value="BS in Computer Science" <?php echo ($_POST['course'] ?? '') === 'BS in Computer Science' ? 'selected' : ''; ?>>BS in Computer Science</option>
                            <option value="BS in Civil Engineering" <?php echo ($_POST['course'] ?? '') === 'BS in Civil Engineering' ? 'selected' : ''; ?>>BS in Civil Engineering</option>
                            <option value="BS in Electrical Engineering" <?php echo ($_POST['course'] ?? '') === 'BS in Electrical Engineering' ? 'selected' : ''; ?>>BS in Electrical Engineering</option>
                            <option value="BS in Accountancy" <?php echo ($_POST['course'] ?? '') === 'BS in Accountancy' ? 'selected' : ''; ?>>BS in Accountancy</option>
                            <option value="BS in Business Administration" <?php echo ($_POST['course'] ?? '') === 'BS in Business Administration' ? 'selected' : ''; ?>>BS in Business Administration</option>
                            <option value="BS in Nursing" <?php echo ($_POST['course'] ?? '') === 'BS in Nursing' ? 'selected' : ''; ?>>BS in Nursing</option>
                            <option value="Bachelor of Secondary Education" <?php echo ($_POST['course'] ?? '') === 'Bachelor of Secondary Education' ? 'selected' : ''; ?>>Bachelor of Secondary Education</option>
                            <option value="Bachelor of Elementary Education" <?php echo ($_POST['course'] ?? '') === 'Bachelor of Elementary Education' ? 'selected' : ''; ?>>Bachelor of Elementary Education</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="year_level" class="form-label">Year Level</label>
                        <select class="form-select" id="year_level" name="year_level" required>
                            <option value="">Select Year Level</option>
                            <option value="1" <?php echo ($_POST['year_level'] ?? '') == '1' ? 'selected' : ''; ?>>1st Year</option>
                            <option value="2" <?php echo ($_POST['year_level'] ?? '') == '2' ? 'selected' : ''; ?>>2nd Year</option>
                            <option value="3" <?php echo ($_POST['year_level'] ?? '') == '3' ? 'selected' : ''; ?>>3rd Year</option>
                            <option value="4" <?php echo ($_POST['year_level'] ?? '') == '4' ? 'selected' : ''; ?>>4th Year</option>
                        </select>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-nddu btn-lg">
                            <i class="fas fa-save me-2"></i>Register Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
