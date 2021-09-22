<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use App\Helpers\DatabaseChecker;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);

        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $website = $request->get('website');

        if (!$this->checkIfExist($request) && $this->isValid($request))
        {
            $company = Company::create([
                'name' => $name,
                'email' => $email,
                'logo' => $request->hasFile('logo') ? $request->logo->store('logos', 'public') : '',
                'website' => $website,
            ]);
            return redirect()
                ->route('companies.index')
                ->with('status','Company has been created successfully.');
        }
        return redirect()
            ->route('companies.index')
            ->with('status','A company is already having this email!');
    }

    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    public function update(Request $request, $id)
    {
        $checker = Company::where('email', '=', $request->get('email'))->first();

        if($checker !== null)
        {
            return redirect()
                ->route('companies.edit', $checker)
                ->with('status', 'A company is already created with this email!.');
        }

        $request->validate([
             'name' => 'required|max:25',
             'email' => 'required|email:rfc,dns',
             'logo' => 'required|mimes:jpg,png|dimensions:min_width=100,min_height=100',
             'website' => 'required|url',
        ]);

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        if($request->hasFile('logo')) {
            $path = $request->logo->store('public/logos');
        }
        $company->logo = $path;
        $company->website = $request->website;
        $company->save();

        return redirect()
            ->route('companies.index')
            ->with('success','Company Has Been updated successfully');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        Storage::delete('public/'.$company->logo);
        return redirect()
            ->route('companies.index')
            ->with('success','Company has been deleted successfully');
    }

    public function checkIfExist($request): bool
    {
        $checker = Company::where('email', '=', $request->get('email'))->first();

        return (bool)$checker;
    }

    public function isValid($request): bool
    {
        $valid = $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|email:rfc,dns',
            'logo' => 'required|mimes:jpg,png|dimensions:min_width=100,min_height=100',
            'website' => 'required|url'
        ]);
        return (bool)$valid;
    }
}
