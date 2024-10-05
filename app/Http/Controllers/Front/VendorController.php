<?php

namespace App\Http\Controllers\Front;

use Validator;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class VendorController extends Controller
{
   public function login(){
    return view('front.vendors.login');
   }
   public function register(){
    return view('front.vendors.register');
   }

  public function vendorRegister(Request $request) {
    if($request->ajax()) {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'mobile' => 'required|string|digits:10|unique:vendors',
            'email' => 'required|email|max:150|unique:vendors|unique:admins',
            'password' => 'required|min:6',
            'accept' => 'required'
        ], [
            'accept.required' => 'Please accept our Terms & Conditions'
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();

            // Register the Vendor
            $vendor = new Vendor;
            $vendor->name = $data['name'];
            $vendor->mobile = $data['mobile'];
            $vendor->email = $data['email'];
            $vendor->status = 0; // Inactive until email confirmation
            $vendor->save();

            // Create Admin entry for the vendor
            $admin = new Admin;
            $admin->type = 'vendor';
            $admin->vendor_id = $vendor->id;
            $admin->name = $data['name'];
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->status = 0;
            $admin->save();

            // Send Confirmation Email
            $email = $data['email'];
            $messageData = ['name' => $data['name'], 'email' => $data['email'], 'code' => base64_encode($data['email'])];
            Mail::send('emails.vendor_confirmation', $messageData, function($message) use ($email) {
                $message->to($email)->subject('Confirm Your Vendor Account');
            });
            DB::commit();



            return response()->json(['type' => 'success', 'message' => 'Please confirm your email to activate your account!']);
        } else {
            return response()->json(['type' => 'error', 'errors' => $validator->messages()]);
        }
    }
}
  public function confirmVendor($email){
   // Decode Vendor Email
   $email = base64_decode($email);

   // Check if vendor email exists
   $vendorCount = Vendor::where('email', $email)->count();
   if($vendorCount > 0){
       // Vendor email is already activated or not
       $vendorDetails = Vendor::where('email', $email)->first();
       if($vendorDetails->confirm == "Yes"){
           $message = "Your Vendor Account is already confirmed. You can login.";
           return redirect('vendor/login')->with('error_message', $message);
       } else {
           // Update confirm column to 'Yes' in admin and vendor table to activate
           Admin::where('email', $email)->update(['confirm' => 'Yes']);
           Vendor::where('email', $email)->update(['confirm' => 'Yes']);

           // Send register email
           $messageData = [
               'email' => $email,
               'name' => $vendorDetails->name,
               'mobile' => $vendorDetails->mobile
           ];
           Mail::send('emails.vendor_confirmed', $messageData, function($message) use ($email){
               $message->to($email)->subject('Your Vendor Account is Confirmed');
           });

           // Redirect to vendor login/register page with success message
           $message = "Your Vendor email account is confirmed. You can login and add your personal, business and bank details to activate your Vendor Account to add products";
           return redirect('vendor/login')->with('success_message', $message);
       }
   } else {
       abort(404);
   }
}
public function vendorForgotPassword(Request $request)
{

        if ($request->ajax()) {
            $data = $request->all();

            // Validation
            $validator = Validator::make($data, [
                'email' => 'required|email|max:150|exists:admins,email',
            ], [
                'email.exists' => 'Email does not exist!',
            ]);

            if ($validator->passes()) {
                // Generate new password
                $new_password = Str::random(16);

                // Update new password
                Admin::where('email', $data['email'])->update(['password' => bcrypt($new_password)]);

                // Get admin details
                $adminDetails = Admin::where('email', $data['email'])->first();

                // Send email to the vendor with the new password
                $email = $data['email'];
                $messageData = [
                    'name' => $adminDetails->name,
                    'email' => $email,
                    'password' => $new_password
                ];
                Mail::send('emails.vendor_forgot_password', $messageData, function($message) use ($email) {
                    $message->to($email)->subject('New Password - ArtNest');
                });

                return response()->json(['type' => 'success', 'message' => 'New Password sent to your registered email.']);
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->messages()]);
            }
        } else {
            return view('front.vendors.forgot_password');
        }
    } 
}
    
