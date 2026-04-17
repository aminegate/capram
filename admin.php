<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Session Handling (Localhost fix)
$session_folder = __DIR__ . '/sessions';
if (!file_exists($session_folder)) { mkdir($session_folder, 0777, true); }
ini_set('session.save_path', $session_folder);
session_start();

// Security Check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

include 'db.php';

$edit_mode = false;
$id = "";
$title = "";
$author = "Admin";
$content = "";
$image_url = "";
$created_at = date('Y-m-d\TH:i');
$message = "";

// --- DELETE (SECURE) ---
if (isset($_GET['delete'])) {
    $id_del = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM blog_posts WHERE id = ?");
    $stmt->bind_param("i", $id_del);
    $stmt->execute();
    header("Location: admin.php?msg=deleted");
    exit();
}

// --- EDIT (SECURE) ---
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $id_edit = intval($_GET['edit']);
    $stmt = $conn->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->bind_param("i", $id_edit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($row = $result->fetch_assoc()){
        $id = $row['id'];
        $title = $row['title'];
        $author = $row['author'];
        $content = $row['content'];
        $image_url = $row['image_url'];
        $created_at = date('Y-m-d\TH:i', strtotime($row['created_at']));
    }
}

// --- SAVE POST (SECURE PREPARED STATEMENTS) ---
if (isset($_POST['save_post'])) {
    $title_in = $_POST['title'];
    $author_in = $_POST['author'];
    $content_in = $_POST['content']; 
    $date_in = $_POST['created_at'];
    
    // Image Upload
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
    $upload_ok = true;
    $db_image_path = $_POST['current_image'];

   if (!empty($_FILES["post_image"]["name"])) {
        $file_name = time() . "_" . basename($_FILES["post_image"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // 1. SECURITY CHECK: Block .php in filename (e.g. hack.php.jpg)
        if (strpos($file_name, '.php') !== false) {
             $message = '<div class="alert error">Fichier potentiellement dangereux rejeté.</div>';
             $upload_ok = false;
        }

        // 2. EXTENSION CHECK: Allow only images (Run only if step 1 passed)
        if($upload_ok && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
             $message = '<div class="alert error">Seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.</div>';
             $upload_ok = false;
        }

        // 3. UPLOAD ACTION: Only move file if $upload_ok is still TRUE
        if ($upload_ok) {
            if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
                $db_image_path = $target_file;
            } else {
                $message = '<div class="alert error">Erreur upload image.</div>';
                $upload_ok = false;
            }
        }
    }
    if ($upload_ok) {
        if ($_POST['post_id'] != "") {
            // UPDATE
            $id_up = intval($_POST['post_id']);
            $stmt = $conn->prepare("UPDATE blog_posts SET title=?, author=?, content=?, image_url=?, created_at=? WHERE id=?");
            $stmt->bind_param("sssssi", $title_in, $author_in, $content_in, $db_image_path, $date_in, $id_up);
            $stmt->execute();
            $message = '<div class="alert success">Article mis à jour !</div>';
        } else {
            // INSERT
            $cat = "General";
            $stmt = $conn->prepare("INSERT INTO blog_posts (title, category, author, content, image_url, created_at) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $title_in, $cat, $author_in, $content_in, $db_image_path, $date_in);
            $stmt->execute();
            $message = '<div class="alert success">Article publié !</div>';
            // Clear fields
            if(!$edit_mode) { $title = ""; $content = ""; $image_url = ""; }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; background: #F4F4F4; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .admin-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 40px; }
        h2 { border-left: 5px solid #F7943D; padding-left: 15px; color: #222; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }
        label { display: block; margin-bottom: 8px; font-weight: 600; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .btn { padding: 12px 25px; border: none; color: white; cursor: pointer; font-weight: bold; border-radius: 4px; }
        .btn-save { background: #222; width: 100%; }
        .btn-save:hover { background: #F7943D; }
        .btn-edit { background: #F7943D; padding: 5px 10px; text-decoration: none; font-size: 14px; margin-right:5px; border-radius: 3px; color: white; }
        .btn-delete { background: #ff4444; padding: 5px 10px; text-decoration: none; font-size: 14px; border-radius: 3px; color: white; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #222; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        img.preview { height: 40px; }
    </style>
</head>
<body>

<div class="container">
    <div class="admin-card">
        <h2><?php echo $edit_mode ? 'Modifier l\'article' : 'Ajouter un article'; ?></h2>
        <?php echo $message; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="post_id" value="<?php echo $id; ?>">
            <input type="hidden" name="current_image" value="<?php echo $image_url; ?>">

            <div class="form-grid">
                <div><label>Titre</label><input type="text" name="title" value="<?php echo $title; ?>" required></div>
                <div><label>Auteur</label><input type="text" name="author" value="<?php echo $author; ?>"></div>
                <div><label>Date</label><input type="datetime-local" name="created_at" value="<?php echo $created_at; ?>"></div>
                <div>
                    <label>Image</label>
                    <input type="file" name="post_image" accept="image/*">
                    <?php if($edit_mode && $image_url): ?><img src="<?php echo $image_url; ?>" class="preview"><?php endif; ?>
                </div>
                <div class="full-width">
                    <label>Contenu</label>
                    <textarea name="content" id="summernote" required><?php echo $content; ?></textarea>
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <button type="submit" name="save_post" class="btn btn-save"><?php echo $edit_mode ? 'Mettre à jour' : 'Publier'; ?></button>
                <?php if($edit_mode): ?>
                    <div style="text-align:center; margin-top:10px;"><a href="admin.php" style="color:#666; text-decoration:none;">Annuler</a></div>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="admin-card">
        <h2>Vos Articles</h2>
        <table>
            <thead><tr><th>Img</th><th>Titre</th><th>Actions</th></tr></thead>
            <tbody>
                <?php
                // Standard query is fine for listing, no inputs here
                $res = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
               while($row = $res->fetch_assoc()) {
                    $img = $row['image_url'] ? $row['image_url'] : 'https://via.placeholder.com/50';
                    // SECURITY FIX: Clean the title before showing it
                    $safe_title = htmlspecialchars($row['title']); 
                    
                    echo "<tr>
                        <td><img src='{$img}' class='preview'></td>
                        <td><strong>{$safe_title}</strong></td>
                        <td>
                            <a href='admin.php?edit={$row['id']}' class='btn-edit'><i class='fas fa-edit'></i></a>
                            <a href='admin.php?delete={$row['id']}' class='btn-delete' onclick=\"return confirm('Supprimer ?');\"><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div style="text-align: right; margin-bottom: 20px;">
    <a href="settings.php" style="background: #222; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; margin-right: 10px;">
        <i class="fas fa-cog"></i> Paramètres
    </a>
    <a href="admin.php?logout=true" style="background: #ff4444; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
        <i class="fas fa-sign-out-alt"></i> Se déconnecter
    </a>
</div>

<script>
    $('#summernote').summernote({ placeholder: 'Contenu...', tabsize: 2, height: 200 });
</script>

</body>
</html>