<?php

class InvoiceController extends BaseController {


    public function index(){
        return View::make('invoice.index');
    }

    public function create(){
        $vehiclesList = Vehicle::getVehiclesList();
        $vehiclesPricelist = Vehicle::getVehiclesPricelist();
        $employeesList = Employee::getEmployeesList();

        return View::make('invoice.add')->with(['vehiclesList' => $vehiclesList, 'vehiclesPricelist' => $vehiclesPricelist, 'employeesList' => $employeesList]);
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
