<?php

class EmployeeController extends BaseController {


    public function index()
    {
        return View::make('employee.index');
    }

    public function create(){
        return View::make('employee.add');
    }

    public function store(){

    }

    public function show($id){

    }
}
