<?php
namespace App\Models;

class Account {
    private $_id;
    private $_user;
    private $_nickname;
    private $_balance;
    private $_created_at;
    private $_updated_at;

    public function __construct($id, $user, $nickname, $balance, $created_at, $updated_at) {
        $this->_id = $id;
        $this->_user = $user;
        $this->_nickname = $nickname;
        $this->_balance = $balance;
        $this->_created_at = $created_at;
        $this->_updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function get_id() {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function get_user() {
        return $this->_user;
    }

    /**
     * @param mixed $_user 
     * @return self
     */
    public function set_user($_user): self {
        $this->_user = $_user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function get_nickname() {
        return $this->_nickname;
    }

    /**
     * @param mixed $_nickname 
     * @return self
     */
    public function set_nickname($_nickname): self {
        $this->_nickname = $_nickname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function get_balance() {
        return $this->_balance;
    }

    /**
     * @param mixed $_balance 
     * @return self
     */
    public function set_balance($_balance): self {
        $this->_balance = $_balance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function get_created_at() {
        return $this->_created_at;
    }

    /**
     * @return mixed
     */
    public function get_updated_at() {
        return $this->_updated_at;
    }

    public function to_array(): array {
        return [
            "id" => $this->get_id(),
            "user" => $this->get_user(),
            "nickname" => $this->get_nickname(),
            "balance" => $this->get_balance(),
            "created_at" => $this->get_created_at(),
            "updated_at" => $this->get_updated_at()
        ];
    }

}