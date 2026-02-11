<?php
require_once '../config/conexao.php';
header('Content-Type: application/json');

$p_id = $_POST['produto_id'] ?? '';
$f_id = $_POST['fornecedor_id'] ?? '';

if (empty($p_id) || empty($f_id)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Selecione o produto e o fornecedor!']);
    exit;
}

try {
    // Verifica se o vínculo já existe
    $check = $pdo->prepare("SELECT * FROM produto_fornecedor WHERE produto_id = :p AND fornecedor_id = :f");
    $check->execute([':p' => $p_id, ':f' => $f_id]);
    
    if ($check->rowCount() > 0) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Este vínculo já existe!']);
    } else {
        $stmt = $pdo->prepare("INSERT INTO produto_fornecedor (produto_id, fornecedor_id) VALUES (:p, :f)");
        $stmt->execute([':p' => $p_id, ':f' => $f_id]);
        echo json_encode(['sucesso' => true, 'mensagem' => 'Vínculo criado com sucesso!']);
    }
} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'mensagem' => $e->getMessage()]);
}
