<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{


  /**
   * Show the form for creating a new resource.
   *
   * @param  \App\Models\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function create(Company $company)
  {
    return view('employee.create', ['employee' => new Employee(), 'company' => $company]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreEmployeeRequest  $request
   * @param  \App\Models\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function store(StoreEmployeeRequest $request, Company $company)
  {
    Employee::create($request->validated() + ['company_id' => $company->id]);
    return redirect()->route('company.show',['company' => $company->id])->with('success', 'Employee created successfully');
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function edit(Employee $employee)
  {
    return view('employee.create', ['employee' => $employee, 'company' => $employee->company]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function update(StoreEmployeeRequest $request, Employee $employee)
  {
    $employee->update($request->validated());
    return redirect()->route('company.show',['company' => $employee->company_id])->with('success', 'Employee updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Employee  $employee
   * @return \Illuminate\Http\Response
   */
  public function destroy(Employee $employee)
  {
    $employee->delete();
    return redirect()->route('company.show',['company' => $employee->company_id])->with('success', 'Employee deleted successfully');
  }
}
