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

  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.css" crossorigin="anonymous">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/pi_gandara/css/styleFinanceiro.css">
  <link rel="stylesheet" href="/pi_gandara/css/style.css">
  <title>Gerenciamento Bancário</title>
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
      <h1 style="text-align: center;" class="col-11 display-4"> <b>Gerenciamento Bancário</b></h1>
    </div>

    <div class="row p-3 justify-content-center d-flex align-items-center">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Contas Bancárias</h5>
            <ul class="list-group">
              <li class="list-group-item">

                <table class="table table-hover table-striped">
                  <thead>
                    <th> <span class="fa fa-bank" aria-hidden="true"></span> Instituições</th>
                    <th>Tipo da Conta</th>
                    <th>Moeda</th>
                    <th style="text-align:center;">AÇÃO</th>
                  </thead>
                  <tbody>
                    <?php
                    while ($linha = $dados->fetch_assoc()) {
                    ?>
                      <tr style="text-align:center;">
                        <td><?= $linha['nomeInstituicao'] ?></td>
                        <td><?= $linha['tipoConta'] ?></td>
                        <td><?= $linha['moeda'] ?></td>
                        <td>
                          <!-- Chamo a página do formulario e envio o Id do Produto que será alterado-->
                          <a href="novoBanco.php?id=<?= $linha['id'] ?>" class="btn btn-success">Visualizar</a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

              </li>
            </ul>

            <br>
            <a type="button" style="text-align: justify;" class="btn btn-primary justify-content-center d-flex" href="/pi_gandara/financeiro/novoBanco.php">Adicionar nova conta</a>

          </div>

        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Movimentações Bancárias</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="text-align: center;">Data</th>
                  <th style="text-align: center;">Tipo</th>
                  <th style="text-align: center;">Valor</th>
                  <th style="text-align: center;">Conta</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center;">20/12/2024</td>
                  <td style="text-align: center;">Depósito</td>
                  <td style="text-align: center;">R$ 1.000,00</td>
                  <td style="text-align: center;">Conta Corrente - Banco do Brasil</td>
                </tr>
                <tr>
                  <td style="text-align: center;">19/12/2024</td>
                  <td style="text-align: center;">Saque</td>
                  <td style="text-align: center;">R$ 500,00</td>
                  <td style="text-align: center;">Conta Poupança - Caixa Econômica</td>
                </tr>
                <tr>
                  <td style="text-align: center;">18/12/2024</td>
                  <td style="text-align: center;">Transferência</td>
                  <td style="text-align: center;">R$ 2.000,00</td>
                  <td style="text-align: center;">Conta Investimento - Banco Santander</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row p-3 justify-content-center d-flex align-items-center">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Relatórios Bancários</h5>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="text-start">
                  <span class="fa fa-file" aria-hidden="true"></span>
                  <span>Relatório de Movimentações Bancárias</span>
                </div>
                <div>
                  <a type="button" href="gerarPDFgb.php" target="_blank" class="btn btn-success">Gerar Relatório</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </main>




  <script src="https://kit.fontawesome.com/74ecb76a40.js" crossorigin="anonymous"></script>
</body>

</html>