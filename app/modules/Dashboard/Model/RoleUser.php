<?php 

namespace Dashboard\Model;

use Phalcon\Mvc\Model;

class RoleUser extends Model {

	private $id;
	private $role_id;
	private $user_id;

	private $created_at;
	private $updated_at;
	private $created_by;
	private $updated_by;

	public function initialize() {
        $this->skipAttributes(array('id','created_at','updated_at','created_by','updated_by'));
    }

	public function getId() { return $this->id; }
	public function setRoleId($role_id) { $this->role_id = $role_id; }
	public function getRoleId() { return $this->role_id; }
	public function setUserId($user_id) { $this->user_id = $user_id; }
	public function getUserId() { return $this->user_id; }

	public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }
    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; }
    public function setCreatedBy($created_by) { $this->created_by = $created_by; }
    public function getCreatedBy() { return $this->created_by; }
	public function setUpdatedBy($updated_by) { $this->updated_by = $updated_by; }
    public function getUpdatedBy() { return $this->updated_by; } 

}