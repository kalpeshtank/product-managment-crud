<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Companies;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $companies = Companies::paginate(10);
        return view('companies/list', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('companies/form', ['title' => 'Create Companies', 'button' => 'save']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $requestVal = [];
        $requestVal['name'] = $request->id ? 'required|unique:companies,name,' . $request->id : 'required|unique:companies,name';
        if (isset($request->email))
            $requestVal['email'] = 'email';
        if (isset($request->website))
            $requestVal['website'] = 'regex:' . '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        if (!$request->id) {
            $requestVal['logo'] = 'required|image|dimensions:min_width=100,min_height=100';
        }
        $request->validate($requestVal);
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $new_name = Storage::disk('public')->put('', $image);
        }
        $company_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website
        );
        if ($request->file('logo')) {
            $company_data['logo'] = $new_name;
        }
        Companies::updateOrCreate(['id' => $request->id], $company_data);
        $massge = $request->id ? 'Company Updated successfully.' : 'Company Added successfully.';
        return redirect('companies')->with('success', $massge);
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
        $data = Companies::findOrFail($id);
        return view('companies/form', ['companies' => $data, 'title' => 'Update Companies', 'button' => 'Update']);
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
        $data = Companies::findOrFail($id);
        $data->delete();
        return redirect('companies')->with('success', 'Company is successfully deleted');
    }

}
