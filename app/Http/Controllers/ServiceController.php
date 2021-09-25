<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Str;

class ServiceController extends Controller
{
    public function __construct(private Service $service){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = $this->service->sortable()
        ->filter($this->filterProps($request))
        ->search($this->searchProps(),$request->search)
        ->pagination($request);

        return view("service.view",compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("service.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$request->validate([
    		'title' => ['required','min:3','max:255'],
    		'sorting' => ['required','numeric','unique:services'],
    		'image' => ['required','image']
    	]);
        return $this->props($request)
        ->save()
        ->redirect($request,'Created');
    }
    /**
     * Set Props
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    private function props(Request $request):object
    {
        $this->service->title = $request->title;
        $this->service->slug = Str::slug($request->title);
        $this->service->sorting = $request->sorting;
        
        if ($request->hasFile('image')) {
        	
        	$this->service->image = $request->image->store('service','public');
        }
        return $this;
    }
    /**
     * store the specified resource.
     *
     */
    private function save()
    {
        $this->service->save();
        return $this;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view("service.edit",compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
    	$request->validate([
    		'title' => ['required','min:3','max:255'],
    		'sorting' => ['required','numeric','unique:services,sorting,'.$service->uuid.',uuid'],
    		'image' => ['nullable','image']
    	]);

        $this->service = $service;
        return $this->props($request)
        ->save()
        ->redirect($request,'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->withSuccess("Service is Deleted");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request)
    {
        Service::destroy(json_decode($request->ids));
        return back()->withSuccess("Service is Deleted");
    }
     /**
     * Redirect Page
     *
     */
    private function redirect(Request $request,$message)
    {
        if ($request->has('update_and_cancel')) {

            return redirect()->route('services.index')->withSuccess("Service {$message}");     
        }
       
        return back()->withSuccess("Service {$message}");
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
            'title',
            'sorting'
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
            "title" => $request->title ?? "",
            "sorting" => $request->sorting ?? "",
        ];
    }
}
