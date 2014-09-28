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
        return View::make('employee.profile')->with(['employeeData' => $employeeData,
                                                    'processedVehicles' => $processedVehicles]
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

}