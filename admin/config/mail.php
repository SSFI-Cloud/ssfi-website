<?php
/**
 * SSFI Email Configuration
 * Uses Gmail SMTP with App Password
 */

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'ssfiwebdev@gmail.com');
define('MAIL_PASSWORD', 'imnu dsni lujt kmwl');  // Gmail App Password
define('MAIL_FROM_EMAIL', 'ssfiwebdev@gmail.com');
define('MAIL_FROM_NAME', 'SSFI Bharat Skate');
define('MAIL_ENCRYPTION', 'tls');

/**
 * Send email using PHPMailer
 * @param string $to Recipient email
 * @param string $subject Email subject
 * @param string $body HTML body
 * @param string $altBody Plain text alternative
 * @return array ['success' => bool, 'message' => string]
 */
function sendEmail($to, $subject, $body, $altBody = '') {
    require_once __DIR__ . '/../public/registers/api/vendor/autoload.php';
    
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = MAIL_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_USERNAME;
        $mail->Password   = MAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = MAIL_PORT;
        
        // Recipients
        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        $mail->addAddress($to);
        $mail->addReplyTo(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody ?: strip_tags($body);
        
        $mail->send();
        return ['success' => true, 'message' => 'Email sent successfully'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => "Email failed: {$mail->ErrorInfo}"];
    }
}
?>
