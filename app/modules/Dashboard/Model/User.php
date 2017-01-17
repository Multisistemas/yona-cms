<?php 

namespace Dashboard\Model;

use Phalcon\Mvc\Model;
use stdClass;

class User extends Model {
	
	private $id;
	private $name;
	private $email;
	private $pass;
	private $active;
	private $suspended;
	private $deleted;
    private $session_type;
	private $created_at;
	private $updated_at;
	private $created_by;
	private $updated_by;

	public function initialize() {
        $this->skipAttributes(array('id','created_at','updated_at','created_by','updated_by'));
    }

    public function getId() { return $this->id; }

	public function setName($name) { $this->name = $name; }

    public function getName() { return $this->name; }

    public function setEmail($email) { $this->email = $email; }

    public function getEmail() { return $this->email; }

    public function getPass() { return $this->pass; }

    public function setPass($pass) {
        if ($pass) {
            $this->pass = password_hash($pass, PASSWORD_DEFAULT);
        }
    }

    public function isActive() {
        if ($this->active) {
            return true;
        }
    }

    public function getAuthData() {
        $authData = new stdClass();
        $authData->id = $this->getId();
        $authData->session_type = $this->getSessionType();
        $authData->name = $this->getName();
        $authData->email = $this->getEmail();
        
        return $authData;
    }

    public function checkPassword($password) {
        if (password_verify($password, $this->pass)) {
            return true;
        }
    }

    public function setActive($active) { $this->active = $active; }

    public function getActive() { return $this->active; }

    public function setSuspended($suspended) { $this->suspended = $suspended; }

    public function getSuspended() { return $this->suspended; }

    public function setDeleted($deleted) { $this->deleted = $deleted; }

    public function getDeleted() { return $this->deleted; }

    public function setSessionType($session_type) { $this->session_type = $session_type; }

    public function getSessionType() { return $this->session_type; }

    public function getCreatedAt() { return $this->created_at; }

    public function getUpdatedAt() { return $this->updated_at; }

    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; }

    public function setCreatedBy($created_by) { $this->created_by = $created_by; }

    public function getCreatedBy() { return $this->created_by; }

	public function setUpdatedBy($updated_by) { $this->updated_by = $updated_by; }

    public function getUpdatedBy() { return $this->updated_by; }


}