<?php

use Illuminate\Database\Seeder;
use App\Appointment;
use App\User;
use Carbon\Carbon;

class AppointMentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = User::where('role_id',3)->get();

    	foreach ($users as $user) {
    		
        	Appointment::create([
        		'braider_id' => 26,
        		'user_id' => $user->id,
        		'full_name' => $user->name,
        		'email_id' => $user->email,
        		'phone' => $user->business_phone_number,
        		'schedule_date' => Carbon::today(),
        		'schedule_time' => date('h:i'),
        		'address' => 'abcd',
        		'zip_code' => '12345678',
        		'total_amount' => '80.00',
        		'paid_paid' => '20.00',
        		'due_amount' => '60.00',
        		'payment_status' => 'Paid',
        		'txn_id' => $user->name.$user->id,
        		'status' => 'Confirmed'
        	]);

    	}
    	foreach ($users as $user) {
    		
        	Appointment::create([
        		'braider_id' => 26,
        		'user_id' => $user->id,
        		'full_name' => $user->name,
        		'email_id' => $user->email,
        		'phone' => $user->business_phone_number,
        		'schedule_date' => Carbon::tomorrow(),
        		'schedule_time' => date('h:i'),
        		'address' => 'abcd',
        		'zip_code' => '12345678',
        		'total_amount' => '80.00',
        		'paid_paid' => '20.00',
        		'due_amount' => '60.00',
        		'payment_status' => 'Paid',
        		'txn_id' => $user->name.$user->id,
        		'status' => 'Confirmed'
        	]);

    	}
    }
}
