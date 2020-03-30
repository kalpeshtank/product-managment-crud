<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Employees;
use App\Model\Companies;
use App\Http\Requests\EmployeesStoreRequest;

class EmployeesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employees = Employees::paginate(10);
        return view('employees/list', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $companies = Companies::all();
        return view('employees/form', ['companies' => $companies, 'title' => 'Create Employees', 'button' => 'save']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesStoreRequest $request) {
        $emp_data = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone
        );
        Employees::updateOrCreate(['id' => $request->id], $emp_data);
        $massge = $request->id ? 'Employees Updated successfully.' : 'Employees Added successfully.';
        return redirect('employees')->with('success', $massge);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $employees = Employees::findOrFail($id);
        $companies = Companies::all();
        return view('employees/form', ['employees' => $employees, 'companies' => $companies, 'title' => 'Update Employees', 'button' => 'Update']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = Employees::findOrFail($id);
        $data->delete();
        return redirect('employees')->with('success', 'Employee is successfully deleted');
    }

}
