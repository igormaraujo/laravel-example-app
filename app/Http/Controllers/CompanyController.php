<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index',['companies' => Company::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create', ['company' => new Company()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->validated());
        return redirect('/')->with('success', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
      $employees = $company->employees()->paginate(10);
      return view('company.show', ['company' => $company, 'employees' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company\  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.create', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $oldImage = $company->logo;
        $company->update($request->validated());
        if( $oldImage && Storage::exists($oldImage) ) {
            Storage::delete($oldImage);
        }
        return redirect('/')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $oldImage = $company->logo;
        $company->delete();
        if( $oldImage && Storage::exists($oldImage) ) {
            Storage::delete($oldImage);
        }
        return redirect('/')->with('success', 'Company deleted successfully');
    }
}
