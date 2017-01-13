<?php 

namespace Dashboard\Model;

use Phalcon\Mvc\Model;

class UserToken extends Model {

	private $id;
	private $user_id;
	private $token;
	private $created_at;
	private $updated_at;

	public function initialize() {
        //$this->hasMany("id", $this->foreign, "foreign_id");
        $this->skipAttributes(array('id','created_at','updated_at'));
    }

	public function getId() { return $this->id; }
	public function setUserId($user_id) { $this->user_id = $user_id; }
	public function getUserId() { return $this->user_id; }
	public function setToken($token) { $this->token = $token; }
	public function getToken() { return $this->token; }

	public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }
    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; } 

}