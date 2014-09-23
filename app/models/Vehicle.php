<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Vehicle extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vehicles';

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'id',
        'type',
        'price',
        'employee_percentage');


    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');


    public function addVehicle($vehicleData){
        $this->id = $vehicleData['id'];
        $this->type = $vehicleData['type'];
        $this->price = $vehicleData['price'];
        $this->employee_percentage = $vehicleData['employee_percentage'];
        $result = $this->save();

        return $result;
    }

    public static function getVehiclesList(){
        $vehicleList = Vehicle::orderBy('type', 'asc')->lists('type','id');
        return $vehicleList;
    }

    public static function getVehiclesPricelist(){
        $vehiclesPricelist = Vehicle::orderBy('type', 'asc')->lists('price', 'id');
        return $vehiclesPricelist;
    }


}
