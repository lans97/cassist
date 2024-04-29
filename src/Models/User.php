<?php
namespace App\Models;

class User {
    private $_id;
    private $_username;
    private $_email;
    private $_super_user;
    private $_created_at;
    private $_updated_at;


    public function __construct($id, $username, $mail, $super_user, $created_at, $updated_at) {
        $this->_id = $id;
        $this->_username = $username;
        $this->_mail = $mail;
        $this->_super_user = $super_user;
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
    public function get_username() {
        return $this->_username;
    }

    /**
     * @return mixed
     */
    public function get_email() {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    public function get_super_user() {
        return $this->_super_user;
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

    /**
     * @param mixed $_username 
     * @return self
     */
    public function set_username($_username): self {
        $this->_username = $_username;
        return $this;
    }

    /**
     * @param mixed $_email 
     * @return self
     */
    public function set_email($_email): self {
        $this->_email = $_email;
        return $this;
    }

    /**
     * @param mixed $_super_user 
     * @return self
     */
    public function set_super_user($_super_user): self {
        $this->_super_user = $_super_user;
        return $this;
    }

    public function to_array() {
        return [
            'id' => $this->get_id(),
            'username' => $this->get_username(),
            'email' => $this->get_email(),
            'super_user' => $this->get_super_user(),
            'created_at' => $this->get_created_at(),
            'updated_at' => $this->get_updated_at()
        ];
    }
}