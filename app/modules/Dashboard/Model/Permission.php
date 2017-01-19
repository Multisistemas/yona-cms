<?php 

namespace Dashboard\Model;

use Phalcon\Mvc\Model;

class Permission extends Model {

	private $id;
	private $name;
	private $module;
	private $description;
	private $created_at;
	private $updated_at;
	private $created_by;
	private $updated_by;

	public function initialize() {
        $this->skipAttributes(array('id','created_at','updated_at','created_by','updated_by'));

        $this->hasMany(
            "id",
            "RolePermission",
            "permission_id"
        );
    }

	public function getId() { return $this->id; }
	public function setName($name) { $this->name = $name; }
	public function getName() { return $this->name; }
	public function setModule($module) { $this->module = $module; }
	public function getModule() { return $this->module; }
	public function setDescription($description) { $this->description = $description; }
	public function getDescription() { return $this->description; }

	public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }
    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; }
    public function setCreatedBy($created_by) { $this->created_by = $created_by; }
    public function getCreatedBy() { return $this->created_by; }
	public function setUpdatedBy($updated_by) { $this->updated_by = $updated_by; }
    public function getUpdatedBy() { return $this->updated_by; } 

}