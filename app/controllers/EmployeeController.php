<?php

class EmployeeController extends BaseController {


    public function index()
    {
        return View::make('employee.index');
    }

}
