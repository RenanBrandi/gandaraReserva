<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.css" crossorigin="anonymous">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/pi_gandara/css/style.css">
  <link rel="stylesheet" href="/pi_gandara/css/styleFinanceiro.css">
  <title>Movimentações Fiscais</title>
</head>

<body>
  <header>
    <?php
    include_once('../utils/menu.php');
    ?>
  </header>


  <main>
    <div class="container">
      <div class="row p-3 justify-content-center d-flex align-items-center">
        <a type="button" style="text-align: left;" class="col-1 btn btn-primary justify-content-center d-flex" href="/pi_gandara/financeiro/">Voltar</a>
        <h1 style="text-align: center;" class="col-11 display-4">Movimentações Fiscais</h1>
      </div>

      <div class="row p-3 justify-content-center d-flex align-items-center">
        <div class="col-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Saldo Atual </h5>
              <p class="card-text">R$ 250.000,00</p>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Movimentações Recentes</h5>
              <ul class="list-group">
                <li class="list-group-item">Entrada: R$ 12.000,00</li>
                <li class="list-group-item">Saída: R$ 6.500,00</li>
                <li class="list-group-item">Entrada: R$ 2.000,00</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row p-3 justify-content-center d-flex align-items-center">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Histórico de Movimentações</h5>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2023-02-20</td>
                    <td>Entrada</td>
                    <td>R$ 1.000,00</td>
                  </tr>
                  <tr>
                    <td>2023-02-19</td>
                    <td>Saída</td>
                    <td>R$ 500,00</td>
                  </tr>
                  <tr>
                    <td>2023-02-18</td>
                    <td>Entrada</td>
                    <td>R$ 2.000,00</td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex justify-content-end p-3">
                <a type="button" class="btn btn-success" href="gerarPDFmf.php" target="_blank" style="margin-right: 20px;">Gerar Relatório</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>




  <script src="https://kit.fontawesome.com/74ecb76a40.js" crossorigin="anonymous"></script>
</body>

</html>