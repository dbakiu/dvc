<?php

class EmployeeController extends BaseController {


    public function index(){
        return View::make('employee.index')->with('employees', Employee::all());
    }

    public function create(){
        return View::make('employee.add');
    }

    public function store(){
        $employeeData['name'] = Input::get('name');
        $employeeData['id'] = str_random(50);

        $employee = new Employee();

        $result = $employee->addEmployee($employeeData);

        if($result == true) {
            return $this->index();
        }
        else{
            return $this->index()->with('message', 'The employee could not be added');
        }
    }

    public function show($id){
        $employeeData = Employee::find($id);
        $processedVehicles = InvoiceElement::where('employee_fk', '=', $employeeData->id)->count();

        $totalSalary = Employee::getSalary($id);
        $totalSum = 0;
        foreach($totalSalary as $item){
            $employeesCut = Vehicle::getEmployeesCut($item->vehicle_fk);
            #echo $totalSum . ' + ' . $employeesCut . ' * ' . $item->quantity . ' = ' .($employeesCut * $item->quantity) .  '<br/>';
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
            $priceForVehicle = Vehicle::getPriceForVehicle($item->vehicle_fk);
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
           # $priceForVehicle = Vehicle::getPriceForVehicle($item->vehicle_fk);
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

}