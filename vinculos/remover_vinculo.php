<?php
require_once '../config/conexao.php';
header('Content-Type: application/json');

$p_id = $_POST['produto_id'] ?? '';
$f_id = $_POST['fornecedor_id'] ?? '';

if (!empty($p_id) && !empty($f_id)) {
    try {
        $stmt = $pdo->prepare("DELETE FROM produto_fornecedor WHERE produto_id = :p AND fornecedor_id = :f");
        $stmt->execute([':p' => $p_id, ':f' => $f_id]);
        echo json_encode(['sucesso' => true, 'mensagem' => 'Vínculo removido!']);
    } catch (PDOException $e) {
        echo json_encode(['sucesso' => false, 'mensagem' => $e->getMessage()]);
    }
}
