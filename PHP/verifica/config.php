<?php
// Este arquivo contém as configurações necessárias para o sistema de login funcionar corretamente.

// Variáveis da conexão
$base_dados  = 'sensores';
$usuario_bd  = 'root';
$senha_bd    = null;
$host_db     = 'localhost:3333';
$charset_db  = 'UTF8';
$conexao_pdo = null;

// Concatenação das variáveis para detalhes da classe PDO
$detalhes_pdo  = 'mysql:host=' . $host_db . ';';
$detalhes_pdo .= 'dbname='. $base_dados . ';';
$detalhes_pdo .= 'charset=' . $charset_db . ';';

// Tenta conectar
try {
    // Cria a conexão PDO com a base de dados
    $conexao_pdo = new PDO($detalhes_pdo, $usuario_bd, $senha_bd);
} catch (PDOException $e) {
    // Se der algo errado, mostra o erro PDO
    print "Erro: " . $e->getMessage() . "<br/>";
	
    die();
}
?>