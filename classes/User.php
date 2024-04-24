<?php
class User {
    private $_id;
    private $_username;
    private $_mail;
    private $_password_hash;
    private $_salt;
    private $_created_at;


    public function __construct($username, $mail) {
        $this->_username = $username;
        $this->_mail = $mail;
    }
    
    public function getUsername() {
        return $this->_username;
    }

    public function setUsername($username) {
        $this->_username = $username;
    }

    public function getMail() {
        return $this->_mail;
    }

    public function setMail($mail) {
        $this->_mail = $mail;
    }
    
    public function toArray(){
        return [
            'username' => $this->_username,
            'mail' => $this->_mail
        ];
    }
}