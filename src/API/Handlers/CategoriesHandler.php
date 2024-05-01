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
        try {
            $query = "SELECT 
                    `id`,
                    `name`,
                    `color`,
                    `user`
                  FROM `movement_category`";
            $stmt = $this->_pdo->query($query);
            $categoriesData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($categoriesData === false) {
                throw new \Exception('No categoires in database');
            }

            $categories = [];
            foreach ($categoriesData as $categoryData) {
                $category = new \App\Models\Category($categoryData['id'], $categoryData['name'], $categoryData['color'], $categoryData['user']);
                $categories[] = $category->to_array();
            }
            return $categories;
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function get_category($id) {
        try {
            $query = "SELECT 
                    `id`,
                    `name`,
                    `color`,
                    `user`
                  FROM `movement_category`
                  WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([':id' => $id]);
            $categoryData = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (empty($categoryData)) {
                throw new \Exception('Category not found');
            }

            $category = new \App\Models\Category($categoryData['id'], $categoryData['name'], $categoryData['color'], $categoryData['user']);
            return $category->to_array();
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }
    
    public function get_categories_by_user($id) {
        try {
            $query = "SELECT 
                    `id`,
                    `name`,
                    `color`,
                    `user`
                  FROM `movement_category`
                  WHERE `user` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([':id' => $id]);
            $categoriesData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($categoriesData === false) {
                throw new \Exception('User has no categories');
            }

            $categories = [];
            foreach ($categoriesData as $categoryData) {
                $category = new \App\Models\Category($categoryData['id'], $categoryData['name'], $categoryData['color'], $categoryData['user']);
                $categories[] = $category->to_array();
            }
            return $categories;
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function create_category($category) {
        try {
            $query = "INSERT INTO `movement_category`
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
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function update_category($category) {
        try {
            $this->get_category($category['id']);
            $query = "UPDATE `movement_category`
                      SET
                        `name` = :name,
                        `color` = :color,
                        `user` = :user
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([
                ':name' => $category['name'],
                ':color' => $category['color'],
                ':user' => $category['user'],
                ':id' => $category['id'],
            ]);

            return $this->get_category($category['id']);
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function delete_category($id) {
        try {
            $this->get_category($id);
            $query = "DELETE FROM `movement_category`
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}