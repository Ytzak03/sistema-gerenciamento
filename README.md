"# Sistema-de-Gerenciamento-Web" 

Este projeto foi desenvolvido como parte de um teste técnico, focado em demonstrar habilidades em PHP, MySQL e integração com AJAX.

## 🚀 Como rodar o projeto

### Pré-requisitos
*   Servidor local **XAMPP** (utilizando Apache e MySQL).
*   PHP 8.0+

### Passo a Passo
1.  **Clonar/Copiar o projeto**: Coloque a pasta do projeto dentro do diretório `htdocs` do seu XAMPP.
2.  **Configurar o Banco de Dados**:
    *   Acesse o **phpMyAdmin** do seu XAMPP.
    *   Crie um banco de dados chamado `sistema_gerenciamento`.
    *   Importe o arquivo localizado em: `bd/sistema-gerenciamento.sql`. Este arquivo já contém toda a estrutura de tabelas e os registros necessários para o funcionamento inicial.
  
###SQL PARA CRIAÇÃO DE TABELAS E BANCO

CREATE DATABASE IF NOT EXISTS sistema_gerenciamento;
USE sistema_gerenciamento;

-- Tabela de Fornecedores
CREATE TABLE fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cnpj VARCHAR(18) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);

-- Tabela de Produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    sku VARCHAR(50) UNIQUE NOT NULL,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);

-- Tabela de Vínculo (N:N)
CREATE TABLE produto_fornecedor (
    produto_id INT NOT NULL,
    fornecedor_id INT NOT NULL,
    PRIMARY KEY (produto_id, fornecedor_id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE,
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id) ON DELETE CASCADE
);

3.  **Ajustar Conexão**:
    *   Abra o arquivo `config/conexao.php`.
    *   Verifique se as credenciais de acesso ao MySQL estão corretas para o seu ambiente local.
4.  **Acessar o Sistema**:
    *   Abra o navegador e acesse: `http://localhost/sistema-gerenciamento/index.php`

## 🛠️ Tecnologias e Ferramentas
*   **IDE:** VS Code (Visual Studio Code ).
*   **Versionamento:** Git.
*   **Servidor/Banco:** XAMPP (Apache + phpMyAdmin).
*   **Linguagens:** PHP (PDO), SQL, jQuery (AJAX) e CSS Puro.
