<?php
require_once '../config/conexao.php';
header('Content-Type: application/json');

$vinculos = $_POST['vinculos'] ?? [];

if (!empty($vinculos)) {
    try {
        $stmt = $pdo->prepare("DELETE FROM produto_fornecedor WHERE produto_id = :p AND fornecedor_id = :f");
        
        // Remove cada vínculo selecionado
        foreach ($vinculos as $v) {
            $stmt->execute([':p' => $v['produto_id'], ':f' => $v['fornecedor_id']]);
        }
        
        echo json_encode(['sucesso' => true, 'mensagem' => count($vinculos) . ' vínculos removidos!']);
    } catch (PDOException $e) {
        echo json_encode(['sucesso' => false, 'mensagem' => $e->getMessage()]);
    }
}
