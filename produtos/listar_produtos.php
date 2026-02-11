<?php
require_once '../config/conexao.php';
header('Content-Type: application/json');

$stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome ASC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
