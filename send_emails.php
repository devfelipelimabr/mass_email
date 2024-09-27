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

try {
    // Configurações do servidor
    $mail->isSMTP();
    $mail->Host = $smtp_host;  // Servidor SMTP
    $mail->SMTPAuth = true;    // Ativar autenticação SMTP
    $mail->Username = $smtp_user;  // Usuário SMTP
    $mail->Password = $smtp_pass;  // Senha SMTP
    $mail->SMTPSecure = 'ssl';     // Segurança
    $mail->Port = $smtp_port;      // Porta SMTP
    $mail->CharSet = 'UTF-8';

    // Query para obter as empresas que cumprem a condição
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
            $message = getEmailTemplate($nome_empresa, $empresa_id);

            // Configurar o remetente e destinatário
            $mail->setFrom($from_email, $from_name);
            $mail->addAddress($email_empresa, $nome_empresa);

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Aumente a eficiência do seu delivery com o JáVai!';
            $mail->Body    = $message;

            // Enviar o e-mail
            if ($mail->send()) {
                echo "E-mail enviado para: " . $email_empresa . "<br>";

                // Atualizar a data de envio
                $update_sql = "UPDATE empresas SET data_envio = NOW() WHERE id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("i", $empresa_id);
                $stmt->execute();
            } else {
                echo "Erro ao enviar e-mail para: " . $email_empresa . "<br>";
            }
        }
    } else {
        echo "Nenhuma empresa encontrada para enviar e-mails.";
    }
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
}

$conn->close();
