<?php

namespace App\Http\Controllers\Front;

use Auth;
use Session;
use Validator;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function loginRegister(){
        return view('front.users.login_register');
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
            $redirectTo=url('user/login-register');
            return response()->json(['type'=>'success','url'=>$redirectTo,'message'=>'Please confirm your email to activate your account!']);

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
                return response()->json(['type'=>'inactive','message'=>'Your account is not activated!Please confirm your account to acctivate your account.']);
            
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
        return redirect('/');
    }
    public function confirmAccount($code){
         $email=base64_decode($code);
         $userCount=User::where('email',$email)->count();
         if($userCount>0){
           $userDetails=User::where('email',$email)->first();
           if($userDetails->status==1){
            //redirect to login register
            return redirect('user/login-register')->with('error_message','Your account is already activated.You can login now.');
           }else{
            User::where('email',$email)->update(['status'=>1]);
             //send welcome email
            $messageData=['name'=>$userDetails->name,'mobile'=>$userDetails->mobile,'email'=>$email];
            Mail::send('emails.register',$messageData,function($message)use($email){
                 $message->to($email)->subject('Welcome to ArtNest');
            });
             //redirect to login register with sucess message
            return redirect('user/login-register')->with('success_message','Your account is activated.You can login now.');

           }
         }else{
            abort(404);
         }
    }
}
