<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Expense extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'expenses';

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'expense_number',
        'company_name',
        'item',
        'date',
        'sum'
        );


    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');

    public function addExpense($expenseData){
        $this->id = $expenseData['id'];
        $this->expense_number = $expenseData['expense_number'];
        $this->company_name = $expenseData['company_name'];
        $this->item = $expenseData['item'];
        $this->sum = $expenseData['sum'];
        $this->date = $expenseData['date'];
        $result = $this->save();
        return $result;
    }

    public static function getNewExpenseNumber(){
        $lastExpenseNumber = Expense::orderBy('created_at', 'desc')->pluck('expense_number');
        return $lastExpenseNumber+1;
    }

    public static function getTotalExpenses(){
        $totalExpenses = Expense::all()->sum('sum');
        return $totalExpenses;
    }

    public static function getTotalExpensesFromTo($start, $end){
        $totalExpenses = Expense::where('date', '>=', $start)->where('date', '<=', $end)->sum('sum');
        return $totalExpenses;
    }

}

