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
        'name');


    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');


    public function addEmployee($employeeData){
        $this->name = $employeeData['name'];
        $this->id = $employeeData['id'];
        $result = $this->save();

        return $result;
    }

    public function updateEmployee($employeeData){

    }


}
