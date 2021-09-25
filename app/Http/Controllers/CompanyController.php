<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\State;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Company Class instance
     */
    private Company $company;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::sortable()
        ->filter($this->filterProps($request))
        ->search($this->searchProps(),$request->search)
        ->pagination($request);

        return view("company.view",compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        return view('company.add',compact('countries','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $this->company = new Company;
        return $this->props($request)
        ->uploadLogo($request)
        ->uploadHeaderImage($request)
        ->uploadFooterImage($request)
        ->save()
        ->redirect($request,'Created');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $countries = Country::all();
        $states = State::all();
        return view("company.edit",compact('company','countries','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $this->company = $company;
        return $this->props($request)
        ->uploadLogo($request)
        ->uploadHeaderImage($request)
        ->uploadFooterImage($request)
        ->save()
        ->redirect($request,'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return back()->withSuccess("Company is Deleted");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request)
    {
        Company::destroy(json_decode($request->ids));
        return back()->withSuccess("Company is Deleted");
    }

    /**
     * Set Props
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    private function props(Request $request):object
    {
        $this->company->name = $request->name;
        $this->company->address = $request->address;
        $this->company->city = $request->city;
        $this->company->state = $request->state;
        $this->company->country = $request->country;
        $this->company->phone = $request->phone;
        $this->company->phone_number = $request->phone_number;
        $this->company->email = $request->email;
        $this->company->website = $request->website;
        $this->company->gst_no = $request->gst_no;
        $this->company->state_code = $request->state_code;
        $this->company->pan_card = $request->pan_card;
        $this->company->note = $request->note;
        $this->company->zipcode = $request->zipcode;
        return $this;
    }
    /**
     * upload Logo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    private function uploadLogo(Request $request):object
    {
        if ($request->hasFile('logo')) {
            $this->company->logo = $request->logo->store("company",'public');
        }
        
        return $this;
    }
    /**
     * Upload Header Image
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    private function uploadHeaderImage(Request $request):object
    {
        if ($request->hasFile('header_image')) {
            $this->company->header_image = $request->header_image->store("company/header",'public');
        }
        
        return $this;
    }
    /**
     * Upload Footer Image
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    private function uploadFooterImage(Request $request):object
    {
        if ($request->hasFile('footer_image')) {
            $this->company->footer_image = $request->footer_image->store("company/footer",'public');
        }
        
        return $this;
    }
    /**
     * store the specified resource.
     *
     */
    private function save()
    {
        $this->company->save();
        return $this;
    }
    /**
     * Redirect Page
     *
     */
    private function redirect(Request $request,$message)
    {
        if ($request->has('update_and_cancel')) {

            return redirect()->route('company.index')->withSuccess("Company {$message}");     
        }
       
        return back()->withSuccess("Company {$message}");
    }
    /**
     * Set Search Props
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    private function searchProps():array
    {
        return [
            'name',
            'address',
            'city',
            'zipcode',
            'phone',
            'gst_no'
        ];
    }
    /**
     * Set Search Props
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    private function filterProps(Request $request)
    {
        return [
            "name" => $request->name ?? "",
            "address" => $request->address ?? "",
            "city" => $request->city ?? "",
            "zipcode" => $request->zipcode ?? "",
            "phone" => $request->mobile_number ?? "",
            "gst_no" => $request->gst_no ?? ""
        ];
    }
}
