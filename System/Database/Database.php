<?php
namespace System\Database;

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = require __DIR__ . '/../../App/Config/database.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset=utf8mb4";
        $user = $config['user'];
        $pass = $config['pass'];
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_PERSISTENT => true,
        ];
        $this->pdo = new \PDO($dsn, $user, $pass, $options);
        
        // Set timezone if configured
        // Note: Empty string check allows '0' as valid timezone offset
        if (isset($config['timezone']) && $config['timezone'] !== '') {
            try {
                $stmt = $this->pdo->prepare("SET time_zone = ?");
                $stmt->execute([$config['timezone']]);
            } catch (\PDOException $e) {
                throw new \InvalidArgumentException("Invalid timezone configuration '{$config['timezone']}': " . $e->getMessage());
            }
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public static function query($sql, $params = [])
    {
        $db = self::getInstance()->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Example: fetchAll
     */
    public function fetchAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Example: fetchOne
     */
    public function fetchOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    /**
     * Example: insert/update/delete
     */
    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }
}