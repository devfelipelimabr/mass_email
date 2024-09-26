<?php
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

try {
    // Configurações do servidor
    $mail->isSMTP();
    $mail->Host = $smtp_host;  // Servidor SMTP
    $mail->SMTPAuth = true;    // Ativar autenticação SMTP
    $mail->Username = $smtp_user;  // Usuário SMTP
    $mail->Password = $smtp_pass;  // Senha SMTP
    $mail->SMTPSecure = 'ssl';     // Segurança
    $mail->Port = $smtp_port;      // Porta SMTP

    // Query para obter as empresas
    $sql = "SELECT nome, email FROM empresas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nome_empresa = $row['nome'];
            $email_empresa = $row['email'];

            // Obter o template de e-mail
            $message = getEmailTemplate($nome_empresa);

            // Configurar o remetente e destinatário
            $mail->setFrom($from_email, $from_name);
            $mail->addAddress($email_empresa, $nome_empresa);

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Aumente a eficiência do seu delivery com o JáVai!';
            $mail->Body    = $message;

            // Enviar o e-mail
            $mail->send();
            echo "E-mail enviado para: " . $email_empresa . "<br>";
        }
    } else {
        echo "Nenhuma empresa encontrada.";
    }
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
}

$conn->close();
