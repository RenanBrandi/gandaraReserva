<?php
require_once('C:\xampp\htdocs\pi_gandara\vendor\tecnickcom\tcpdf\tcpdf.php'); // ajuste o caminho conforme necessário

// Criar um novo PDF
$pdf = new TCPDF();

// Definir informações do documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CERES - Financeiro');
$pdf->SetTitle('CERES - Financeiro - Gerenciamento Bancário');
$dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
$pdf->SetHeaderData('', 0, 'CERES - Financeiro - Gerenciamento Bancário', 'Gerado em: ' . $dateTime->format('d/m/Y H:i:s') . ' (Horário de Brasília)');
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 27, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Adicionar uma página
$pdf->AddPage();

// Definir fonte
$pdf->SetFont('helvetica', '', 12);

// Captura o conteúdo HTML que você deseja converter
ob_start();
?>

<h1>Relatório Bancário</h1>

<h2>Contas Bancárias</h2>
<table border="1" cellpadding="4">
  <thead>
    <tr>
      <th style="text-align:center; font-weight:bold;">Instituições</th>
      <th style="text-align:center; font-weight:bold;">Tipo da Conta</th>
      <th style="text-align:center; font-weight:bold;">Moeda</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Conectar ao banco de dados e buscar as contas bancárias
    require '../utils/conexao.php';
    $sql = "SELECT * FROM cad_novobanco;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $dados = $stmt->get_result();

    while ($linha = $dados->fetch_assoc()) {
      echo '<tr>';
      echo '<td style="text-align:center;">' . $linha['nomeInstituicao'] . '</td>';
      echo '<td style="text-align:center;">' . $linha['tipoConta'] . '</td>';
      echo '<td style="text-align:center;">' . $linha['moeda'] . '</td>';
      echo '</tr>';
    }
    ?>
  </tbody>
</table>

<h2>Movimentações Bancárias</h2>
<table border="1" cellpadding="4">
  <thead>
    <tr>
      <th style="text-align:center; font-weight:bold;">Data</th>
      <th style="text-align:center; font-weight:bold;">Tipo</th>
      <th style="text-align:center; font-weight:bold;">Valor</th>
      <th style="text-align:center; font-weight:bold;">Conta</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align:center;">20/12/2024</td>
      <td style="text-align:center;">Depósito</td>
      <td style="text-align:center;">R$ 1.000,00</td>
      <td style="text-align:center;">Conta Corrente - Banco do Brasil</td>
    </tr>
    <tr>
      <td style="text-align:center;">19/12/2024</td>
      <td style="text-align:center;">Saque</td>
      <td style="text-align:center;">R$ 500,00</td>
      <td style="text-align:center;">Conta Poupança - Caixa Econômica</td>
    </tr>
    <tr>
      <td style="text-align:center;">18/12/2024</td>
      <td style="text-align:center;">Transferência</td>
      <td style="text-align:center;">R$ 2.000,00</td>
      <td style="text-align:center;">Conta Investimento - Banco Santander</td>
    </tr>
  </tbody>
</table>

<?php
$content = ob_get_clean();

// Escrever o conteúdo HTML ao PDF
$pdf->writeHTML($content, true, false, true, false, '');

// Fechar e gerar o PDF
$pdf->Output('relatorio_bancario.pdf', 'I'); // 'I' para exibir no navegador, 'D' para forçar download
?>