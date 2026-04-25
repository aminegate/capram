<?php
// 1. SETTINGS
$recipient_email = "contact@capram.ma"; 
$website_name = "Capram";

// 2. CHECK REQUEST METHOD
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(403);
    echo "Direct access not allowed.";
    exit;
}

// 3. CAPTURE & CLEAN DATA (OWASP A03:2021)
$name     = htmlspecialchars(strip_tags(trim($_POST["name"])));
$email    = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$number   = htmlspecialchars(strip_tags(trim($_POST["number"])));
$objet    = htmlspecialchars(strip_tags(trim($_POST["objet"])));
$message  = htmlspecialchars(strip_tags(trim($_POST["message"])));
$honeypot = $_POST["b_phone"] ?? ''; // Captured from the hidden field

// 4. VALIDATION
// A. Honeypot check (Instantly stop bots)
if (!empty($honeypot)) {
    http_response_code(400);
    echo "Spam detected.";
    exit;
}

// B. Check for empty required fields
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo "Please fill in all required fields.";
    exit;
}

// C. Validate Email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Invalid email address.";
    exit;
}

// D. Length limits (Prevent Denial of Service via massive text)
if (strlen($name) > 100 || strlen($message) > 5000) {
    http_response_code(400);
    echo "Message or Name is too long.";
    exit;
}

// 5. PREVENT EMAIL HEADER INJECTION
$name = str_replace(array("\r", "\n"), '', $name);
$email = str_replace(array("\r", "\n"), '', $email);
$objet = str_replace(array("\r", "\n"), '', $objet);

// 6. CONSTRUCT EMAIL CONTENT (English)
$email_subject = "New Inquiry from $website_name: $objet";
$email_content = "You have received a new message from your website contact form.\n\n";
$email_content .= "Name: $name\n";
$email_content .= "Email: $email\n";
$email_content .= "Phone: $number\n";
$email_content .= "Subject: $objet\n\n";
$email_content .= "Message:\n$message\n";

// 7. CONSTRUCT HEADERS
$headers = "From: Website Contact <no-reply@capram.ma>\r\n";
$headers .= "Reply-To: $name <$email>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// 8. SEND EMAIL
if (mail($recipient_email, $email_subject, $email_content, $headers)) {
    http_response_code(200);
    echo "Thank you! Your message has been sent.";
} else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
}
?>