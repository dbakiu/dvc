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
        $companyName = Input::get('companyName');
        $item = Input::get('item');
        $sum = floatval(Input::get('sum'));

        if(Input::get('vat_included') != 'yes') {
            $sum = $sum * 1.20;
        }

        $date = date('Y-m-d', strtotime(Input::get('date')));

        $expense = new Expense();
        $expenseData = [
                        'id' => $expenseId,
                        'expense_number' => $expenseNumber,
                        'company_name' => $companyName,
                        'item' => $item,
                        'sum' => $sum,
                        'date' => $date
                        ];

        $expense->addExpense($expenseData);

        return $this->index();
    }

    public function show($id){
        $expenseData = Expense::find($id);
        return View::make('expense.view')->with('expenseData', $expenseData);
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
