<?php namespace App\API\Handlers;
      use PDOException;

class MovementsHandler {
    private $_pdo;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
    }

    public function get_movements() {
        $query = "SELECT 
                    `id`,
                    `account`,
                    `category`,
                    `info`,
                    `ammount`,
                    `created_at`,
                    `updated_at`
                  FROM `movement`";
        $stmt = $this->_pdo->query($query);
        $movementsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $movements = [];
        foreach ($movementsData as $movementData) {
            $movement = new \App\Models\Movement($movementData['id'], $movementData['account'], $movementData['category'], $movementData['info'], $movementData['ammount'], $movementData['created_at'], $movementData['updated_at']);
            $movements[] = $movement->to_array();
        }
        return $movements;
    }

    public function get_movement($id) {
        $query = "SELECT 
                    `id`,
                    `account`,
                    `category`,
                    `info`,
                    `ammount`,
                    `created_at`,
                    `updated_at`
                  WHERE `id` = :id";
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $movementData = $stmt->fetch(\PDO::FETCH_ASSOC);

        $movement = new \App\Models\Movement($movementData['id'], $movementData['account'], $movementData['category'], $movementData['info'], $movementData['ammount'], $movementData['created_at'], $movementData['updated_at']);
        return $movement->to_array();
    }

    public function create_movement($movement) {
        $query = "INSERT INTO `movement`
                    (`id`,
                     `account`,
                     `category`,
                     `info`,
                     `ammount`,
                     `created_at`,
                     `updated_at`)
                  VALUES
                    (:id,
                     :account,
                     :category,
                     :info,
                     :ammount,
                     :created_at,
                     :updated_at)";
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([
            ':id' => $movement['id'],
            ':account' => $movement['account'],
            ':category' => $movement['category'],
            ':info' => $movement['info'],
            ':ammount' => $movement['ammount'],
            ':created_at' => $movement['created_at'],
            ':updated_at' => $movement['updated_at'],
        ]);

        $movementId = $this->_pdo->lastInsertId();
        return $this->get_movement($movementId);
    }

    public function update_movement($movement) {
        $query = "UPDATE TABLE `movement`
                    `account` = :account,
                    `category` = :category,
                    `info` = :info,
                    `ammount` = :ammount
                  WHERE `id` = :id";
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([
            ':account' => $movement['account'],
            ':category' => $movement['category'],
            ':info' => $movement['info'],
            ':ammount' => $movement['ammount'],
        ]);

        return $this->get_movement($movement['id']);
    }

    public function delete_movement($id) {
        try {
            $query = "DELETE FROM `movement`
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}