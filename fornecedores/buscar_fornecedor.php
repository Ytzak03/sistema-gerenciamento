<?php
require_once '../config/conexao.php';

$id = $_GET['id'] ?? '';

header('Content-Type: application/json');

if (!empty($id)) {
    $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fornecedor) {
        echo json_encode($fornecedor);
    } else {
        http_response_code(404);
        echo json_encode(['erro' => 'Fornecedor não encontrado']);
    }
}
