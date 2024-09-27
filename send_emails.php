<?php
// send_emails.php
require 'vendor/autoload.php'; // Carregar o autoloader do Composer
include('db.php');
include('email_template.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Carregar o .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configurações do SMTP
$smtp_host = $_ENV['SMTP_HOST'];
$smtp_port = $_ENV['SMTP_PORT'];
$smtp_user = $_ENV['SMTP_USER'];
$smtp_pass = $_ENV['SMTP_PASS'];
$from_email = $_ENV['FROM_EMAIL'];
$from_name = $_ENV['FROM_NAME'];

// Criação do PHPMailer
$mail = new PHPMailer(true);

// Desabilitar cache de saída para envio contínuo
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache');
header('X-Accel-Buffering: no'); // Para Nginx

ob_implicit_flush(true);
ob_end_flush();

try {
    // Configurações do servidor
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_user;
    $mail->Password = $smtp_pass;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = $smtp_port;
    $mail->CharSet = 'UTF-8';

    // Query para obter as empresas
    $sql = "
        SELECT id, nome, email, data_envio
        FROM empresas
        WHERE data_envio IS NULL 
        OR TIMESTAMPDIFF(HOUR, data_envio, NOW()) > 72
        AND data_delecao IS NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empresa_id = $row['id'];
            $nome_empresa = $row['nome'];
            $email_empresa = $row['email'];

            // Obter o template de e-mail
            $message = getEmailTemplate($nome_empresa, $email_empresa);

            // Configurar o remetente e destinatário
            $mail->setFrom($from_email, $from_name);
            $mail->addAddress($email_empresa, $nome_empresa);

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Aumente a eficiência do seu delivery com o JáVai!';
            $mail->Body = $message;

            // Enviar o e-mail
            if ($mail->send()) {
                echo "E-mail enviado para: " . $email_empresa . "<br>";
            } else {
                echo "Erro ao enviar e-mail para: " . $email_empresa . "<br>";
            }

            // Atualizar a data de envio
            $update_sql = "UPDATE empresas SET data_envio = NOW() WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("i", $empresa_id);
            $stmt->execute();

            // Enviar saída imediatamente
            flush();
        }
    } else {
        echo "Nenhuma empresa encontrada para enviar e-mails.<br>";
    }
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
}

$conn->close();
