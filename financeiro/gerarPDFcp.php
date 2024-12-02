<?php
require_once('../utils/conexao.php');
require_once('c:/xampp/htdocs/pi_gandara/vendor/tecnickcom/tcpdf/tcpdf.php');

// Criar novo PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CERES - Financeiro');
$pdf->SetTitle('CERES - Financeiro - Contas a Pagar');
$dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
$pdf->SetHeaderData('', 0, 'CERES - Financeiro - Contas a Pagar', 'Gerado em: ' . $dateTime->format('d/m/Y H:i:s') . ' (Horário de Brasília)');
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 27, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

// Definir fonte
$pdf->SetFont('helvetica', '', 12);

// Consultar os dados das vendas
$sql = $sql = "SELECT  v.id_venda,  v.nome, v.dia_venda, v.produto, v.quantidade, v.valor,  n.id_nfse FROM cad_vendas v 
LEFT JOIN cad_nfse n ON v.id_venda = n.id_venda;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$dados = $stmt->get_result();

// Inicializa as variáveis para totalizar
$totalQuantidade = 0;
$totalValor = 0;

// Criar tabela HTML para os dados
$html = '<h2>Contas a Pagar</h2>';
$html .= '<table border="1" cellpadding="4">';
$html .= '<thead>
            <tr>
                <th align="center"><strong>Número Pedido</strong></th>
                <th align="center"><strong>NF-e</strong></th>
                <th align="center"><strong>Data Vencimento</strong></th>
                <th align="center"><strong>Valor</strong></th>
            </tr>
          </thead>
          <tbody>';

while ($linha = $dados->fetch_assoc()) {
  $valorVenda = number_format($linha['quantidade'] * $linha['valor'], 2, ',', '.');
  $html .= '<tr>
                <td align="center"> (Aguardando Estoque) </td>
                <td align="center"> (Aguardando Estoque) </td>
                <td align="center"> (Aguardando Estoque) </td>
                <td align="center">R$:  (Aguardando Estoque) </td>
              </tr>';

  // Calcule a quantidade e o valor total
  $totalQuantidade++; // Incrementa a quantidade total
  $totalValor += $linha['quantidade'] * $linha['valor']; // Soma o valor total
}

$html .= '</tbody></table>';

// Adicionar Resumo ao PDF
$html .= '<h3>Resumo</h3>';
$html .= '<table border="1" cellpadding="4">';
$html .= '<thead>
            <tr>
                <th align="center"><strong>Quantidade Total de Pedidos</strong></th>
                <th align="center"><strong>Valor Total dos Pedidos</strong></th>
            </tr>
          </thead>
          <tbody>';
$html .= '<tr>
            <td align="center">(Aguardando Estoque)</td>
            <td align="center">R$: (Aguardando Estoque) </td>
          </tr>';
$html .= '</tbody></table>';

// Escrever o conteúdo HTML no PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Fechar e gerar o PDF
$pdf->Output('relatorio_vendas.pdf', 'I'); // 'I' para abrir no navegador, 'D' para download