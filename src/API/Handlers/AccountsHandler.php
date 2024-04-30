<?php
namespace App\API\Handlers;

use PDOException;

class AccountsHandler {
    private $_pdo;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
    }

    public function get_accounts() {
        try {
            $query = "SELECT 
                    `id`,
                    `user`,
                    `nickname`,
                    `balance`,
                    `created_at`,
                    `updated_at`
                  FROM `account`";
            $stmt = $this->_pdo->query($query);
            $accountsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $accounts = [];
            foreach ($accountsData as $accountData) {
                $account = new \App\Models\Account($accountData['id'], $accountData['user'], $accountData['nickname'], $accountData['balance'], $accountData['created_at'], $accountData['updated_at']);
                $accounts[] = $account->to_array();
            }
            return $accounts;
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function get_account($id) {
        try {
            $query = "SELECT 
                    `id`,
                    `user`,
                    `nickname`,
                    `balance`,
                    `created_at`,
                    `updated_at`
                  FROM `account`
                  WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([':id' => $id]);
            $accountData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $account = new \App\Models\Account($accountData['id'], $accountData['user'], $accountData['nickname'], $accountData['balance'], $accountData['created_at'], $accountData['updated_at']);
            return $account->to_array();
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function create_account($account) {
        try {
            $query = "INSERT INTO `account`
                    (`user`,
                     `nickname`,
                     `balance`)
                  VALUES
                    (:user,
                     :nickname,
                     :balance)";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([
                ':user' => $account['user'],
                ':nickname' => $account['nickname'],
                ':balance' => $account['balance']
            ]);

            $accountId = $this->_pdo->lastInsertId();
            return $this->get_account($accountId);
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function update_account($account) {
        try {
            $this->get_account($account['id']);
            $query = "UPDATE TABLE `account`
                    `user` = :user,
                    `nickname` = :nickname,
                    `balance` = :balance
                  WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([
                ':user' => $account['user'],
                ':nickname' => $account['nickname'],
                ':balance' => $account['balance']
            ]);

            return $this->get_account($account['id']);
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function delete_account($id) {
        try {
            $this->get_account($id);
            $query = "DELETE FROM account
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