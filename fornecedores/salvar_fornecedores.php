<?php
require_once '../config/conexao.php';

$id       = $_POST['id'] ?? '';
$nome     = $_POST['nome'] ?? '';
$cnpj     = $_POST['cnpj'] ?? '';
$email    = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$status   = $_POST['status'] ?? 'Ativo';

header('Content-Type: application/json');

// Valida campos obrigatórios
if (empty($nome) || empty($cnpj)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Nome e CNPJ são obrigatórios!']);
    exit;
}

try {
    if (empty($id)) {
        // Insere novo fornecedor
        $sql = "INSERT INTO fornecedores (nome, cnpj, email, telefone, status) 
                VALUES (:nome, :cnpj, :email, :telefone, :status)";
    } else {
        // Atualiza fornecedor existente
        $sql = "UPDATE fornecedores 
                SET nome = :nome, cnpj = :cnpj, email = :email, telefone = :telefone, status = :status 
                WHERE id = :id";
    }

    $stmt = $pdo->prepare($sql);

    $dados = [
        ':nome'     => $nome,
        ':cnpj'     => $cnpj,
        ':email'    => $email,
        ':telefone' => $telefone,
        ':status'   => $status
    ];

    if (!empty($id)) {
        $dados[':id'] = $id;
    }

    if ($stmt->execute($dados)) {
        echo json_encode([
            'sucesso' => true, 
            'mensagem' => empty($id) ? 'Fornecedor cadastrado!' : 'Fornecedor atualizado!'
        ]);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao executar comando no banco.']);
    }

} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro de banco de dados: ' . $e->getMessage()]);
}
