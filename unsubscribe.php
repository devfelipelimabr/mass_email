<?php
// unsubscribe.php
require 'db.php'; // Conexão com o banco de dados

// Verifica se o 'email' foi passado na URL
if (isset($_GET['email'])) {
    $empresa_email = $_GET['email']; // Captura o e-mail como string

    // Realiza o soft delete, marcando o usuário como desativado
    $sql = "UPDATE empresas SET data_delecao = NOW() WHERE email = ? AND data_delecao IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $empresa_email); // 's' para string

    if ($stmt->execute()) {
        echo "Você foi desinscrito com sucesso. Você não receberá mais e-mails.";
    } else {
        echo "Houve um erro ao processar sua desinscrição. Por favor, tente novamente.";
    }

    $stmt->close();
} else {
    echo "EMAIL de empresa inválido.";
}

$conn->close();
