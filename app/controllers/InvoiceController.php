<?php

class InvoiceController extends BaseController {


    public function index()
    {
        return View::make('invoice.index');
    }

    public function create(){
        return View::make('invoice.add');
    }

    public function store(){
        // TODO
        // Add storing and pdf output
    }

    public function show($id){

    }

    public function update($id){

    }

    public function destroy($id){

    }


}
