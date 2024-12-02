<?php
require_once('../utils/conexao.php');
require_once('c:/xampp/htdocs/pi_gandara/vendor/tecnickcom/tcpdf/tcpdf.php');

// Criação do PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CERES - Financeiro');
$pdf->SetTitle('CERES - Financeiro - Movimentações Fiscais');
$dateTime = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
$pdf->SetHeaderData('', 0, 'CERES - Financeiro - Movimentações Fiscais', 'Gerado em: ' . $dateTime->format('d/m/Y H:i:s') . ' (Horário de Brasília)');
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 27, 15);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

// Definir cabeçalho e rodapé
$pdf->setHeaderData('', 0, 'Movimentações Fiscais', 'Relatório Gerado');
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// Definir fonte
$pdf->SetFont('helvetica', '', 12);

// Tabela para Saldo Inicial
$pdf->SetFont('helvetica', 'B', 12); // Definir fonte em negrito
$pdf->Cell(40, 10, 'Descrição', 1, 0, 'C'); // Centralizar
$pdf->Cell(40, 10, 'Valor', 1, 1, 'C'); // Centralizar e pular linha
$pdf->SetFont('helvetica', '', 12); // Voltar para fonte normal
$pdf->Cell(40, 10, 'Saldo Inicial', 1);
$pdf->Cell(40, 10, 'R$ 250.000,00', 1);
$pdf->Ln();

// Tabela para Movimentações Recentes
$pdf->Ln(10); // Espaço entre tabelas
$pdf->SetFont('helvetica', 'B', 12); // Definir fonte em negrito
$pdf->Cell(40, 10, 'Movimentações Recentes', 0, 1);
$pdf->Cell(40, 10, 'Descrição', 1, 0, 'C'); // Centralizar
$pdf->Cell(40, 10, 'Valor', 1, 1, 'C'); // Centralizar e pular linha
$pdf->SetFont('helvetica', '', 12); // Voltar para fonte normal
$pdf->Cell(40, 10, 'Entrada', 1);
$pdf->Cell(40, 10, 'R$ 12.000,00', 1);
$pdf->Ln();
$pdf->Cell(40, 10, 'Saída', 1);
$pdf->Cell(40, 10, 'R$ 6.500,00', 1);
$pdf->Ln();
$pdf->Cell(40, 10, 'Entrada', 1);
$pdf->Cell(40, 10, 'R$ 2.000,00', 1);
$pdf->Ln();

// Tabela para Histórico de Movimentações
$pdf->Ln(10); // Espaço entre tabelas
$pdf->SetFont('helvetica', 'B', 12); // Definir fonte em negrito
$pdf->Cell(40, 10, 'Histórico de Movimentações', 0, 1);
$pdf->Cell(40, 10, 'Data', 1, 0, 'C'); // Centralizar
$pdf->Cell(40, 10, 'Tipo', 1, 0, 'C'); // Centralizar
$pdf->Cell(40, 10, 'Valor', 1, 1, 'C'); // Centralizar e pular linha
$pdf->SetFont('helvetica', '', 12); // Voltar para fonte normal
$pdf->Cell(40, 10, '2023-02-20', 1);
$pdf->Cell(40, 10, 'Entrada', 1);
$pdf->Cell(40, 10, 'R$ 1.000,00', 1);
$pdf->Ln();
$pdf->Cell(40, 10, '2023-02-19', 1);
$pdf->Cell(40, 10, 'Saída', 1);
$pdf->Cell(40, 10, 'R$ 500,00', 1);
$pdf->Ln();
$pdf->Cell(40, 10, '2023-02-18', 1);
$pdf->Cell(40, 10, 'Entrada', 1);
$pdf->Cell(40, 10, 'R$ 2.000,00', 1);
$pdf->Ln();

// Fechar e gerar o arquivo PDF
$pdf->Output('movimentacoes_fiscais.pdf', 'I'); // 'I' para mostrar no navegador, 'D' para forçar download
