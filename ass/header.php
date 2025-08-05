
<?php
/**
 * Common header for all pages
 * Includes NDDU branding, navigation, and Bootstrap CSS
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'NDDU Student Information System'; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- NDDU Custom CSS -->
     <link rel="stylesheet" href="style.css">
    <!-- Favicon -->
    <link rel="icon" href="logo.png" type="image/png">
</head>
<body>
    <!-- NDDU Header with School Seal -->
    <header class="nddu-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="logo.png" alt="NDDU Seal" class="nddu-seal img-fluid">
                </div>
                <div class="col-md-8 text-center">
                    <h1 class="nddu-title">Notre Dame of Dadiangas University</h1>
                    <h2 class="nddu-subtitle">Office of the University Registrar</h2>
                    <p class="nddu-system-name">Student Information Management System</p>
                </div>
                <div class="col-md-2 text-center">
    <div class="nddu-date-box text-white p-2 rounded" id="liveDate">
    <i class="fas fa-calendar-alt me-2"></i>
        <?php echo date('F j, Y'); ?>
    </div>
</div>

    </header>

    <!-- Navigation -->
<nav class="navbar navbar-expand-lg nddu-navbar">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add_student.php' ? 'active' : ''; ?>" href="add_student.php">
                        <i class="fas fa-user-plus me-2"></i>Add Student
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'list_students.php' ? 'active' : ''; ?>" href="list_students.php">
                        <i class="fas fa-users me-2"></i>Student Records
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function updateDate() {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const now = new Date();
        document.getElementById('liveDate').innerHTML = `
            <i class="fas fa-calendar-alt"></i>
            ${now.toLocaleDateString('en-US', options)}
        `;
    }

    updateDate();
    setInterval(updateDate, 60000); // Optional refresh every 60s
</script>



