<?php
require_once '../config/conexao.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM fornecedores ORDER BY nome ASC");
    $stmt->execute();
    $fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($fornecedores);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => $e->getMessage()]);
}
?>
