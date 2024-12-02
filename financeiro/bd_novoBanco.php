<?php
require "../../utils/conexao.php";

// Ex: colocar o valor do POST se ele existir, se não deixar em branco.

// variavel = condição ? se VERDADEIRO : se FALSE;
$nomeInstituicao = isset($_POST['nomeInstituicao']) && !empty($_POST['nomeInstituicao']) ? $_POST['nomeInstituicao'] : null;
$numeroConta = isset($_POST['numeroConta']) && !empty($_POST['numeroConta']) ? $_POST['numeroConta'] : null;
$codBanco = isset($_POST['codBanco']) && !empty($_POST['codBanco']) ? $_POST['codBanco'] : null;
$tipoConta = isset($_POST['tipoConta']) && !empty($_POST['tipoConta']) ? $_POST['tipoConta'] : null;
$moeda = isset($_POST['moeda']) && !empty($_POST['moeda']) ? $_POST['moeda'] : null;
$anotacoes = isset($_POST['anotacoes']) && !empty($_POST['anotacoes']) ? $_POST['anotacoes'] : null;
$instituicao = isset($_POST['instituicao']) && !empty($_POST['instituicao']) ? $_POST['instituicao'] : null;
$acao = isset($_POST['acao']) && !empty($_POST['acao']) ? $_POST['acao'] : null;

// Verificamos qual operação está sendo feita .

if ($acao == "INCLUIR") {

    $sql = "INSERT INTO cad_novobanco (nomeInstituicao, numeroConta, codBanco, tipoConta, moeda, anotacoes) 
    VALUE (?, ?, ?, ?, ?, ?);";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "siisss",
        $nomeInstituicao,
        $numeroConta,
        $codBanco,
        $tipoConta,
        $moeda,
        $anotacoes
    );

    try {
        if ($stmt->execute()) { 
            // Pega o numero do ID que foi inserido no BD
            $instituicao = $conn->insert_id;
            echo $instituicao;

            header('Location: /pi_gandara/financeiro/novoBanco.php');
        } else {
            echo $stmt->error;
        }
    } catch (Exception $e) {
        echo "Erro ao cadastrar!";
        // Vamos utilizar JS para poder recuperar os dados digitados 
?>
    <script>
      history.back();
    </script>
<?php
    }
    //Fecha o Prepared Statement
    $stmt->close();
    //Fecha a conexão 
    $conn->close();


    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else if ($acao == "ALTERAR") {
        $sql = "UPDATE cad_novobanco SET 
        nomeInstituicao = ?,
        numeroConta = ?,
        codBanco = ?,
        tipoConta = ?,
        moeda = ?,
        anotacoes = ?
        WHERE id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "siisssi",
            $nomeInstituicao,
            $numeroConta,
            $codBanco,
            $tipoConta,
            $moeda,
            $anotacoes,
            $instituicao
        );
    try {
        if ($stmt->execute()) {
            header('Location: /pi_gandara/financeiro/novoBanco.php');
        } else {
            echo $stmt->error;
        }
    } catch (Exception $e) {
        echo "Erro ao Atualizar!";
        // Vamos utilizar JS para poder recuperar os dados digitados 
    ?>
        <script>
            history.back();
        </script>
<?php
    }
    //Fecha o Prepared Statement
    $stmt->close();
    //Fecha a conexão 
    $conn->close();



} else if ($acao == "DELETAR") {
    // Neste bloco será excluido um registro que já existe no BD.
    
    $sql = "DELETE FROM cad_novobanco WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $instituicao);
    if ($stmt->execute()) {
        echo json_encode(array(
            "status" => "sucesso",
            "message" => "Registro excluido com sucesso!"
        ));
    } else {
        echo json_encode(array(
            "status" => "erro",
            "message" => "erro ao excluir o registro!" . $stmt->error
        ));
        $stmt->close();
        $conn->close();
    }
} else {
    // Se nenhuma das operações for solicitada,volta para o inicio do site.
    // A função header modifica o cabeçalho do navegador 
    // Ao passar a propriedade location, definimos para qual URL o navegador deve ir.
    header("Location: /pi_gandara/dashboard.php");
    exit;
}
