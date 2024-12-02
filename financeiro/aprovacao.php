<?php
require '../utils/conexao.php';
// Verifica se veio um id na URL
$id = isset($_GET['id']) ? $_GET['id'] : false;
$cor = ($id) ? "btn-warning" : "btn-success";
// Caso tenha um ID faz A busca do Produto no BD
if ($id) {
    $sql = "SELECT * FROM cotacao WHERE id=?;";
    $stmt = $conn->prepare($sql);
    // Troca o ? pelo ID que veio na URL
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $dados = $stmt->get_result();

    // Verifica se encontrou o Produto ou se ele existe no BD
    if ($dados->num_rows > 0) {
        // Coloca os dados do usuário em uma variavel como array
        $cotacao = $dados->fetch_assoc();
    } else {
        // Se não encontrou um Produto retorna para a página anterior.
?>

        <script>
            history.back();
        </script>
<?php
    }
}

$sql = "SELECT c.id, p.cod_produto, p.produto, c.qtd, c.data_entrega, c.valor, s.observacao FROM cotacao c
                INNER JOIN sol_compra s ON c.id_sol_compra = s.id
                INNER JOIN cad_produtos p ON s.id_produto = p.id 
        WHERE c.estado IS NULL";
$stmt = $conn->prepare($sql);
$stmt->execute();
$dados = $stmt->get_result();

// Prepara a consulta SQL
$sql_sol_compra = "SELECT s.id, p.cod_produto, p.produto, p.descricao, s.data_criacao, s.observacao 
                               FROM sol_compra s 
                               INNER JOIN cad_produtos p ON s.id_produto = p.id";

// Envia o SQL para o Prepare Statement:
$stmt_sol_compra = $conn->prepare($sql_sol_compra);

//Executa a consulta SQL
$stmt_sol_compra->execute();

//Pega o resultado e adiciona em uma variavel
$result_solicitacao = $stmt_sol_compra->get_result();

// Prepara a consulta SQL da tabela de Usuarios
$sql_forncedores = "SELECT id, nome FROM cad_fornecedor"; // Ajuste os campos conforme necessário
$stmt_fornecedores = $conn->prepare($sql_forncedores);
$stmt_fornecedores->execute();
$result_fornecedores = $stmt_fornecedores->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/pi_gandara/css/styleFinanceiro.css">
    <link rel="stylesheet" href="/pi_gandara/css/style.css">

    <title>Cotação Pendentes</title>
</head>

<body>
    <header>
        <?php
        include_once('../utils/menu.php');
        ?>
    </header>

    <main class="container card">
        <div class="row p-3 justify-content-center d-flex align-items-center">
            <a type="button" style="text-align: left;" class="col-1 btn btn-primary justify-content-center d-flex" href="/pi_gandara/financeiro/">Voltar</a>
            <h1 style="text-align: center;" class="col-11 display-4"> <b>Aprovação de Cotação Pendente</b></h1>
        </div>


        <table class="table table-bordered mt-4">
            <thead style="text-align:center;">
                <tr>
                    <th>Código</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>D. Entrega</th>
                    <th>Valor</th>
                    <th>Observação</th>
                    <th>AÇÃO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Laço de repetição
                // Que irá exibir uma linha da tabela para cada registro no bd
                // Adiciona cada registro na variavel linha como um Arrey.
                while ($linha = $dados->fetch_assoc()) {
                ?>
                    <tr style="text-align:center;">
                        <td><?= $linha['cod_produto'] ?></td>
                        <td><?= $linha['produto'] ?></td>
                        <td><?= $linha['qtd'] ?></td>
                        <td><?= $linha['data_entrega'] ?></td>
                        <td><?= $linha['valor'] ?></td>
                        <td><?= $linha['observacao'] ?></td>
                        <td>
                            <button class="btn btn-success btn-aceitar" data-table="cotacao" data-id="<?= $linha['id'] ?>">APROVAR</button>
                            <button class="btn btn-danger btn-recusar" data-table="cotacao" data-id="<?= $linha['id'] ?>">RECUSAR</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                // Handle the click event for the "APROVAR" button
                $('.btn-aceitar').click(function() {
                    var quoteId = $(this).data('id'); // Get the quote ID from the data attribute

                    // Confirm the action
                    var confirma = confirm(`Você tem certeza que deseja aceitar a cotação [ ${quoteId} ]?`);
                    if (confirma) {
                        $.ajax({
                            url: `/pi_gandara/compras/bd/bd_cotacao.php`,
                            type: 'POST',
                            data: {
                                acao: "ATUALIZAR",
                                id: quoteId,
                                status: 2
                            },
                            success: function(response) {
                                location.reload(); // Reload the page to reflect changes

                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                                alert("Ocorreu um erro: " + error);
                            }
                        });
                    }
                });

                $('.btn-recusar').click(function() {
                    var quoteId = $(this).data('id');

                    var confirma = confirm(`Você tem certeza que deseja recusar a cotação [ ${quoteId} ]?`);
                    if (confirma) {
                        $.ajax({
                            url: `/pi_gandara/compras/bd/bd_cotacao.php`,
                            type: 'POST',
                            data: {
                                acao: "ATUALIZAR",
                                id: quoteId,
                                status: 1
                            },
                            success: function(response) {
                                location.reload(); // Reload the page to reflect changes
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                                alert("Ocorreu um erro: " + error);
                            }
                        });
                    }
                });
            });
        </script>

    </main>

    <script src="https://kit.fontawesome.com/74ecb76a40.js" crossorigin="anonymous"></script>
</body>

</html>