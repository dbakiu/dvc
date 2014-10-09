<?php

class BalanceController extends BaseController {


    public function index()
    {
        $totalExpenses = Expense::getTotalExpenses();
        $totalExpensesVat = $totalExpenses * 0.20;

        $totalIncome = Invoice::getTotalIncome();
        $totalIncomeVat = $totalIncome * 0.20;

        $totalBalance = $totalIncome - $totalExpenses;
        $totalBalance = number_format((float)$totalBalance, 2, '.', '');


        return View::make('balance.index')->with(['totalExpenses' => $totalExpenses,
                                                    'totalIncome' => $totalIncome,
                                                    'totalIncomeVat' => $totalIncomeVat,
                                                    'totalExpensesVat' => $totalExpensesVat,
                                                    'totalBalance' => $totalBalance]);
    }

    public function checkBalance(){
        $start = Input::get('startDate');
        $end = Input::get('endDate');

        $startDate = date('Y-m-d', strtotime($start));
        $endDate = date('Y-m-d', strtotime($end));

        $totalIncome = Invoice::getTotalIncomeFromTo($startDate, $endDate);
        $totalIncomeVat = $totalIncome * 0.20;

        $totalExpenses = Expense::getTotalExpensesFromTo($startDate, $endDate);
        $totalExpensesVat = $totalExpenses * 0.20;

        $totalBalance = $totalIncome - $totalExpenses;
        $totalBalance = number_format((float)$totalBalance, 2, '.', '');
        dd($totalExpensesVat);
        return View::make('balance.index')->with(['totalExpenses' => $totalExpenses,
                                                    'totalIncome' => $totalIncome,
                                                    'totalBalance' => $totalBalance,
                                                    'totalIncomeVat' => $totalIncomeVat,
                                                    'totalExpensesVat' => $totalExpensesVat,
                                                    'startDate' => Input::get('startDate'),
                                                    'endDate' => Input::get('endDate')
                                                    ]);
    }

}
