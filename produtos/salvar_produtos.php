<?php
require_once '../config/conexao.php';
header('Content-Type: application/json');

$id        = $_POST['id'] ?? '';
$nome      = $_POST['nome'] ?? '';
$desc      = $_POST['descricao'] ?? '';
$cod       = $_POST['codigo_interno'] ?? '';
$status    = $_POST['status'] ?? 'Ativo';

try {
    if (empty($id)) {
        // Insere novo produto
        $sql = "INSERT INTO produtos (nome, descricao, codigo_interno, status) VALUES (:nome, :desc, :cod, :status)";
    } else {
        // Atualiza produto existente
        $sql = "UPDATE produtos SET nome = :nome, descricao = :desc, codigo_interno = :cod, status = :status WHERE id = :id";
    }

    $stmt = $pdo->prepare($sql);
    $dados = [':nome' => $nome, ':desc' => $desc, ':cod' => $cod, ':status' => $status];
    if (!empty($id)) $dados[':id'] = $id;

    $stmt->execute($dados);
    echo json_encode(['sucesso' => true, 'mensagem' => 'Produto salvo!']);
} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'mensagem' => $e->getMessage()]);
}
