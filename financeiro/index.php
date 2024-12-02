<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/pi_gandara/css/style.css">
    <link rel="stylesheet" href="/pi_gandara/css/styleFinanceiro.css">
    <link rel="stylesheet" href="/pi_gandara/css/style.css">
    <title>FINANCEIRO</title>
</head>

<body>
    <header>
        <?php
        include_once('../utils/menu.php');
        ?>
    </header>

    <main class="container">
        <div class="row p-3 d-flex align-items-center">
            <a style="text-align: center;" type="button" class="col-1 btn btn-primary justify-content-center d-flex" href="/pi_gandara/dashboard.php">Voltar</a>
        </div>


        <div class="row p-3 justify-content-center d-flex align-items-center">


            <a href="contasPagar.php" class="btn">
                <div class="col-2 p-2 m-1">
                    <div style="width: 14rem;">
                        <span class="fa-solid fa-money-bill-transfer fa-5x " aria-hidden="true"></span>
                        <div class="card-body d-flex justify-content-center">
                            <h4>
                                <b>Contas a<br> Pagar</nobr></b>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="contasReceber.php" class="btn">
                <div class="col-2 p-2 m-1">
                    <div style="width: 14rem;">
                        <span class="fa-solid fa-money-bill-transfer fa-5x "  aria-hidden="true"></span>
                        <div class="card-body justify-content-center">
                            <h4><b>Contas a Receber</b></h3>
                        </div>
                    </div>
                </div>
            </a>

            <a href="aprovacao.php" class="btn">
                <div class="col-2 p-2 m-1">
                    <div style="width: 14rem;">
                        <span class="fa-solid fa-clipboard-check fa-5x" aria-hidden="true"></span>
                        <div class="card-body justify-content-center">
                            <h4><b>Aprovação de Cotação</b></h3>
                        </div>
                    </div>
                </div>
            </a>


        </div> <!--Fim da row -->

        <div class="row p-3 justify-content-center d-flex align-items-center">

            <!--<a href="gerFornecedores.php" class="btn">
                    <div class="col-2 p-2 m-1">
                        <div style="width: 14rem;">
                            <span class="fa-solid fa-truck fa-5x" aria-hidden="true"></span>
                            <div class="card-body justify-content-center">
                                <h4><b>Gerenciamento <nobr>de Fornecedores</b></nobr>
                                </h4>
                            </div>
                        </div>
                    </div>
                </a>-->

            <a href="fluxoCaixa.php" class="btn">
                <div class="col-2 p-2 m-1">
                    <div style="width: 14rem;">
                        <span class="fa-solid fa-scale-balanced fa-5x" aria-hidden="true"></span>
                        <div class="card-body justify-content-center">
                            <h4><b>Fluxo de Caixa</b></h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="movFiscal.php" class="btn">
                <div class="col-2 p-2 m-1">
                    <div style="width: 14rem;">
                        <span class="fa-solid fa-cash-register fa-5x" aria-hidden="true"></span>
                        <div class="card-body justify-content-center">
                            <h4><b>Movimentações Fiscais</b></h4>
                        </div>
                    </div>
                </div>
            </a>

            <a href="gerBancario.php" class="btn">
                <div class="col-2 p-2 m-1">
                    <div style="width: 14rem;">
                        <span class="fa-solid fa-landmark fa-5x" aria-hidden="true"></span>
                        <div class="card-body justify-content-center">
                            <h4><b>Gerenciamento Bancário</b></h4>
                        </div>
                    </div>
                </div>
            </a>

        </div> <!--Fim da row -->


        <!-- <div class="row p-5 justify-content-center d-flex align-items-center">
                <a href="" class="btn">
                    <div class="col-2 p-2 m-1">
                        <div style="width: 12rem;">
                            <span class="fa fa-cart-shopping fa-5x" aria-hidden="true"></span>
                            <div class="card-body">
                                <h4>*TESTE*</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div> -->

    </main>




    <script src="https://kit.fontawesome.com/74ecb76a40.js" crossorigin="anonymous"></script>
</body>

</html>