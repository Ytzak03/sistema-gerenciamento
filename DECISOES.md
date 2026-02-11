- Como você modelou o banco de dados (Inclua a modelagem de Banco de Dados)

O banco foi modelado de forma relacional e normalizada, com três tabelas principais:

1. fornecedores
Armazena os dados cadastrais dos fornecedores, contendo:
id, nome, cnpj, email, telefone e status.
Campos como CNPJ e e-mail são únicos para evitar duplicidade de cadastro.

2. produtos
Responsável pelos dados dos produtos, contendo:
id, nome, descricao, preco, codigo_interno e status.

3. produto_fornecedor
Tabela de associação (N:N) que faz o vínculo entre produtos e fornecedores.
Ela possui chave primária composta por produto_id e fornecedor_id


- Por que escolheu essa estrutura

Escolhi essa modelagem porque já tinha familiaridade com esse tipo de estrutura e sabia que o relacionamento entre produtos e fornecedores exigia uma relação muitos-para-muitos (N:N), resolvida através da tabela intermediária produto_fornecedor.

O campo status foi incluído para permitir a desativação de registros sem a necessidade de exclusão física no banco de dados, mantendo o histórico e evitando perda de informações importantes.

O uso de restrições UNIQUE foi aplicado para impedir duplicidade em dados críticos como CNPJ, e-mail e código interno do produto, garantindo maior integridade e confiabilidade das informações.


- O que melhoraria se tivesse mais tempo:

Se eu tivesse mais tempo, eu investiria nas seguintes melhorias:

1. Logs e Monitoramento

Implementar rastreabilidade detalhada de erros e tratamento global de exceções, facilitando a identificação e solução de problemas.

2. Experiência do Usuário (UX)

Melhorias gerais de UX, incluindo máscara automática para CNPJ e telefone, modo escuro (Dark Mode) e interfaces mais intuitivas.

3. Funcionalidades de Validação e Upload

Validação automática de CNPJs via API.

Upload de documentos como contratos e comprovantes, garantindo maior organização e segurança.

4. Dashboard e Relatórios

Painel com métricas relevantes: total de fornecedores, pendentes de aprovação, novos no mês.

Relatórios exportáveis em PDF ou Excel.

5. Controle e Auditoria

Controle de permissões mais granular (Admin / Usuário comum).

Histórico completo de alterações para auditoria.

Implementação de fluxo de aprovação automatizado para agilizar processos internos.

6. Segurança e Criptografia

Criptografia de dados sensíveis para maior proteção das informações.

7. E Faria o deploy.