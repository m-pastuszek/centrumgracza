<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function show($slug) {
        $company = Company::where('slug', $slug)->firstOrFail();
        return view('companies.show', compact('company'));
    }
}
