<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding-top: 20px;
        }
        .navbar {
            background-color: rgba(0, 0, 0, 0.1) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .container-main {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.18);
            margin-bottom: 30px;
        }
        .page-intro {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 1rem;
            align-items: center;
            margin-bottom: 25px;
        }
        .page-intro h1 {
            color: #333;
            font-weight: 800;
            margin: 0;
        }
        .summary-card {
            background: #f8f9ff;
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .summary-card strong {
            font-size: 1rem;
            color: #5e5ce6;
        }
        .table {
            border-radius: 12px;
            overflow: hidden;
        }
        .table thead {
            background-color: #667eea;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-sm {
            margin: 0 3px 4px 0;
        }
        .footer-note {
            text-align: center;
            color: #6c757d;
            margin-top: 20px;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">📚 Student Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">All Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Add Student</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="container-main">
            <div class="page-intro">
                <div>
                    <h1>📖 Student Records</h1>
                    <p class="text-muted mb-0">Manage your student list with fast editing, deletion, and add actions.</p>
                </div>
                <a href="create.php" class="btn btn-primary btn-lg">+ Add New Student</a>
            </div>

            <div class="summary-card">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div>
                        <strong>Total students:</strong>
                        <span class="badge bg-primary"><?= count($students) ?></span>
                    </div>
                    <div class="text-muted">
                        Updated live from the database. Use action buttons to edit or remove records.
                    </div>
                </div>
            </div>

            <?php if (count($students) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $s): ?>
                        <tr>
                            <td><?= $s['id'] ?></td>
                            <td><?= htmlspecialchars($s['name']) ?></td>
                            <td><?= htmlspecialchars($s['email']) ?></td>
                            <td><?= htmlspecialchars($s['course']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                                <a href="delete.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="alert alert-info">
                <h5>No students found.</h5>
                <a href="create.php" class="btn btn-primary">Add the first student</a>
            </div>
            <?php endif; ?>
        </div>
        <div class="footer-note">Built for streamlined student record management.</div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>