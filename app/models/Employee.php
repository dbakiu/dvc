<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Employee extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employees';

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'id',
        'name',
        'address',
        'reference_number',
        'insurance_number',
        'dob',
        'note');


    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');


    public function addEmployee($employeeData){
        $this->name = $employeeData['name'];
        $this->id = $employeeData['id'];
        $this->address = $employeeData['address'];
        $this->reference_number = $employeeData['referenceNumber'];
        $this->insurance_number = $employeeData['insuranceNumber'];
        $this->dob = $employeeData['dob'];
        $this->note = $employeeData['note'];
        $result = $this->save();

        return $result;
    }


    public static function getEmployeesList(){
        $employeesList = Employee::orderBy('name', 'asc')->lists('name','id');
        return $employeesList;
    }

    public static function getEmployeesObjectList(){
        $employeesList = Employee::orderBy('name', 'asc')->get();
        return $employeesList;
    }

    public static function getSalary($id){
        return InvoiceElement::getProcessedVehiclesForEmployee($id);
    }

    public static function getSalaryRange($id, $start, $end){
        return InvoiceElement::getProcessedVehiclesForEmployeeFromTo($id, $start, $end);
    }

    public static function getTotalSalaries($start, $end){
        return InvoiceElement::getProcessedVehiclesFromTo($start, $end);
    }

    public static function getTotalSalariesSum($start, $end){
        return InvoiceElement::getProcessedVehiclesSum($start, $end);
    }

}
