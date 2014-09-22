<?php

class ExpenseController extends BaseController {


    public function index(){
        return View::make('expense.index');
    }

    public function create(){
       return View::make('invoice.add');
    }

    public function store(){
        // store invoice data
        // $this->downloadPdf($invoiceKey);
    }

    public function show($id){

    }

    public function update($id){

    }

    public function destroy($id){

    }

    public function downloadPdf($invoiceId){
        // $invoiceData = get all data for the specific invoice id
        // $pdf = PDF::loadView('invoice.pdf', $invoiceData);
        // return $pdf->download('invoice.pdf');

    }


}
