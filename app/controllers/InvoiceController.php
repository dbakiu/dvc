<?php

class InvoiceController extends BaseController {


    public function index(){
        $invoiceList = Invoice::orderBy('date', 'desc')->paginate(12);

        return View::make('invoice.index')->with('invoiceList', $invoiceList);
    }

    public function create(){
        $vehiclesList = Vehicle::getVehiclesList();
        $vehiclesPricelist = Vehicle::getVehiclesPricelist();
        $employeesList = Employee::getEmployeesList();
        $invoiceNumber = Invoice::getNewInvoiceNumber();

        return View::make('invoice.add')->with(['vehiclesList' => $vehiclesList,
                                                'vehiclesPricelist' => $vehiclesPricelist,
                                                'employeesList' => $employeesList,
                                                'invoiceNumber' => $invoiceNumber]);
    }

    public function store(){
        $invoiceId = str_random(50);

        $invoiceElementsList = Input::get('elements_list');
        $invoiceElementsList = json_decode($invoiceElementsList, true);

        $vehiclePrice = 0;
        $subtotal = 0;
        foreach( $invoiceElementsList as $element ){

            $newDate = date("Y-m-d", strtotime($element['date']));

            $elementData = ['employee_fk' => Input::get('employee_fk'),
                            'vehicle_fk' => $element['vehicle_fk'],
                            'date' => $newDate,
                            'invoice_fk' => $invoiceId
                            ];
            $vehiclePrice = Vehicle::getPriceForVehicle($element['vehicle_fk']);

            for($i = 0; $i < $element['quantity']; $i++) {
                $invoiceElement = new InvoiceElement();
                $invoiceElement->addElement($elementData);
                $subtotal += $vehiclePrice;
            }
        }

        $total = $subtotal * 1.20;


        $newInvoice = new Invoice();

        $newInvoiceDate = date("Y-m-d", strtotime(Input::get('date')));
        $invoiceData = ['id' => $invoiceId,
            'invoice_number' => Input::get('invoice_number'),
            'bill_to' => Input::get('bill_to'),
            'date' => $newInvoiceDate,
            'employee_fk' => Input::get('employee_fk'),
            'subtotal' => $subtotal,
            'total' => $total
        ];

        $newInvoice->addInvoice($invoiceData);

        return $this->index();

    }

    public function show($id){
        $invoiceInfo = Invoice::find($id);
        $invoiceElements = InvoiceElement::getInvoiceElements($id);

        $employeeInfo = Employee::find($invoiceElements[0]->employee_fk);

        $elementData = [];

        foreach($invoiceElements as $element){
            $price = Vehicle::where('id', '=', $element->vehicle_fk)->pluck('price');
            $type = Vehicle::where('id', '=', $element->vehicle_fk)->pluck('type');

            $elementData[$element->vehicle_fk] = ['type' => $type,
                'price' => $price];
        }

        return View::make('invoice.web', ['invoiceInfo' => $invoiceInfo,
            'invoiceElements' => $invoiceElements,
            'elementData' => $elementData,
            'employeeInfo' => $employeeInfo]);
    }


    public function update($id){

    }

    public function destroy($id){
        $targetInvoice = Invoice::find($id);
        if($targetInvoice){
            $targetInvoice->delete();
            InvoiceElement::where('invoice_fk', '=', $id)->delete();
            return $this->index();
         }
        else{
            return $this->index();
        }
    }

    public function download($id){
        $invoiceInfo = Invoice::find($id);
        $invoiceElements = InvoiceElement::getInvoiceElements($id);

        $employeeInfo = Employee::find($invoiceElements[0]->employee_fk);

        $elementData = [];

        foreach($invoiceElements as $element){
            $price = Vehicle::where('id', '=', $element->vehicle_fk)->pluck('price');
            $type = Vehicle::where('id', '=', $element->vehicle_fk)->pluck('type');

            $elementData[$element->vehicle_fk] = ['type' => $type,
                'price' => $price];
        }


        $pdf = PDF::loadView('invoice.pdf', ['invoiceInfo' => $invoiceInfo,
                                            'invoiceElements' => $invoiceElements,
                                            'elementData' => $elementData,
                                            'employeeInfo' => $employeeInfo]);
         return $pdf->download($invoiceInfo->date . ' - ' . $invoiceInfo->bill_to . '.pdf');
    }
}
