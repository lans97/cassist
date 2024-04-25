<?php namespace App\Models;

class User {
    private $_id;
    private $_username;
    private $_mail;
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
    
    public function getId() {
        return $this->_id;
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
    
    public function getSuperUser() {
        return $this->_super_user;
    }
    
    public function setSuperUser($super_user) {
        $this->_super_user = $super_user;
    }
    
    public function getCreatedAt() {
        return $this->_created_at;
    }
    
    public function getUpdatedAt() {
        return $this->_updated_at;
    }

    public function toArray(){
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'mail' => $this->getMail(),
            'super_user' => $this->getSuperUser(),
            'created_at' => $this->getCreatedAt(),
            'updated_at'=> $this->getUpdatedAt()
        ];
    }
}