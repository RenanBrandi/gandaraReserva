<?php
require '../utils/conexao.php';
// Verifica se veio um id na URL
$id = isset($_GET['id']) ? $_GET['id'] : false;
$cor = ($id) ? "btn-warning" : "btn-success";
// Caso tenha um ID faz A busca do Produto no BD
if ($id) {
    $sql = "SELECT * FROM cad_novobanco WHERE id=?;";
    $stmt = $conn->prepare($sql);
    // Troca o ? pelo ID que veio na URL
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $dados = $stmt->get_result();

    // Verifica se encontrou o Produto ou se ele existe no BD
    if ($dados->num_rows > 0) {
        // Coloca os dados do usuário em uma variavel como array
        $instituicao = $dados->fetch_assoc();
    } else {
        // Se não encontrou um Produto retorna para a página anterior.
?>

        <script>
            history.back();
        </script>
<?php
    }
}

// Prepara a consulta SQL
$sql = "SELECT * FROM cad_novobanco;";

// Envia o SQL para o Prepare Statement:
$stmt = $conn->prepare($sql);

//Executa a consulta SQL
$stmt->execute();

//Pega o resultado e adiciona em uma variavel
$dados = $stmt->get_result();

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/pi_gandara/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/pi_gandara/css/styleFinanceiro.css">
    <link rel="stylesheet" href="/pi_gandara/css/style.css">

    <title>Cadastrar Novo Banco</title>
</head>

<body>
    <header>
        <?php
        include_once('../utils/menu.php');
        ?>
    </header>


    <main class="container">
        <div class="row p-3 justify-content-center d-flex align-items-center">
            <a type="button" style="text-align: left;" class="col-1 btn btn-primary justify-content-center d-flex" href="/pi_gandara/financeiro/">Voltar</a>
            <h1 style="text-align: center;" class="col-11 display-4"><b>Cadastrar nova conta bancária</b></h1>
        </div>


        <div class="card card-cds">
            <form class="mt-3 mb-3 ml-3 mr-3" action="/pi_gandara/financeiro/bd/bd_novoBanco.php" method="POST">
                <input type="hidden" id="instituicao" name="instituicao" value="<?= isset($_GET['id']) ? $_GET['id'] : null ?>">
                <input type="hidden" name="acao" id="acao" value="<?= isset($_GET['id']) ? "ALTERAR" : "INCLUIR" ?>">
                <div class="form-group">

                    <div class="form-row justify-content-center mt-2">
                        <div class="col-sm-6">
                            <label for="nomeInstituicao">Nome da Instituição Financeira:</label>
                            <input type="text" class="form-control" id="nomeInstituicao" name="nomeInstituicao"
                                value="<?= ($id) ? $instituicao['nomeInstituicao'] : null ?>">
                        </div>
                        <div class="col-sm-4">
                            <label for="numeroConta">Número da Conta + Digito verificador:</label>
                            <input type="numeroConta" class="form-control" id="numeroConta" name="numeroConta"
                                value="<?= ($id) ? $instituicao['numeroConta'] : null ?>">
                        </div>

                    </div>

                    <br>

                    <div class="form-row justify-content-center mt-2">
                        <div class="col-sm-3">
                            <label for="tipoConta">Tipo da Conta:</label>
                            <select class="form-control" id="tipoConta" name="tipoConta">
                                <option value=""> -- ESCOLHA -- </option>
                                <option <?= (isset($_GET['id']) && $instituicao['tipoConta'] == "Corrente") ? "selected" : null ?>
                                    value="Corrente">CORRENTE</option>
                                <option <?= (isset($_GET['id']) && $instituicao['tipoConta'] == "Poupança") ? "selected" : null ?>
                                    value="Poupança">POUPANÇA</option>
                                <option <?= (isset($_GET['id']) && $instituicao['tipoConta'] == "Salario") ? "selected" : null ?>
                                    value="Salario">SALÁRIO</option>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label for="tipoConta">Selecione a Moeda:</label>
                            <select class="form-control" id="moeda" name="moeda">
                                <option value=""> -- ESCOLHA -- </option>
                                <option <?= (isset($_GET['id']) && $instituicao['moeda'] == "BRL") ? "selected" : null ?>
                                    value="BRL">BRL</option>
                                <option <?= (isset($_GET['id']) && $instituicao['moeda'] == "USD") ? "selected" : null ?>
                                    value="USD">USD</option>
                                <option <?= (isset($_GET['id']) && $instituicao['moeda'] == "EUR") ? "selected" : null ?>
                                    value="EUR">EUR</option>
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <label for="codBanco" href="https://proplad.furg.br/images/Lista_Cdigo_de_Bancos.pdf">Código do Banco:</label>
                            <span href="https://proplad.furg.br/images/Lista_Cdigo_de_Bancos.pdf" aria-hidden="true"></span>
                            <input type="text" class="form-control" id="codBanco" name="codBanco"
                                value="<?= ($id) ? $instituicao['codBanco'] : null ?>">
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="form-row justify-content-center mt-2">
                        <div class="col-sm-3 mt-3">
                            <button type="submit" name="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                        <div class="col-sm-3 mt-3">
                            <button type="reset" class="btn btn-warning">Cancelar</button>
                        </div>
                        <div class="col-sm-3 mt-3">
                            <a href="/pi_gandara/financeiro/gerBancario.php"><button type="button" class="btn btn-danger">Voltar</button></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <table class="table table-hover table-striped">
                <thead style="text-align:center;">
                    <th>Instituição</th>
                    <th>Número da Conta</th>
                    <th>Cód do Banco</th>
                    <th>Tipo da Conta</th>
                    <th>Moeda</th>
                    <th>AÇÕES</th>
                </thead>
                <tbody>
                    <?php
                    // Laço de repetição
                    // Que irá exibir uma linha da tabela para cada registro no bd
                    // Adiciona cada registro na variavel linha como um Arrey.
                    while ($linha = $dados->fetch_assoc()) {
                    ?>
                        <tr style="text-align:center;">
                            <td><?= $linha['nomeInstituicao'] ?></td>
                            <td><?= $linha['numeroConta'] ?></td>
                            <td><?= $linha['codBanco'] ?></td>
                            <td><?= $linha['tipoConta'] ?></td>
                            <td><?= $linha['moeda'] ?></td>
                            <td>
                                <!-- Chamo a página do formulario e envio o Id do Produto que será alterado-->
                                <a href="novoBanco.php?id=<?= $linha['id'] ?>" class="btn btn-warning">Editar</a>
                                <button class="btn btn-danger btn-excluir" data-table="novoBanco" data-id="<?= $linha['id'] ?>">Excluir</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </main>

    <script src="https://kit.fontawesome.com/74ecb76a40.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.btn-excluir').click(function() {
                var userId = $(this).data('id');
                var tabela = $(this).data('table');

                var confirma = confirm(`Você tem certeza que deseja excluir a Instituição: [ ${userId} ] ?`);

                if (confirma) {
                    $.ajax({
                        url: `/pi_gandara/financeiro/bd/bd_novoBanco.php`,
                        type: 'POST',
                        data: {
                            acao: "DELETAR",
                            instituicao: userId
                        },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.status === "sucesso") {
                                alert(result.message);
                                location.reload();
                            } else {
                                alert(result.message);
                            }
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

</body>

</html>