<?php namespace App\Models;

class Movement {
    private $_id;
    private $_account;
    private $_category;
    private $_info;
    private $_ammount;
    private $_created_at;
    private $_updated_at;

	/**
	 * @param mixed $_id
	 * @param mixed $_account
	 * @param mixed $_category
	 * @param mixed $_info
	 * @param mixed $_ammount
	 * @param mixed $_created_at
	 * @param mixed $_updated_at
	 */
	public function __construct($_id, $_account, $_category, $_info, $_ammount, $_created_at, $_updated_at) {
		$this->_id = $_id;
		$this->_account = $_account;
		$this->_category = $_category;
		$this->_info = $_info;
		$this->_ammount = $_ammount;
		$this->_created_at = $_created_at;
		$this->_updated_at = $_updated_at;
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
	public function get_account() {
		return $this->_account;
	}
	
	/**
	 * @return mixed
	 */
	public function get_category() {
		return $this->_category;
	}
	
	/**
	 * @return mixed
	 */
	public function get_info() {
		return $this->_info;
	}
	
	/**
	 * @return mixed
	 */
	public function get_ammount() {
		return $this->_ammount;
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
	 * @param mixed $_category 
	 * @return self
	 */
	public function set_category($_category): self {
		$this->_category = $_category;
		return $this;
	}
	
	/**
	 * @param mixed $_info 
	 * @return self
	 */
	public function set_info($_info): self {
		$this->_info = $_info;
		return $this;
	}
	
	/**
	 * @param mixed $_ammount 
	 * @return self
	 */
	public function set_ammount($_ammount): self {
		$this->_ammount = $_ammount;
		return $this;
	}
    
    public function to_array(): array {
        return [
            "id" => $this->get_id(),
            "account" => $this->get_account(),
            "category" => $this->get_category(),
            "info"=> $this->get_info(),
            "ammount"=> $this->get_ammount(),
            "created_at"=> $this->get_created_at(),
            "updated_at"=> $this->get_updated_at(),
        ];
    }
}