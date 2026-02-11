<?php
require_once '../config/conexao.php';

$id = $_GET['id'] ?? '';

header('Content-Type: application/json');

if (!empty($id)) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        echo json_encode($produto);
    } else {
        http_response_code(404);
        echo json_encode(['erro' => 'Produto não encontrado']);
    }
}
