<?php

class EmployeeController extends BaseController {


    public function index(){
        return View::make('employee.index')->with('employees', Employee::all());
    }

    public function create(){
        return View::make('employee.add');
    }

    public function store(){
        $employeeData['id'] = str_random(50);
        $employeeData['name'] = Input::get('name');
        $employeeData['address'] = Input::get('address');
        $employeeData['referenceNumber'] = Input::get('referenceNumber');
        $employeeData['insuranceNumber'] = Input::get('insuranceNumber');
        $employeeData['dob'] = Input::get('dob');
        $employeeData['note'] = Input::get('note');


        $employee = new Employee();

        $result = $employee->addEmployee($employeeData);

        if($result == true) {
           return Redirect::to('employee')->with('message', 'The employee has been added.');
        }
        else{
            return Redirect::to('employee')->with('message', 'The employee could not be added.');
        }
    }

    public function show($id){
        $employeeData = Employee::find($id);
        $processedVehicles = InvoiceElement::where('employee_fk', '=', $employeeData->id)->count();

        $totalSalary = Employee::getSalary($id);
        $totalSum = 0;
        foreach($totalSalary as $item){
            $employeesCut = Vehicle::getEmployeesCut($item->vehicle_fk);
            $totalSum = $totalSum + ($employeesCut * $item->quantity);
        }

        return View::make('employee.profile')->with(['employeeData' => $employeeData,
                                                    'processedVehicles' => $processedVehicles,
                                                    'totalSum' => $totalSum]
                                                    );
    }

    public function edit($id){
        $employeeData = Employee::find($id);
        return View::make('employee.edit')->with('employeeData', $employeeData);
    }

    public function update($id){
        $employee = Employee::find($id);
        $employee->name = Input::get('name');
        $employee->address = Input::get('address');
        $employee->reference_number = Input::get('referenceNumber');
        $employee->insurance_number = Input::get('insuranceNumber');
        $employee->dob = Input::get('dob');
        $employee->note = Input::get('note');
        $employee->save();

        return $this->show($id);
    }

    public function destroy($id){
        $employee = Employee::find($id);
        $result = $employee->delete();
        if($result){
            return $this->index();
        }
        else{
            return $this->index();
        }
    }

    public function checkEarnings($id){

        $startDate = $start = Input::get('startDate');
        $endDate = $end = Input::get('endDate');

        $start = date('Y-m-d', strtotime($start));
        $end = date('Y-m-d', strtotime($end));

        // Get the owed sum for the given range.
        $salaryForRange = Employee::getSalaryRange($id, $start, $end);

        $rangeSum = 0;
        $rangeValetedVehicles = 0;
        foreach($salaryForRange as $item){

            $employeesCut = Vehicle::getEmployeesCut($item->vehicle_fk);

            $rangeSum = $rangeSum + ($employeesCut * $item->quantity);
            // Calculate the number of processed vehicles.
            $rangeValetedVehicles += $item->quantity;
        }

        $employeeData = Employee::find($id);
        $processedVehicles = InvoiceElement::where('employee_fk', '=', $employeeData->id)->count();

        $totalSalary = Employee::getSalary($id);


        // Get the rest of the information.
        $totalSum = 0;
        foreach($totalSalary as $item){
            $employeesCut = Vehicle::getEmployeesCut($item->vehicle_fk);

            $totalSum = $totalSum + ($employeesCut * $item->quantity);
        }

        return View::make('employee.profile')->with(['employeeData' => $employeeData,
                'processedVehicles' => $processedVehicles,
                'totalSum' => $totalSum,
                'rangeSum' => $rangeSum,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'rangeValetedVehicles' => $rangeValetedVehicles]
        );
    }

    public function displayEmployeeWages(){
        // If the start date is defined, get the salaries for that certain period, otherwise, get the total amount.
        if(null !== Input::get('startDate')){
            $start = date("Y-m-d", strtotime(Input::get('startDate')));
            $end = date("Y-m-d", strtotime(Input::get('endDate')));
        }
        else{
            $start = "1970-01-01";
            $end = "3000-01-01";

        }

        $wageList = [];
        $processedVehiclesList = Employee::getTotalSalaries($start, $end);
        $employeesList = Employee::getEmployeesList();
        $totalEmployeeWagesSum = 0;
        foreach($processedVehiclesList as $processed){
         // Initiliaze if not set.

            if(!isset($wageList[$processed->employee_fk])){
                $wageList[$processed->employee_fk] = 0;
            }

            $price = Vehicle::getEmployeesCut($processed->vehicle_fk);
            $total = $price * $processed->quantity;

            $wageList[$processed->employee_fk] += $total;
            $totalEmployeeWagesSum += $total;
        }
        //
        $employeeWages = [];
        foreach($wageList as $employeeId => $wage){
           foreach($employeesList as $id => $name){
               if($id == $employeeId){
                   $employeeWages[$name] = $wage;
               }
               if(!array_key_exists($id, $wageList)){
                   $employeeWages[$name] = 0;
               }
           }

        }
        arsort($employeeWages);
        $startDate = date("d/m/Y", strtotime($start));
        $endDate = date("d/m/Y", strtotime($end));

        return View::make('employee.table')->with(['employeeWages' => $employeeWages,
                                                    'totalEmployeeWages' => $totalEmployeeWagesSum,
                                                    'startDate' => $startDate,
                                                    'endDate' => $endDate]);
    }


}