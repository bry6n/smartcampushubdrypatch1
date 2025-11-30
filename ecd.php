<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Get numeric user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = (int)$user['id'];

// Fetch distinct professors from enrolled subjects
$prof_stmt = $conn->prepare("
    SELECT DISTINCT c.facilitator_name AS name
    FROM enrollments e
    JOIN courses c ON e.subject_id = c.id
    WHERE e.user_id = :uid
      AND c.facilitator_name IS NOT NULL
      AND c.facilitator_name != ''
    ORDER BY c.facilitator_name ASC
");
$prof_stmt->execute(['uid' => $user_id]);
$profs = $prof_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch existing ratings for this user
$rating_stmt = $conn->prepare("SELECT professor_name, rating FROM ratings WHERE user_id = :uid");
$rating_stmt->execute(['uid' => $user_id]);
$user_ratings = [];
while ($r = $rating_stmt->fetch(PDO::FETCH_ASSOC)) {
    $user_ratings[$r['professor_name']] = (int)$r['rating'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ECD - Smart Campus Hub</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
@font-face {
    font-family: 'CustomFont';
    src: url('pixelated.ttf') format('truetype');
}

body {
    font-family: 'CustomFont', Arial, sans-serif;
    background: #f1f1f1;
    margin: 0;
}

/* Navbar */
.navbar {
    background: rgba(198, 148, 31, 0.9) !important;
    font-family: 'CustomFont', Arial, sans-serif;
    height: 70px;
}
.navbar-brand {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 1.5rem;
}
.navbar-brand img {
    height: 50px;
}

/* Sidebar */
.sidebar {
    width: 220px;
    background: rgba(235, 176, 41, 0.9);
    display: flex;
    flex-direction: column;
    padding: 20px;
    min-height: 100vh;
    overflow-y: auto;
}
.sidebar a {
    color: white;
    margin-bottom: 10px;
    text-decoration: none;
    padding: 8px 10px;
    border-radius: 6px;
}
.sidebar a.text-warning { 
    background: rgba(255, 255, 255, 0.8); 
    font-weight: bold; 
}
.sidebar a:hover { 
    background: rgba(255,165,0,0.9); 
    color: white; 
}
.sidebar .btn-danger { 
    margin-top: auto; 
    width: 100%; 
}

/* Content */
.main-container { display: flex; }
.flex-grow-1 { flex-grow: 1; padding: 20px; }

h3 { text-align: center; margin-bottom: 20px; }

.prof-card {
    background-color: #fff;
    color: #000;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.star { font-size: 1.5rem; cursor: pointer; margin-right: 6px; color: #ccc; }
.star.rated { color: gold !important; }
.rating-display { font-weight: bold; margin-left: 10px; }
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
        <a href="profile.php" class="d-block mb-3">Profile</a>
        <a href="subjects.php" class="d-block mb-3">Subjects</a>
        <a href="records.php" class="d-block mb-3">Records</a>
        <a href="ecd.php" class="text-warning fw-bold d-block mb-3">ECD</a>
        <a href="about.php" class="d-block mb-3">About</a>
        <a href="index.php" class="btn btn-danger mt-5">Sign Out</a>
    </div>

    <div class="flex-grow-1 p-4">
        <h3>Educators Conduct Data</h3>
        <p class="text-center">Click a star to rate the professor (1–5).</p>

        <?php if(empty($profs)): ?>
            <div class="alert alert-info text-center">No professors found for your enrolled subjects.</div>
        <?php else: ?>
            <?php foreach($profs as $p):
                $prof = $p['name'];
                $current = $user_ratings[$prof] ?? 0;
            ?>
                <div class="prof-card">
                    <div><strong><?= htmlspecialchars($prof) ?></strong></div>
                    <div class="rating" data-prof="<?= htmlspecialchars($prof, ENT_QUOTES) ?>">
                        <?php for($i=1;$i<=5;$i++): ?>
                            <span class="star <?= $i <= $current ? 'rated' : '' ?>" data-value="<?= $i ?>">&#9733;</span>
                        <?php endfor; ?>
                        <span class="rating-display"><?= $current>0 ? $current.'/5' : 'Not Rated' ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    $('.star').on('mouseenter', function(){
        const $stars = $(this).closest('.rating').find('.star');
        const val = $(this).data('value');
        $stars.each(function(){ $(this).toggleClass('rated', $(this).data('value') <= val ); });
    }).on('mouseleave', function(){
        const $rating = $(this).closest('.rating');
        const saved = parseInt($rating.find('.rating-display').text()) || 0;
        $rating.find('.star').each(function(){ $(this).toggleClass('rated', $(this).data('value') <= saved ); });
    });

    $('.star').on('click', function(){
        const $rating = $(this).closest('.rating');
        const prof = $rating.data('prof');
        const val = $(this).data('value');

        $.post('save_rating.php', { professor_name: prof, rating: val }, function(resp){
            if(resp.success){
                $rating.find('.rating-display').text(val+'/5');
                $rating.find('.star').each(function(){ $(this).toggleClass('rated', $(this).data('value') <= val ); });
            } else {
                alert(resp.message || 'Failed to save rating');
            }
        }, 'json').fail(function(){ alert('Could not contact server'); });
    });
});
</script>
</body>
</html>
