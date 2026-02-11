$(document).ready(function() {

    carregarOpcoes();
    listarVinculos();

    // Abre modal para novo vínculo
    $('#btn-novo-vinculo').on('click', function () {
        $('#form-vinculo')[0].reset();
        $('#modal-vinculo-title').text('Novo Vínculo');
        $('#modal-vinculo').fadeIn(200);
    });

    // Fecha modal
    $('#modal-vinculo-close, #btn-cancelar-vinculo').on('click', function () {
        $('#modal-vinculo').fadeOut(200);
    });

    // Salva vínculo entre produto e fornecedor
    $('#form-vinculo').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'vincular.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                alert(res.mensagem);
                if(res.sucesso) {
                    $('#modal-vinculo').fadeOut(200);
                    listarVinculos();
                }
            },
            error: function() {
                alert('Erro ao vincular.');
            }
        });
    });

    // Seleciona ou desmarca todos os checkboxes
    $('#check-all').on('click', function() {
        $('.check-vinculo').prop('checked', this.checked);
    });

    // Remove vínculos selecionados em massa
    $('#btn-remover-massa').click(function() {

        let selecionados = [];

        $('.check-vinculo:checked').each(function() {
            selecionados.push({
                produto_id: $(this).data('produto'),
                fornecedor_id: $(this).data('fornecedor')
            });
        });

        if (selecionados.length === 0) {
            alert("Selecione ao menos um vínculo para remover!");
            return;
        }

        if (confirm(`Deseja remover os ${selecionados.length} vínculos selecionados?`)) {

            $.ajax({
                url: 'remover_massa.php',
                type: 'POST',
                data: { vinculos: selecionados },
                dataType: 'json',
                success: function(res) {
                    alert(res.mensagem);
                    if(res.sucesso) listarVinculos();
                }
            });

        }
    });

});

// Carrega opções de produtos e fornecedores nos selects
function carregarOpcoes() {

    $.get('../produtos/listar_produtos.php', function(produtos) {

        let options = '<option value="">Selecione um Produto</option>';

        produtos.forEach(p => {
            options += `<option value="${p.id}">${p.nome}</option>`;
        });

        $('#produto_id').html(options);
    });

    $.get('../fornecedores/listar_fornecedores.php', function(fornecedores) {

        let options = '<option value="">Selecione um Fornecedor</option>';

        fornecedores.forEach(f => {
            options += `<option value="${f.id}">${f.nome}</option>`;
        });

        $('#fornecedor_id').html(options);
    });
}

// Carrega e exibe lista de vínculos
function listarVinculos() {

    $.ajax({
        url: 'listar_vinculos.php',
        type: 'GET',
        dataType: 'json',
        success: function(dados) {

            let html = '';

            if (dados.length === 0) {

                html = '<tr><td colspan="4">Nenhum vínculo encontrado.</td></tr>';

            } else {

                dados.forEach(v => {

                    html += `<tr>
                        <td>
                            <input type="checkbox"
                                   class="check-vinculo"
                                   data-produto="${v.produto_id}"
                                   data-fornecedor="${v.fornecedor_id}">
                        </td>
                        <td>${v.produto_nome}</td>
                        <td>${v.fornecedor_nome}</td>
                        <td>
                            <td>
                                <button onclick="removerVinculo(${v.produto_id}, ${v.fornecedor_id})">Remover</button>
                            </td>
                        </td>
                    </tr>`;
                });

            }

            $('#tabela-vinculos').html(html);
        }
    });
}

// Remove um vínculo específico
function removerVinculo(produtoId, fornecedorId) {

    if (confirm('Deseja realmente remover este vínculo?')) {

        $.ajax({
            url: 'remover_vinculo.php',
            type: 'POST',
            data: { 
                produto_id: produtoId, 
                fornecedor_id: fornecedorId 
            },
            dataType: 'json',
            success: function(res) {
                if (res.sucesso) {
                    alert(res.mensagem);
                    listarVinculos();
                }
            }
        });

    }
}
