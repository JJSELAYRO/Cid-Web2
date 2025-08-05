<?php
require_once 'StudentManager.php';

$studentManager = new StudentManager();
$students = [];
$searchResults = [];
$searchMessage = '';
$searchTerm = '';

if (isset($_GET['search'])) {
    $searchTerm = trim($_GET['search']);
    if (!empty($searchTerm)) {
        $foundStudent = $studentManager->findStudentByID($searchTerm);
        if ($foundStudent) {
            $searchResults = [$foundStudent];
            $searchMessage = "Found 1 student record with ID: $searchTerm";
        } else {
            $searchMessage = "No student found with ID: $searchTerm";
        }
    }
}

// Only fetch all students if not searching or search is empty
if (empty($searchTerm)) {
    $students = $studentManager->listStudents();
}
// Set page title
$pageTitle = "Student Records - NDDU SIS";
require_once 'header.php';
?>
<link rel="stylesheet" href="style.css">
<div class="container main-content">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4"><i class="fas fa-users me-2"></i>Student Records</h2>
            
            <!-- Search Form -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form method="GET" action="" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" name="search" 
                                       placeholder="Search by Student ID (e.g., 2023-1234)" 
                                       value="<?php echo htmlspecialchars($searchTerm); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-nddu me-2">
                                <i class="fas fa-search me-1"></i>Search
                            </button>
                            <?php if (!empty($searchTerm)): ?>
                                <a href="list_students.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Clear
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php if ($searchMessage): ?>
                <div class="alert alert-<?php echo empty($searchResults) ? 'danger' : 'success'; ?> nddu-alert">
                    <i class="fas <?php echo empty($searchResults) ? 'fa-exclamation-triangle' : 'fa-check-circle'; ?> me-2"></i>
                    <?php echo $searchMessage; ?>
                </div>
            <?php endif; ?>
            
            <div class="card shadow-sm">
                <div class="card-body">
                    <?php 
                    $displayStudents = !empty($searchTerm) ? $searchResults : $students;
                    
                    if (empty($displayStudents)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-user-graduate fa-4x text-muted mb-4"></i>
                            <h4>No Student Records Found</h4>
                            <p class="text-muted">
                                <?php echo !empty($searchTerm) ? 'Try a different search term or' : ''; ?>
                                <a href="add_student.php" class="text-decoration-none">
                                    register the first student
                                </a> to begin.
                            </p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table nddu-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Full Name</th>
                                        <th>Program</th>
                                        <th>Year</th>
                                        <th>Date Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($displayStudents as $student): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                            <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                            <td><?php echo htmlspecialchars($student['course']); ?></td>
                                            <td><?php echo htmlspecialchars($student['year_level']); ?></td>
                                            <td><?php echo date('M j, Y', strtotime($student['created_at'])); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3 text-end">
                            <p class="text-muted">
                                <strong>Total Records: <?php echo count($displayStudents); ?></strong>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
