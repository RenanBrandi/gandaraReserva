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
  <title>Fluxo de Caixa</title>
</head>

<body>
  <header>
    <?php include_once('../utils/menu.php'); ?>
  </header>

  <main class="container">
    <div class="row p-3 justify-content-center d-flex align-items-center">
      <a type="button" style="text-align: left;" class="col-1 btn btn-primary justify-content-center d-flex" href="/pi_gandara/financeiro/">Voltar</a>
      <h1 style="text-align: center;" class="col-11 display-4"> <b>Fluxo de Caixa</b></h1>
    </div>


    <div class="align-items-center">

      <!-- Período -->

      <div class="d-flex justify-content-center">
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-text">Data Inicial:</span>
            <input type="date" class="form-control" value="2024-09-25">
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-text">Data Final:</span>
            <input type="date" class="form-control" value="2024-10-01">
          </div>
        </div>
      </div>

      <br>

      <!-- Saldo Inicial e Final -->
      <section class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Saldo Inicial</h5>
              <p class="card-text" style="text-align: center;">(Aguardando integração dos Módulos)</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Saldo Final</h5>
              <p class="card-text" style="text-align: center;">(Aguardando integração dos Módulos)</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Receita e Despesa -->
      <section class="row">
        <div class="col-md-6">
          <div class="card mb-4">
            <div class="card-header bg-success text-white">
              Receita
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td>Não Operacionais</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Operacionais</td>
                    <td class="text-end">-</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card mb-4">
            <div class="card-header bg-danger text-white">
              Despesa
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td>Impostos e Devoluções</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Custo da Mercadoria</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Gerais e Administrativas</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Aluguel, Condomínio e IPTU</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Propaganda e Marketing</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Pessoal</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Pro Labore</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Utilidades</td>
                    <td class="text-end">-</td>
                  </tr>
                  <tr>
                    <td>Despesas Financeiras</td>
                    <td class="text-end">-</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex justify-content-end p-3">
            <a type="button" class="btn btn-success" href="gerarPDFfc.php" target="_blank" style="margin-right: 20px;">Gerar Relatório</a>
          </div>
        </div>
      </section>
    </div>

  </main>
  <script src="https://kit.fontawesome.com/74ecb76a40.js" crossorigin="anonymous"></script>
</body>


</html>