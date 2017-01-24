<?php 

namespace Dashboard\Model;

use Phalcon\Mvc\Model;

class CompanySystem extends Model {

	private $id;
	private $company_id;
	private $system_id;

	private $created_at;
	private $updated_at;
	private $created_by;
	private $updated_by;

	public function initialize() {
        $this->skipAttributes(array('id','created_at','updated_at','created_by','updated_by'));

        $this->belongsTo(
        	"company_id",
        	"Company",
        	"id"
        );

        $this->belongsTo(
        	"system_id",
        	"Dashboard\\Model\\System",
        	"id",
            ['alias'=>'system']
        );
    }

	public function getId() { return $this->id; }
	public function setCompanyId($company_id) { $this->company_id = $company_id; }
	public function getCompanyId() { return $this->company_id; }
	public function setSystemId($system_id) { $this->system_id = $system_id; }
	public function getSystemId() { return $this->system_id; }

	public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }
    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; }
    public function setCreatedBy($created_by) { $this->created_by = $created_by; }
    public function getCreatedBy() { return $this->created_by; }
	public function setUpdatedBy($updated_by) { $this->updated_by = $updated_by; }
    public function getUpdatedBy() { return $this->updated_by; } 

}