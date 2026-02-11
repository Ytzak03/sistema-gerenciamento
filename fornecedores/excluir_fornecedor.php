<?php
require_once '../config/conexao.php';

$id = $_POST['id'] ?? '';

if (!empty($id)) {
    $stmt = $pdo->prepare("DELETE FROM fornecedores WHERE id = :id");
    $stmt->execute([':id' => $id]);
    echo json_encode(['sucesso' => true, 'mensagem' => 'Removido com sucesso!']);
}
?>
