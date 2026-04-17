<?php
// --- SECURITY & CONFIG ---
ob_start();
ini_set('display_errors', 0); // Hide errors from hackers
error_reporting(E_ALL);

// Session Handling
$session_folder = __DIR__ . '/sessions';
if (!file_exists($session_folder)) { mkdir($session_folder, 0777, true); }
ini_set('session.save_path', $session_folder);
session_start();

include 'db.php';

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit();
}

$error = "";

if (isset($_POST['login_btn'])) {
    $username = $_POST['username']; // No need to escape, we use bind_param below
    $password = $_POST['password'];

    // --- SECURE SQL (PREPARED STATEMENT) ---
    // 1. Prepare the template
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    
    // 2. Bind the data (s = string)
    $stmt->bind_param("s", $username);
    
    // 3. Execute
    $stmt->execute();
    
    // 4. Get Result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify Password
        if (password_verify($password, $row['password'])) {
            // Prevent Session Fixation Attacks
            session_regenerate_id(true);
            
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $row['username'];
            $_SESSION['admin_id'] = $row['id'];
            
            header("Location: admin.php");
            exit();
        } else {
            $error = "Identifiants incorrects."; // Don't say "Wrong Password" (it hints the user exists)
        }
    } else {
        $error = "Identifiants incorrects.";
    }
    $stmt->close();
}
?>

<!-- ... (Keep your beautiful HTML design below here) ... -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capram - Login</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; height: 100vh; overflow: hidden; }

        /* SPLIT SCREEN LAYOUT */
        .container { display: flex; height: 100%; width: 100%; }

        /* LEFT SIDE - IMAGE */
        .left-side {
            flex: 1.2;
            background: url('https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2564&auto=format&fit=crop') no-repeat center center/cover;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 60px;
            color: white;
        }
        /* Dark overlay so text pops */
        .left-side::before {
            content: ''; position: absolute; top:0; left:0; width:100%; height:100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.8));
        }
        .brand-text { position: relative; z-index: 2; animation: fadeUp 1s ease-out; }
        .brand-text h1 { font-size: 3rem; font-weight: 700; margin-bottom: 10px; }
        .brand-text p { font-size: 1.1rem; opacity: 0.8; max-width: 400px; }

        /* RIGHT SIDE - FORM */
        .right-side {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1.2s ease-out;
        }

        .header-title { margin-bottom: 40px; }
        .header-title h2 { font-size: 2rem; color: #222; font-weight: 700; }
        .header-title span { color: #F7943D; } /* Your Brand Color */
        .subtitle { color: #888; font-size: 0.9rem; margin-top: 5px; }

        /* INPUT FIELDS */
        .input-group { position: relative; margin-bottom: 25px; }
        .input-group i {
            position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            color: #aaa; transition: 0.3s;
        }
        .input-field {
            width: 100%;
            padding: 15px 15px 15px 45px; /* Space for icon */
            border: 2px solid #eee;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
            background: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }
        
        /* Focus Effects */
        .input-field:focus { border-color: #F7943D; background: #fff; box-shadow: 0 4px 15px rgba(247, 148, 61, 0.15); }
        .input-field:focus + i { color: #F7943D; }

        /* BUTTON */
        .login-btn {
            width: 100%;
            padding: 15px;
            background: #222;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .login-btn:hover {
            background: #F7943D;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(247, 148, 61, 0.3);
        }

        /* ERROR MESSAGE */
        .error-msg {
            background: #ffebee; color: #c62828; padding: 12px;
            border-radius: 8px; font-size: 0.9rem; margin-bottom: 20px;
            border-left: 4px solid #c62828; display: flex; align-items: center; gap: 10px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .left-side { display: none; } /* Hide image on mobile */
            .right-side { flex: 1; }
        }

        /* ANIMATIONS */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- LEFT SIDE: Image & Branding -->
    <div class="left-side">
        <div class="brand-text">
            <h1>Bienvenue.</h1>
            <p>Gérez votre contenu avec élégance et simplicité. Connectez-vous pour accéder au dashboard Capram.</p>
        </div>
    </div>

    <!-- RIGHT SIDE: Form -->
    <div class="right-side">
        <div class="login-wrapper">
            
            <div class="header-title">
                <h2>Capram<span>.</span></h2>
                <p class="subtitle">Veuillez entrer vos identifiants</p>
            </div>

            <?php if($error): ?>
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="input-group">
                    <input type="text" name="username" class="input-field" placeholder="Nom d'utilisateur" required autocomplete="off">
                    <i class="fas fa-user"></i>
                </div>

                <div class="input-group">
                    <input type="password" name="password" class="input-field" placeholder="Mot de passe" required>
                    <i class="fas fa-lock"></i>
                </div>

                <button type="submit" name="login_btn" class="login-btn">
                    Se connecter <i class="fas fa-arrow-right" style="margin-left:8px;"></i>
                </button>
            </form>

            <div style="margin-top: 30px; text-align: center; color: #aaa; font-size: 0.8rem;">
                &copy; <?php echo date('Y'); ?> Capram Dashboard
            </div>
        </div>
    </div>
</div>

</body>
</html>