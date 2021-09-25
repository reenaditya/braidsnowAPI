<?php

namespace App\Http\Controllers;

use App\User;
use App\State;
use App\Country;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private User $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('state')
        ->sortable()
        ->filter($this->filterProps($request))
        ->search($this->searchProps(),$request->search)
        ->whereRoleId(1)
        ->pagination($request);

        return view("user.view",compact('users'));
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
        $groups = Group::all();
        return view("user.add",compact('countries','states','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->user = new User;
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
        $this->user->user_type = $request->user_type;
        $this->user->group_id = $request->group_id;
        $this->user->name = $request->name;
        $this->user->display_name = $request->display_name;
        $this->user->address = $request->address;
        $this->user->city = $request->city;
        $this->user->zip_code = $request->zip_code;
        $this->user->state_id = $request->state;
        $this->user->country = $request->country;
        $this->user->mobile_number = $request->mobile_number;
        $this->user->alternate_mobile_number = $request->alternate_mobile_number;
        $this->user->gst_no = $request->gst_no;
        $this->user->state_code = $request->state_code;
        $this->user->pancard = $request->pancard;
        $this->user->shipping_address = $request->shipping_address;
        $this->user->shipping_mobile = $request->shipping_mobile;
        $this->user->is_active = true;
        $this->user->role_id = 1;
        return $this;
    }
    /**
     * store the specified resource.
     *
     */
    private function save()
    {
        $this->user->save();
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
    public function edit(User $user)
    {
        $countries = Country::all();
        $states = State::all();
        $groups = Group::all();
        return view("user.edit",compact('user','countries','states','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->user = $user;
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
    public function destroy(User $user)
    {
        $user->delete();
        return back()->withSuccess("Customer is Deleted");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request)
    {
        User::destroy(json_decode($request->ids));
        return back()->withSuccess("User is Deleted");
    }
     /**
     * Redirect Page
     *
     */
    private function redirect(Request $request,$message)
    {
        if ($request->has('update_and_cancel')) {

            return redirect()->route('user.index')->withSuccess("Customer {$message}");     
        }
       
        return back()->withSuccess("Customer {$message}");
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
           // 'email',
            'mobile_number',
            'address',
            'city',
            'state.name'
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
            //"email" => $request->email ?? "",
            "mobile_number" => $request->mobile_number ?? "",
            "address" => $request->address,
            "city" => $request->city,
            "state.name" => $request->state,
            "user_type" => $request->user_type

        ];
    }
}
