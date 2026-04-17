<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(E_ALL);

// 1. SESSION FIX (Must match login.php & admin.php)
$session_folder = __DIR__ . '/sessions';
if (!file_exists($session_folder)) { mkdir($session_folder, 0777, true); }
ini_set('session.save_path', $session_folder);
session_start();

include 'db.php';

// 2. SECURITY CHECK
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$message = "";
$username = $_SESSION['admin_name'];

// 3. PASSWORD UPDATE LOGIC
if (isset($_POST['update_pass'])) {
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    // Get current hash
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (password_verify($current_pass, $row['password'])) {
        if ($new_pass === $confirm_pass) {
            if (strlen($new_pass) < 6) {
                $message = "<div class='alert error'>Le mot de passe doit contenir au moins 6 caractères.</div>";
            } else {
                // Hash and Update
                $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                $update_stmt->bind_param("ss", $new_hash, $username);
                
                if ($update_stmt->execute()) {
                    $message = "<div class='alert success'>Mot de passe modifié avec succès !</div>";
                } else {
                    $message = "<div class='alert error'>Erreur base de données.</div>";
                }
            }
        } else {
            $message = "<div class='alert error'>Les nouveaux mots de passe ne correspondent pas.</div>";
        }
    } else {
        $message = "<div class='alert error'>Le mot de passe actuel est incorrect.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paramètres - Capram</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #F4F4F4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        
        .settings-card { 
            background: white; 
            width: 100%; 
            max-width: 450px; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 5px 20px rgba(0,0,0,0.05); 
        }

        h2 { margin-top: 0; color: #222; border-left: 5px solid #F7943D; padding-left: 15px; }
        p.subtitle { color: #777; font-size: 0.9rem; margin-bottom: 25px; }

        label { display: block; margin-bottom: 8px; font-weight: 600; color: #444; font-size: 14px; }
        
        .input-group { position: relative; margin-bottom: 20px; }
        .input-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #aaa; }
        
        input { 
            width: 100%; 
            padding: 12px 12px 12px 40px; 
            border: 1px solid #ddd; 
            border-radius: 6px; 
            box-sizing: border-box; 
            font-family: 'Poppins', sans-serif;
            transition: 0.3s;
        }
        input:focus { border-color: #F7943D; outline: none; }

        .btn { 
            width: 100%; 
            padding: 14px; 
            background: #222; 
            color: white; 
            border: none; 
            border-radius: 6px; 
            font-weight: bold; 
            cursor: pointer; 
            font-size: 16px;
            transition: 0.3s;
        }
        .btn:hover { background: #F7943D; transform: translateY(-2px); }

        .alert { padding: 12px; margin-bottom: 20px; border-radius: 4px; font-size: 14px; border-left: 4px solid; }
        .success { background: #d4edda; color: #155724; border-color: #28a745; }
        .error { background: #ffebee; color: #c62828; border-color: #d32f2f; }

        .back-link { 
            display: block; 
            text-align: center; 
            margin-top: 20px; 
            color: #777; 
            text-decoration: none; 
            font-size: 14px; 
        }
        .back-link:hover { color: #222; }
    </style>
</head>
<body>

    <div class="settings-card">
        <h2>Sécurité</h2>
        <p class="subtitle">Modifiez le mot de passe administrateur pour : <strong><?php echo htmlspecialchars($username); ?></strong></p>
        
        <?php echo $message; ?>

        <form method="POST">
            <label>Mot de passe actuel</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="current_pass" required>
            </div>
            
            <label>Nouveau mot de passe</label>
            <div class="input-group">
                <i class="fas fa-key"></i>
                <input type="password" name="new_pass" required>
            </div>
            
            <label>Confirmer le nouveau</label>
            <div class="input-group">
                <i class="fas fa-check-circle"></i>
                <input type="password" name="confirm_pass" required>
            </div>
            
            <button type="submit" name="update_pass" class="btn">Mettre à jour</button>
        </form>

        <a href="admin.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Retour au Dashboard
        </a>
    </div>

</body>
</html>