<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Invoice extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'invoices';

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'id',
        'invoice_number',
        'bill_to',
        'date',
        'employee_fk',
        'subtotal',
        'total'
        );


    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');

    public static function getNewInvoiceNumber(){
        $lastInvoiceNumber = Invoice::orderBy('created_at', 'desc')->pluck('invoice_number');
        return $lastInvoiceNumber + 1;
    }

    public function addInvoice($invoiceData){
        $this->id = $invoiceData['id'];
        $this->invoice_number = $invoiceData['invoice_number'];
        $this->bill_to = $invoiceData['bill_to'];
        $this->date = $invoiceData['date'];
        $this->employee_fk = $invoiceData['employee_fk'];
        $this->subtotal = $invoiceData['subtotal'];
        $this->total = $invoiceData['total'];

        $result = $this->save();
        return $result;
    }

    public static function getTotalIncome(){
        $totalIncome = Invoice::all()->sum('total');
        return $totalIncome;
    }

    public static function getTotalIncomeFromTo($start, $end){
        $totalIncome = Invoice::where('date', '>=', $start)->where('date', '<=', $end)->sum('total');
        return $totalIncome;
    }


}
