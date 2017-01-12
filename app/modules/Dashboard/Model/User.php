<?php 

namespace Dashboard\Model;

use Phalcon\Mvc\Model;
	
class User extends Model {
	
	private $id;
	private $name;
	private $email;
	private $pass;
	private $active;
	private $suspended;
	private $deleted;
	private $created_at;
	private $updated_at;
	private $created_by;
	private $updated_by;

	public function initialize() {
        //$this->hasMany("id", $this->foreign, "foreign_id");
        //$this->skipAttributes(array('id','created_at','updated_at','created_by','updated_by'));
    }

    public function getId() { return $this->id; }
	public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }
    public function setEmail($name) { $this->name = $name; }
    public function getEmail() { return $this->email; }
    public function setPass($pass) { $this->pass = $pass; }
    public function getPass() { return $this->pass; }
    public function setActive($active) { $this->active = $active; }
    public function getActive() { return $this->active; }
    public function setSuspended($suspended) { $this->suspended = $suspended; }
    public function getSuspended() { return $this->suspended; }
    public function setDeleted($deleted) { $this->deleted = $deleted; }
    public function getDeleted() { return $this->deleted; }
    
    public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }

    public function setCreatedBy($created_by) { $this->created_by = $created_by; }
    public function getCreatedBy() { return $this->created_by; }
	public function setUpdatedBy($updated_by) { $this->updated_by = $updated_by; }
    public function getUpdatedBy() { return $this->updated_by; }


}