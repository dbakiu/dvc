<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDvcDatabase extends Migration {

        /**
         * Run the migrations.
         *
         * @return void
         */
         public function up()
         {
            
	    /**
	     * Table: employees
	     */
	    Schema::create('employees', function($table) {
                $table->increments('id', 50);
                $table->string('name', 255);
                $table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('updated_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('deleted_at')->nullable();
                $table->string('remember_token', 255);
                $table->index('id');
            });


	    /**
	     * Table: employees_vehicles
	     */
	    Schema::create('employees_vehicles', function($table) {
                $table->increments('id');
                $table->string('employee_fk', 50);
                $table->string('vehicle_fk', 50);
                $table->string('invoice_fk', 50)->nullable();
                $table->date('date');
                $table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('updated_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('deleted_at')->nullable();
                $table->string('remember_token', 255);
            });


	    /**
	     * Table: expenses
	     */
	    Schema::create('expenses', function($table) {
                $table->string('id', 50);
                $table->increments('expense_number');
                $table->string('company_name', 255);
                $table->string('item', 255);
                $table->decimal('sum', 10,2);
                $table->date('date');
                $table->dateTime('created_at')->default("CURRENT_TIMESTAMP");
                $table->dateTime('updated_at')->default("CURRENT_TIMESTAMP");
                $table->dateTime('deleted_at')->nullable();
                $table->string('remember_token', 255);
                $table->index('id');
            });


	    /**
	     * Table: invoices
	     */
	    Schema::create('invoices', function($table) {
                $table->string('id', 50);
                $table->increments('invoice_number');
                $table->string('bill_to', 255);
                $table->date('date');
                $table->string('employee_fk', 50);
                $table->decimal('subtotal', 10,2);
                $table->decimal('total', 10,2);
                $table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('updated_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('deleted_at')->nullable();
                $table->string('remember_token', 255);
                $table->index('id');
            });


	    /**
	     * Table: users
	     */
	    Schema::create('users', function($table) {
                $table->increments('id', 50);
                $table->string('name', 255);
                $table->string('password', 255);
                $table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('updated_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('deleted_at')->nullable();
                $table->string('remember_token', 100);
                $table->index('id');
            });


	    /**
	     * Table: vehicles
	     */
	    Schema::create('vehicles', function($table) {
                $table->increments('id', 50);
                $table->string('type', 255);
                $table->decimal('price', 10,2);
                $table->decimal('employee_percentage', 10,2);
                $table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('updated_at')->default("CURRENT_TIMESTAMP");
                $table->timestamp('deleted_at')->nullable();
                $table->string('remember_token', 255);
                $table->index('id');
            });


         }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
         public function down()
         {
            
	            Schema::drop('employees');
	            Schema::drop('employees_vehicles');
	            Schema::drop('expenses');
	            Schema::drop('invoices');
	            Schema::drop('users');
	            Schema::drop('vehicles');
         }

}