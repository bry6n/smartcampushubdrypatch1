<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// Get numeric user ID and current program
$stmt = $conn->prepare("SELECT id, program_id FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $user['id'];
$current_program_id = $user['program_id'] ?? null;

// Fetch record types
$types_stmt = $conn->prepare("SELECT * FROM record_types");
$types_stmt->execute();
$types = $types_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch current program name (if enrolled)
$currentProgram = ['program_name' => 'Not Enrolled'];
if ($current_program_id) {
    $currentProgramStmt = $conn->prepare("SELECT program_name FROM programs WHERE id = ?");
    $currentProgramStmt->execute([$current_program_id]);
    $tmp = $currentProgramStmt->fetch(PDO::FETCH_ASSOC);
    if ($tmp) $currentProgram = $tmp;
}

// Fetch other programs for shifting
$otherProgramsStmt = $conn->prepare("
    SELECT id, program_name 
    FROM programs 
    WHERE id IS NOT NULL AND (id != ? OR ? IS NULL)
    ORDER BY program_name ASC
");
$otherProgramsStmt->execute([$current_program_id, $current_program_id]);
$otherPrograms = $otherProgramsStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Records - Smart Campus Hub</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
@font-face {
    font-family: 'CustomFont';
    src: url('pixelated.ttf') format('truetype');
}
body { font-family: 'CustomFont', Arial, sans-serif; background: #f1f1f1; margin:0; }

/* Navbar */
.navbar { background: rgba(198, 148, 31, 0.9) !important; height:70px; }
.navbar-brand { display:flex; align-items:center; gap:15px; font-size:1.5rem; }
.navbar-brand img { height:50px; }

/* Sidebar */
.sidebar { width:220px; background: rgba(235, 176, 41, 0.9); display:flex; flex-direction:column; padding:20px; min-height:100vh; }
.sidebar a { color:white; margin-bottom:10px; text-decoration:none; padding:8px 10px; border-radius:6px; }
.sidebar a.text-warning { background: rgba(255, 255, 255, 0.8); font-weight:bold; color:black; }
.sidebar a:hover { background: rgba(255,165,0,0.9); color:white; }
.sidebar .btn-danger { margin-top:auto; width:100%; }

/* Content */
.main-container { display:flex; }
.flex-grow-1 { flex-grow:1; padding:20px; }

.card { max-width:800px; margin:20px auto; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); background:#fff; }

table { width:100%; border-collapse:collapse; font-family: 'CustomFont', Arial, sans-serif; }
table th, table td { padding:10px; border:1px solid #ccc; text-align:left; }
table th { background: rgba(198,148,31,0.9); color:white; }

#shiftingForm { background:#fff; border-radius:10px; padding:15px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
</style>
</head>
<body>

<nav class="navbar sticky-top navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="cake.png" alt="Logo">
      <u>Smart Campus Hub</u>
    </a>
  </div>
</nav>

<div class="main-container">
    <div class="sidebar text-white">
        <a href="profile.php" class="text-white d-block mb-3">Profile</a>
        <a href="subjects.php" class="text-white d-block mb-3">Subjects</a>
        <a href="records.php" class="text-warning fw-bold d-block mb-3">Records</a>
        <a href="ecd.php" class="text-white d-block mb-3">ECD</a>
        <a href="about.php" class="text-white d-block mb-3">About</a>
        <a href="index.php" class="btn btn-danger mt-5">Sign Out</a>
    </div>

    <div class="flex-grow-1 p-4">
        <h3 class="mb-4 text-center">Records</h3>

        <?php if(isset($_GET['pending'])): ?>
            <div class="alert alert-warning">You already have a pending request for this record.</div>
        <?php endif; ?>

        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">Your request has been submitted successfully.</div>
        <?php endif; ?>

        <ul class="nav nav-tabs" id="recordTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="request-tab" data-bs-toggle="tab" 
                        data-bs-target="#request" type="button" role="tab">Submit Request</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="history-tab" data-bs-toggle="tab" 
                        data-bs-target="#history" type="button" role="tab">Request History</button>
            </li>
        </ul>

        <div class="tab-content mt-4">

            <!-- Submit Request Tab -->
            <div class="tab-pane fade show active" id="request" role="tabpanel">
                <div class="card">
                    <form action="save_record.php" method="POST">
                        <label class="form-label fw-bold">Select Request Type</label>
                        <select class="form-select mb-3" name="record_type_id" required>
                            <option value="">-- Choose --</option>
                            <?php foreach($types as $row): ?>
                                <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['record_name']); ?></option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Shifting Program Form -->
                        <div id="shiftingForm" style="display:none;">
                            <h5 class="mb-3">Shifting Program Form</h5>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Current Program</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($currentProgram['program_name']); ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Choose New Program</label>
                                <select class="form-select" name="new_program_id">
                                    <option value="">-- Select Program --</option>
                                    <?php foreach($otherPrograms as $program): ?>
                                        <option value="<?= $program['id']; ?>"><?= htmlspecialchars($program['program_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
                    </form>
                </div>
            </div>

            <!-- Request History Tab -->
            <div class="tab-pane fade" id="history" role="tabpanel">
                <div class="card">
                    <h5 class="mb-3">Your Request History</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Reference ID</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Current Program</th>
                                <th>Desired Program</th>
                                <th>Date Requested</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "
                                SELECT rr.*, rt.record_name,
                                       cp.program_name AS current_program,
                                       np.program_name AS desired_program
                                FROM record_requests rr
                                JOIN record_types rt ON rr.record_type_id = rt.id
                                LEFT JOIN programs cp ON rr.current_program_id = cp.id
                                LEFT JOIN programs np ON rr.new_program_id = np.id
                                WHERE rr.user_id = ?
                                ORDER BY rr.date_requested DESC
                            ";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([$user_id]);
                            $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if(empty($requests)):
                            ?>
                                <tr><td colspan="6" class="text-center">No requests yet.</td></tr>
                            <?php else: 
                                foreach($requests as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['request_id']); ?></td>
                                    <td><?= htmlspecialchars($row['record_name']); ?></td>
                                    <td><?= htmlspecialchars($row['status']); ?></td>
                                    <td><?= htmlspecialchars($row['current_program'] ?? '-'); ?></td>
                                    <td><?= htmlspecialchars($row['desired_program'] ?? '-'); ?></td>
                                    <td><?= htmlspecialchars($row['date_requested']); ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const dropdown = document.querySelector("select[name='record_type_id']");
    const shiftingForm = document.getElementById("shiftingForm");

    dropdown.addEventListener("change", function() {
        if(this.value == "1") { 
            shiftingForm.style.display = "block";
        } else {
            shiftingForm.style.display = "none";
            shiftingForm.querySelector("select[name='new_program_id']").value = "";
        }
    });
});
</script>
</body>
</html>
