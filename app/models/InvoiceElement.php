<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class InvoiceElement extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employees_vehicles';

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'employee_fk',
        'vehicle_fk',
        'invoice_fk',
        'date'
        );


    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');

    public function addElement($elementData){
        $this->employee_fk = $elementData['employee_fk'];
        $this->vehicle_fk = $elementData['vehicle_fk'];
        $this->invoice_fk = $elementData['invoice_fk'];
        $this->date = $elementData['date'];

        $result = $this->save();

        return $result;
    }

}
