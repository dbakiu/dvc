<?php

class BalanceController extends BaseController {


    public function index()
    {
        $totalExpenses = Expense::getTotalExpenses();
        $totalIncome = Invoice::getTotalIncome();

        $totalBalance = $totalIncome - $totalExpenses;
        $totalBalance = number_format((float)$totalBalance, 2, '.', '');


        return View::make('balance.index')->with(['totalExpenses' => $totalExpenses,
                                                    'totalIncome' => $totalIncome,
                                                    'totalBalance' => $totalBalance]);
    }

    public function checkBalance(){
        $start = Input::get('startDate');
        $end = Input::get('endDate');

        $startDate = date('Y-m-d', strtotime($start));
        $endDate = date('Y-m-d', strtotime($end));

        $totalIncome = Invoice::getTotalIncomeFromTo($startDate, $endDate);
        $totalExpenses = Expense::getTotalExpensesFromTo($startDate, $endDate);
        $totalBalance = $totalIncome - $totalExpenses;
        $totalBalance = number_format((float)$totalBalance, 2, '.', '');

        return View::make('balance.index')->with(['totalExpenses' => $totalExpenses,
                                                    'totalIncome' => $totalIncome,
                                                    'totalBalance' => $totalBalance,
                                                    'startDate' => Input::get('startDate'),
                                                    'endDate' => Input::get('endDate')
                                                    ]);
    }

}
