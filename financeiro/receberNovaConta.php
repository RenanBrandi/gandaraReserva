<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/pi_gandara/css/styleFinanceiro.css">
    <link rel="stylesheet" href="/pi_gandara/css/style.css">
    <title>Contas a Receber</title>


</head>

<body>
    <header>
        <?php
        include_once('../utils/menu.php');
        ?>
    </header>



    <div class="container mt-5">
        <h1 class="text-center">Adicionar Nova Conta a Receber</h1>

        <form>
            <div class="form-group">
                <label for="cliente">Cliente</label>
                <input type="text" class="form-control" id="cliente" placeholder="Nome do Cliente" required>
            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" class="form-control" id="valor" placeholder="Valor" required>
            </div>
            <div class="form-group">
                <label for="dataVencimento">Data de Vencimento</label>
                <input type="date" class="form-control" id="dataVencimento" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" required>
                    <option value="Pendente">Pendente</option>
                    <option value="Pago">Pago</option>
                    <option value="Atrasado">Atrasado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Conta</button>
            <a href="index.html" class="btn btn-secondary">Voltar</a>
        </form>
    </div>




    <script src="https://kit.fontawesome.com/74ecb76a40.js" crossorigin="anonymous"></script>
</body>

</html>