<?php
require_once '../config/conexao.php';
header('Content-Type: application/json');

try {
    $sql = "SELECT 
                pf.produto_id, 
                pf.fornecedor_id, 
                p.nome AS produto_nome, 
                f.nome AS fornecedor_nome 
            FROM produto_fornecedor pf
            INNER JOIN produtos p ON pf.produto_id = p.id
            INNER JOIN fornecedores f ON pf.fornecedor_id = f.id
            ORDER BY p.nome ASC";

    $stmt = $pdo->query($sql);
    $vinculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($vinculos);
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}
