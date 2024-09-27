<?php
// unsubscribe.php
require 'db.php'; // Conexão com o banco de dados

// Verifica se o 'id' foi passado na URL
if (isset($_GET['id'])) {
    $empresa_id = intval($_GET['id']);

    // Realiza o soft delete, marcando o usuário como desativado
    $sql = "UPDATE empresas SET data_delecao = NOW() WHERE id = ? AND data_delecao IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $empresa_id);

    if ($stmt->execute()) {
        echo "Você foi desinscrito com sucesso. Você não receberá mais e-mails.";
    } else {
        echo "Houve um erro ao processar sua desinscrição. Por favor, tente novamente.";
    }

    $stmt->close();
} else {
    echo "ID de empresa inválido.";
}

$conn->close();