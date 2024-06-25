<?php

namespace App\Http\Controllers\Front;

use Auth;
use Session;
use Validator;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\Mail;
use Image;

class UserController extends Controller
{
    public function login(){
        return view('front.users.login');
    }
    public function register(){
        return view('front.users.register');
    }


    public function userRegister(Request $request){
        if($request->ajax()){
            $data=$request->all();
           // echo"<pre>";print_r($data);die;
           $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:100',
            'mobile'=>'required|string|digits:10',
            'email'=>'required|email|max:150|unique:users',
            'password'=>'required|min:6',
            'accept'=>'required'

           ],
           [
            'accept.required'=>'Please accept our Term & Conditions'

           ]
           );
           if($validator->passes()){
             //  Register the User
             $user=new User;
             $user->name=$data['name'];
             $user->mobile=$data['mobile'];
             $user->email=$data['email'];
             $user->password= bcrypt ($data['password']);
             $user->status=0;
            $user->save();
            //Activate  user by confirming email 
            $email=$data['email'];
            $messageData=['name'=>$data['name'],'email'=>$data['email'],'code'=>base64_encode($data['email'])];
            Mail::send('emails.confirmation',$messageData,function($message)use($email){
                $message->to($email)->subject('Confirm your ArtNest Account');
            });
            //redirect back with success message
        
            return response()->json(['type'=>'success','message'=>'Please confirm your email to activate your account!']);

           //Activate  user without confirming email 

           /* //send register email
            $email=$data['email'];
            $messageData=['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']];
            Mail::send('emails.register',$messageData,function($message)use($email){
                 $message->to($email)->subject('Welcome to ArtNest');
            });*/
     
            /* if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $redirectTo=url('cart');
                 //update user cart with user id
            if(!empty(Session::get('session_id'))){
                $user_id=Auth::user()->id;
                $session_id=Session::get('session_id');
                Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
            }
                return response()->json(['type'=>'success','url'=>$redirectTo]);
             }*/

             
           }else{
            return response()->json(['type'=>'error','errors'=>$validator->messages()]);
           }
        
    
        }
    }

    public function userAccount(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validate form input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'address' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'mobile' => 'required|string|digits:10',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000', // Adjust max file size as needed
            ]);

            if ($validator->fails()) {
                return response()->json(['type' => 'error', 'errors' => $validator->errors()], 422);
            }

             // Handle image upload if a file is present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'front/images/photos/' . $imageName;

            // Move the uploaded file to the specified path
            $image->move(public_path('front/images/photos'), $imageName);

            // Optionally, use Intervention Image to resize or manipulate the image
            Image::make(public_path($imagePath))->resize(300, 200)->save(public_path($imagePath));

            // Update user's image field in database
            Auth::user()->image = $imageName;
            Auth::user()->save(); // Save the updated user model
        }

            // Update user details
            $user = Auth::user();
            $user->name = $request->input('name');
            $user->address = $request->input('address');
            $user->state = $request->input('state');
            $user->mobile = $request->input('mobile');
            $user->save();

            return response()->json(['type' => 'success', 'message' => 'Profile updated successfully.']);
        } else {
            // If it's a GET request (assuming to load the form), return view or redirect as needed
            return view('front.users.user_account');
        }
    }

    public function userUpdatePassword(Request $request){
        if ($request->ajax()){
            $data=$request->all();
           //   echo"<pre>";print_r($data);die;
              $validator = Validator::make($request->all(),[
                'current_password'=>'required',
                'new_password'=>'required|min:6',
                'confirm_password'=>'required|min:6|same:new_password',
                
               ]
               
               );
               if($validator->passes()){
              $current_password=$data['current_password'];
              $checkPassword=User::where('id',Auth::user()->id)->first();
              if(Hash::check($current_password,$checkPassword->password)){
                 //update user current password
                 $user=User::find(Auth::user()->id);
                 $user->password=bcrypt($data['new_password']);
                 $user->save();
                 //redirect back user with success message
            
             return response()->json(['type'=>'success','message'=>'Account Password is updated']);

              }else{
                return response()->json(['type'=>'incorrect','message'=>'Your current password is incorrect!']);

              }

                }else{
                    
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }else{
            return view('front.users.user_account');
        }
    }

    public function forgotPassword(Request $request){
        if($request->ajax()){
            $data=$request->all();
          //  echo"<pre>";print_r($data);die;
            $validator = Validator::make($request->all(),[   
                'email'=>'required|email|max:150|exists:users',
    
               ],
               [
                'email.exists'=>'Email does not exist!'
               ]
               );
               if($validator->passes()){
                //generate new password
               $new_password=Str::random(16); 
               //update new password
               User::where('email',$data['email'])->update(['password'=>bcrypt($new_password)]);
            //get user detail
            $userDetails = User::where('email', $data['email'])->first()->toArray();
            //send email to user
              $email=$data['email'];
              $messageData=['name'=> $userDetails['name'],'email'=>$email,'password'=> $new_password];
             Mail::send('emails.user_forgot_password',$messageData,function($message)use($email){
                $message->to($email)->subject('New Password -ArtNest');
             });
             //Show Success Message

             return response()->json(['type'=>'success','message'=>'New Password sent to your registered email.']);
            }else{
                  return response()->json(['type'=>'error','errors'=>$validator->messages()]);
               }
        }else{
            return view ('front.users.forgot_password');
        }
       
    }
    public function userLogin(Request $request){
    if($request->Ajax()){
        $data=$request->all();
       // echo"<pre>";print_r($data);die;
       $validator = Validator::make($request->all(),[
        'email'=>'required|email|max:150|exists:users',
        'password'=>'required|min:6',

       ]);
       if($validator->passes()){
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            if(Auth::user()->status==0){
                Auth::logout();
                return response()->json(['type'=>'inactive','message'=>'Your account is not activated!Please confirm your account to activate your account.']);
            
            }
            //update user cart with user id
            if(!empty(Session::get('session_id'))){
                $user_id=Auth::user()->id;
                $session_id=Session::get('session_id');
                Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
            }
            
            $redirectTo=url('cart');
            return response()->json(['type'=>'success','url'=>$redirectTo]);
         }else {
            
            return response()->json(['type'=>'incorrect','message'=>'Incorrect Email or Password!']);
         }

       }else{
            return response()->json(['type'=>'error','errors'=>$validator->messages()]);
           }
    }
    }
    public function userLogout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
    public function confirmAccount($code){
         $email=base64_decode($code);
         $userCount=User::where('email',$email)->count();
         if($userCount>0){
           $userDetails=User::where('email',$email)->first();
           if($userDetails->status==1){
            //redirect to login register
            return redirect('user/register')->with('error_message','Your account is already activated.You can login now.');
           }else{
            User::where('email',$email)->update(['status'=>1]);
             //send welcome email
            $messageData=['name'=>$userDetails->name,'mobile'=>$userDetails->mobile,'email'=>$email];
            Mail::send('emails.register',$messageData,function($message)use($email){
                 $message->to($email)->subject('Welcome to ArtNest');
            });
             //redirect to login register with sucess message
            return redirect('user/login')->with('success_message','Your account is activated.You can login now.');

           }
         }else{
            abort(404);
         }
    }
}
