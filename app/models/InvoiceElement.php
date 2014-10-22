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

    public static function getInvoiceElements($id){
        return DB::select(DB::raw("SELECT vehicle_fk, employee_fk, date, COUNT(*) as quantity
                                  FROM employees_vehicles
                                  WHERE invoice_fk = '$id'
                                  AND deleted_at IS NULL
                                  GROUP BY vehicle_fk, date")
                        );
    }

    public static function getProcessedVehiclesForEmployee($id){
        return DB::select(DB::raw("SELECT vehicle_fk, date, COUNT(*) as quantity
                                  FROM employees_vehicles
                                  WHERE employee_FK = '$id'
                                  AND deleted_at IS NULL
                                  GROUP BY vehicle_fk ")
                        );
    }

    public static function getProcessedVehiclesForEmployeeFromTo($id, $start, $end){
        return DB::select(DB::raw("SELECT e_v.vehicle_fk, e_v.employee_fk, inv.date, COUNT(*) as quantity
                                    FROM employees_vehicles AS e_v, invoices AS inv
                                    WHERE e_v.employee_fk = '$id'
                                    AND inv.date >= '$start'
                                    AND inv.date <= '$end'
                                    AND inv.id = e_v.invoice_fk
                                    AND inv.deleted_at IS NULL
                                    GROUP BY e_v.vehicle_fk"));

    }

    public static function getProcessedVehiclesFromTo($start, $end){
        return DB::select(DB::raw("SELECT  e_v.employee_fk, e_v.vehicle_fk, inv.date, COUNT(*) as quantity
                                    FROM employees_vehicles AS e_v, invoices AS inv
                                    WHERE inv.date >= '$start'
                                    AND inv.date <= '$end'
                                    AND inv.id = e_v.invoice_fk
                                    AND inv.deleted_at IS NULL
                                    GROUP BY e_v.employee_fk, e_v.vehicle_fk"));

    }

    public static function getProcessedVehiclesSum($start, $end){
        $processedList = DB::select(DB::raw("SELECT e_v.vehicle_fk, COUNT(*) as quantity
                                    FROM employees_vehicles AS e_v, invoices AS inv, employees AS emp
                                    WHERE inv.date >= '$start'
                                    AND inv.date <= '$end'
                                    AND inv.id = e_v.invoice_fk
                                    AND inv.deleted_at IS NULL
                                    AND e_v.deleted_at IS NULL
                                    AND emp.deleted_at IS NULL
                                    GROUP BY e_v.vehicle_fk"));
        $totalSum = 0;
        foreach($processedList as $process){
            $price = Vehicle::getEmployeesCut($process->vehicle_fk);
            $total = $price * $process->quantity;
            $totalSum += $total;
        }

        return $totalSum;
    }

}

