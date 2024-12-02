<?php
require_once('../utils/conexao.php');
require_once('c:/xampp/htdocs/pi_gandara/vendor/tecnickcom/tcpdf/tcpdf.php');

// Criação do PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CERES - Financeiro');
$pdf->SetTitle('CERES - Financeiro - Fluxo de Caixa');
$dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
$pdf->SetHeaderData('', 0, 'CERES - Financeiro - Fluxo de Caixa', 'Gerado em: ' . $dateTime->format('d/m/Y H:i:s') . ' (Horário de Brasília)');
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 27, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

// Adicione o conteúdo da página aqui
$pdf->SetFont('', 'B'); // Define a fonte como negrito
$pdf->Cell(95, 10, 'Data Inicial: 25/09/2024', 0, 0); // Alinhado à esquerda
$pdf->Cell(0, 10, 'Data Final: 01/10/2024', 0, 1, 'R'); // Alinhado à direita

$pdf->Cell(95, 10, 'Saldo Inicial: (Aguardando integração dos Módulos)', 0, 0); // Alinhado à esquerda
$pdf->Cell(0, 10, '', 0, 1, 'R'); // Espaço vazio para alinhar
$pdf->Cell(95, 10, 'Saldo Final: (Aguardando integração dos Módulos)', 0, 1); // Alinhado à esquerda

$pdf->SetFont('', 'B'); // Define a fonte como negrito para os cabeçalhos
$pdf->Cell(95, 10, 'Receita', 0, 0, 'C', 0);
$pdf->Cell(95, 10, 'Despesas', 0, 1, 'C', 0);

// Resta do conteúdo
$pdf->SetFont('', ''); // Retorna à fonte normal
$pdf->Cell(95, 10, 'Não Operacionais: -', 0, 0);
$pdf->Cell(95, 10, 'Impostos e Devoluções: -', 0, 1);
$pdf->Cell(95, 10, 'Operacionais: -', 0, 0);
$pdf->Cell(95, 10, 'Custo da Mercadoria: -', 0, 1);
$pdf->Cell(95, 10, '', 0, 0); // Espaço vazio para alinhar
$pdf->Cell(95, 10, 'Gerais e Administrativas: -', 0, 1);
$pdf->Cell(95, 10, '', 0, 0); // Espaço vazio para alinhar
$pdf->Cell(95, 10, 'Aluguel, Condomínio e IPTU: -', 0, 1);
$pdf->Cell(95, 10, '', 0, 0); // Espaço vazio para alinhar
$pdf->Cell(95, 10, 'Propaganda e Marketing: -', 0, 1);
$pdf->Cell(95, 10, '', 0, 0); // Espaço vazio para alinhar
$pdf->Cell(95, 10, 'Pessoal: -', 0, 1);
$pdf->Cell(95, 10, '', 0, 0); // Espaço vazio para alinhar
$pdf->Cell(95, 10, 'Pro Labore: -', 0, 1);
$pdf->Cell(95, 10, '', 0, 0); // Espaço vazio para alinhar
$pdf->Cell(95, 10, 'Utilidades: -', 0, 1);
$pdf->Cell(95, 10, '', 0, 0); // Espaço vazio para alinhar
$pdf->Cell(95, 10, 'Despesas Financeiras: -', 0, 1);


// Fechar e gerar o PDF
$pdf->Output('fluxo_de_caixa.pdf', 'I'); // 'I' para abrir no navegador, 'D' para download