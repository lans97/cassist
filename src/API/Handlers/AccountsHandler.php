<?php
namespace App\API\Handlers;
use PDOException;

class AccountsHandler {
    private $_pdo;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
    }

    public function get_accounts() {
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
    }

    public function get_account($id) {
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
    }

    public function create_account($account) {
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
    }

    public function update_account($account) {
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
    }
    
    public function delete_account($id) {
        try {
            $query = "DELETE FROM account
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}