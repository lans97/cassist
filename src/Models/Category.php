<?php
namespace App\Models;

class Category {
    private $_id;
    private $_name;
    private $_color;
    private $_user;

    /**
     * @param mixed $_id
     * @param mixed $_name
     * @param mixed $_color
     * @param mixed $_user
     */
    public function __construct($_id, $_name, $_color, $_user) {
    	$this->_id = $_id;
    	$this->_name = $_name;
    	$this->_color = $_color;
    	$this->_user = $_user;
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
    public function get_name() {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function get_color() {
        return $this->_color;
    }

    /**
     * @return mixed
     */
    public function get_user() {
        return $this->_user;
    }

    /**
     * @param mixed $_name 
     * @return self
     */
    public function set_name($_name): self {
        $this->_name = $_name;
        return $this;
    }

    /**
     * @param mixed $_color 
     * @return self
     */
    public function set_color($_color): self {
        $this->_color = $_color;
        return $this;
    }
    
    public function to_array(): array {
        return [
            "id"=> $this->_id,
            "name"=> $this->_name,
            "color"=> $this->_color,
            "user"=> $this->_user
        ];
    }
}