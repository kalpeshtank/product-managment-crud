<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EmployeesStoreRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request) {
        $validation = ['last_name' => 'required', 'company' => 'required'];
        $validation['first_name'] = $request->id ? 'required|unique:employees,first_name,' . $request->id : 'required|unique:employees,first_name';
        if (isset($request->email))
            $validation['email'] = 'email';
        if (isset($request->phone))
            $validation['phone'] = 'numeric';
        return $validation;
    }

}
