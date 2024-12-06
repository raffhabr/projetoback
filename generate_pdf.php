<?php
require 'fpdf/fpdf.php'; // Inclua o arquivo FPDF

// Configuração do Banco de Dados
$host = 'localhost';
$dbname = 'forjfacul';
$username = 'root';
$password = '';

try {
    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca todos os usuários
    $sql = "SELECT i.usuario_id, i.Nome_Completo, i.E_mail, t.tipo_treino 
            FROM informacoes i 
            LEFT JOIN treinos t ON i.usuario_id = t.usuario_id";
    $stmt = $pdo->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Instancia o FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Cabeçalho do documento
$pdf->Cell(0, 10, 'Lista de Usuarios', 0, 1, 'C');
$pdf->Ln(10);

// Cabeçalho da tabela
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(70, 10, 'Nome', 1);
$pdf->Cell(50, 10, 'Email', 1);
$pdf->Cell(50, 10, 'Treino', 1);
$pdf->Ln();

// Preenche a tabela com os dados
$pdf->SetFont('Arial', '', 12);
foreach ($usuarios as $usuario) {
    $pdf->Cell(20, 10, $usuario['usuario_id'], 1);
    $pdf->Cell(70, 10, $usuario['Nome_Completo'], 1);
    $pdf->Cell(50, 10, $usuario['E_mail'], 1);
    $pdf->Cell(50, 10, $usuario['tipo_treino'] ?? 'Nenhum treino', 1);
    $pdf->Ln();
}

// Envia o PDF para download
$pdf->Output('D', 'usuarios.pdf');
?>
