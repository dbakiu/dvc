<?php

class VehicleController extends BaseController {


    public function index(){
        return View::make('vehicle.index')->with('vehicles', Vehicle::all());
    }

    public function create(){
        return View::make('vehicle.add');
    }

    public function store(){
        $vehicleData['id'] = str_random(50);

        $vehicleData['type'] = Input::get('type');

        if(is_numeric(Input::get('price'))) {
            $price = Input::get('price');
            $vehicleData['price'] = number_format((float)$price, 2, '.', ''); // Round to the nearest second decimal.
        }
        else{
            $vehicleData['price'] = 0;
        }

        if(is_numeric(Input::get('employee_percentage'))){

            if(Input::get('employee_percentage') > 100){
                $percentage = 100;
                $vehicleData['employee_percentage'] = $percentage;
            }
            else {
                $vehicleData['employee_percentage'] = Input::get('employee_percentage');
            }

        }
        else{
            $vehicleData['employee_percentage'] = 0;
        }


        $vehicle = new Vehicle();

        $result = $vehicle->addVehicle($vehicleData);

        if($result == true) {
            return $this->index();
        }
        else{
            return $this->index()->with('message', 'The vehicle could not be added');
        }
    }

    public function show($id){

    }

    public function edit($id){
        $vehicleData = Vehicle::find($id);
        return View::make('vehicle.edit')->with('vehicleData', $vehicleData);
    }

    public function update($id){
        $price = Input::get('price');
        $vehicle = Vehicle::find($id);
        $vehicle->type = Input::get('type');
        $vehicle->price = number_format((float)$price, 2, '.', '');
        $vehicle->employee_percentage = Input::get('employee_percentage');
        $vehicle->save();

        return $this->index();
    }

    public function destroy($id){
        $vehicle = Vehicle::find($id);
        $result = $vehicle->delete();
        if($result){
            return $this->index();
        }
        else{
            return $this->index();
        }
    }


}