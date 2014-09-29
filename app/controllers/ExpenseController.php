<?php

class ExpenseController extends BaseController {


    public function index(){
        $expenseList = Expense::orderBy('date', 'desc')->paginate(12);
        return View::make('expense.index')->with('expenseList', $expenseList);
    }

    public function create(){
        $expenseNumber = Expense::getNewExpenseNumber();
        return View::make('expense.add')->with('expenseNumber', $expenseNumber);
    }

    public function store(){

        $expenseId = str_random(50);
        $expenseNumber = Expense::getNewExpenseNumber();
        $item = Input::get('item');
        $sum = floatval(Input::get('sum'));
        $date = date('Y-m-d', strtotime(Input::get('date')));

        $expense = new Expense();
        $expenseData = [
                        'id' => $expenseId,
                        'expense_number' => $expenseNumber,
                        'item' => $item,
                        'sum' => $sum,
                        'date' => $date
                        ];

        $expense->addExpense($expenseData);

        return $this->index();
    }

    public function destroy($id){
        $targetExpense = Expense::find($id);
        if($targetExpense){
            $targetExpense->delete();
            return $this->index();
        }
        else{
            return $this->index();
        }
    }
}
