<?php
require '../utils/conexao.php';

$id = isset($_GET['id']) ? $_GET['id'] : false;

if ($id) {
  $sql = "SELECT * FROM cad_vendas WHERE id=?;";
  $stmt = $conn->prepare($sql);


  $stmt->bind_param("i", $id);
  $stmt->execute();

  $dados = $stmt->get_result();

  // Verifica se encontrou o usuario ou se ele existe no BD
  if ($dados->num_rows > 0) {
    // Coloca os dados do usuário em uma variavel como array
    $user = $dados->fetch_assoc();
  } else {
    // Se não encontrou um usuario retorna para a página anterior.
?>

    <script>
      history.back();
    </script>
<?php
  }
}

$sql = "SELECT * FROM cad_vendas;";
//$sql = "SELECT * FROM cad_nfse;";

// Inicializa a variável de busca
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Prepara a consulta SQL
//$sql = "SELECT * FROM cad_venda WHERE id_produto LIKE ?"; //OR produto LIKE ?";


$stmt = $conn->prepare($sql);
// $likeBuscar = "%" . $buscar . "%";
// $stmt->bind_param("ss", $likeBuscar, $likeBuscar);
$stmt->execute();
$dados = $stmt->get_result();

// Prepara a consulta SQL da tabela de cliente
$sql_cliente = "SELECT id, nome, cpf_cnpj, tipo_cliente, email, celular, logradouro,
numero, complemento, bairro, cidade, estado, cep FROM cad_cliente"; // Ajuste os campos conforme necessário


$stmt_cliente = $conn->prepare($sql_cliente);
$stmt_cliente->execute();
$result_cliente = $stmt_cliente->get_result();

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.css" crossorigin="anonymous">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/pi_gandara/css/styleFinanceiro.css">
  <link rel="stylesheet" href="/pi_gandara/css/style.css">

  <title>Contas a Pagar</title>
</head>

<body>
  <header>
    <?php include_once('../utils/menu.php'); ?>
  </header>

  <main class="container card">
    <div class="row p-3 justify-content-center d-flex align-items-center">
      <a type="button" style="text-align: left;" class="col-1 btn btn-primary justify-content-center d-flex" href="/pi_gandara/financeiro/">Voltar</a>
      <h1 style="text-align: center;" class="col-11 display-4"> <b>Contas a Pagar</b></h1>
    </div>

    <br>

    <div class="d-flex justify-content-center">
      <form method="GET" action="contasPagar.php">
        <input class="form-control" type="text" name="buscar" placeholder="Pesquisar conta..."> 
      </form> &nbsp
      <a style="text-align: center;" type="submit" class="btn btn-primary">Buscar</a>
    </div>

    <br><br>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Contas a Pagar</h5>
        <div class="table-responsive">
          <table style="text-align:center;" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Número do Pedido</th>
                <th>NF-e</th>
                <th>Data da Venda</th>
                <th>Produto</th>
                <th>Valor da Venda</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // ... (código anterior)

              $totalQuantidade = 0;
              $totalValor = 0;

              $dadosArray = [];

              while ($linha = $dados->fetch_assoc()) {
                $dadosArray[] = $linha;
              ?>
                <tr>
                  <td><br><b>(AGUARDANDO O ESTOQUE) </b></td>
                  <td><br><b>(AGUARDANDO O ESTOQUE) </b></td>
                  <td><br><b>(AGUARDANDO O ESTOQUE) </b></td>
                  <td><br><b>(AGUARDANDO O ESTOQUE) </b></td>
                  <td>R$: <br><b>(AGUARDANDO O ESTOQUE) </b></td>
                </tr>
              <?php
                // Calcule a quantidade e o valor total para cada linha
                $totalQuantidade = $dados->num_rows; // Conta o número de registros retornados
                $totalValor += $linha['quantidade'] * $linha['valor']; // Calcula o valor total
              }
              ?>
            </tbody>
          </table>

          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">Resumo</h5>
              <div class="table-responsive">
                <table style="text-align:center;" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Quantidade Total de Pedidos</th>
                      <th>Valor Total dos Pedidos</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><br><b>(AGUARDANDO O ESTOQUE) </b></td>
                      <td>R$: <br><b>(AGUARDANDO O ESTOQUE) </b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <div class="row p-3 d-flex justify-content-end align-items-end">
          <a style="text-align: center;" type="button" href="gerarPDFcp.php" target="_blank" class="col-2 btn btn-success" href="/pi_gandara/dashboard.php">Gerar Relatório</a>
        </div>
      </div>

    </div>



    <!-- ... (o restante do código permanece inalterado) -->

  </main>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/74ecb76a40.js" crossorigin="anonymous"></script>
</body>

</html>