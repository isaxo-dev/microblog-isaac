<?php
class Conecta
{
    // Configurações do banco
    private static string $servidor = "localhost";
    private static string $banco = "microblog_isaac";
    private static string $usuario = "root";
    private static string $senha = "";

    // Instância única da conexão
    private static ?PDO $conexao = null;

    // Impede criação de instâncias da classe
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    // Método público para obter a conexão
    public static function getConexao(): PDO
    {
        if (self::$conexao === null) {
            try {
                self::$conexao = new PDO(
                    "mysql:host=" . self::$servidor . ";dbname=" . self::$banco . ";charset=utf8",
                    self::$usuario,
                    self::$senha
                );

                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $erro) {
                die("Erro ao conectar: " . $erro->getMessage());
            }
        }

        return self::$conexao;
    }
}

// Teste de conexão
Conecta::getConexao();