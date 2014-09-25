<?php

class InvoiceController extends BaseController {


    public function index(){
        $invoiceList = Invoice::all()->toArray();
        return View::make('invoice.index')->with('invoiceList', $invoiceList);
    }

    public function create(){
        $vehiclesList = Vehicle::getVehiclesList();
        $vehiclesPricelist = Vehicle::getVehiclesPricelist();
        $employeesList = Employee::getEmployeesList();
        $invoiceNumber = Invoice::getLastInvoiceNumber();
        $invoiceNumber = (int)$invoiceNumber + 1;

        return View::make('invoice.add')->with(['vehiclesList' => $vehiclesList,
                                                'vehiclesPricelist' => $vehiclesPricelist,
                                                'employeesList' => $employeesList,
                                                'invoiceNumber' => $invoiceNumber]);
    }

    public function store(){

        $newInvoice = new Invoice();

        $invoiceId = str_random(50);
        $invoiceData = ['id' => $invoiceId,
                        'invoice_number' => Input::get('invoice_number'),
                        'bill_to' => Input::get('bill_to'),
                        'date' => Input::get('date'),
                        'employee_fk' => Input::get('employee_fk')
                        ];
        $newInvoice->addInvoice($invoiceData);
        #$newInvoice->invoice_number = Input::get('invoice_number');
        #$newInvoice->bill_to = Input::get('bill_to');
        #$newInvoice->date = Input::get('date');
        #$newInvoice->employee_fk = Input::get('employee_fk');
        #$newInvoice->save();

        $invoiceElementsList = Input::get('elements_list');
        $invoiceElementsList = json_decode($invoiceElementsList, true);

        foreach( $invoiceElementsList as $element ){
            $invoiceElement = new InvoiceElement();
            $elementData = ['employee_fk' => Input::get('employee_fk'),
                            'vehicle_fk' => $element['vehicle_fk'],
                            'date' => $element['date'],
                            'invoice_fk' => $invoiceId
                            ];
            $invoiceElement->addElement($elementData);
            #$invoiceElement->employee_fk = Input::get('employee_fk');
            #$invoiceElement->vehicle_fk = $element['vehicle_fk'];
            #$invoiceElement->date = $element['date'];
            #$invoiceElement->invoice_fk = $invoiceId;
            #$invoiceElement->save();
        }

        return $this->index();

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
