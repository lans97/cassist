<?php
namespace App\API\Handlers;

use PDOException;

class CategoriesHandler {
    private $_pdo;

    /**
     * @param mixed $_pdo
     */
    public function __construct($_pdo) {
        $this->_pdo = $_pdo;
    }

    public function get_categories() {
        $query = "SELECT 
                    `id`,
                    `name`,
                    `color`,
                    `user`,
                  FROM `movement_category`";
        $stmt = $this->_pdo->query($query);
        $categoriesData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($categoriesData as $categoryData) {
            $category = new \App\Models\Category($categoryData['id'], $categoryData['name'], $categoryData['color'], $categoryData['user']);
            $categories[] = $category->to_array();
        }
        return $categories;
    }

    public function get_category($id) {
        $query = "SELECT 
                    `id`,
                    `name`,
                    `color`,
                    `user`,
                  FROM `movement_category`
                  WHERE `id` = :id";
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $categoryData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $category = new \App\Models\Category($categoryData['id'], $categoryData['name'], $categoryData['color'], $categoryData['user']);
        return $category->to_array();
    }

    public function create_category($category) {
        $query = "INSERT INTO `category`
                    (`name`,
                     `color`,
                     `user`)
                  VALUES
                    (:name,
                     :color,
                     :user)";
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([
            ':name' => $category['name'],
            ':color' => $category['color'],
            ':user' => $category['user'],
        ]);

        $categoryId = $this->_pdo->lastInsertId();
        return $this->get_category($categoryId);
    }

    public function update_category($category) {
        $query = "UPDATE TABLE `category`
                    `name` = :name,
                    `color` = :color,
                    `user` = :user
                  WHERE `id` = :id";
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([
            ':name' => $category['name'],
            ':color' => $category['color'],
            ':user' => $category['user']
        ]);

        return $this->get_category($category['id']);
    }

    public function delete_category($id) {
        try {
            $query = "DELETE FROM `category`
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}