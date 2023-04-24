<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
   
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
             return redirect('admin/dashboard');
        }
        else{
            return view('Admin.login');
        }
        return view('Admin.login');
    }
    public function auth(Request $request)
    {
        $email = $request->post('email');

        $result = Admin::where(['email' => $email])->first();
       if($result){
    if(Hash::check($request->post('password'),$result->password)){
        $request->session()->put('ADMIN_LOGIN', true);
        $request->session()->put('ADMIN_ID', $result->id);
        return redirect('admin/dashboard');  
    }
    else{
        $request->session()->flash('error', 'please enter correct password');
        return redirect('admin');
    }
}
else{
    $request->session()->flash('error', 'please enter valid login detail');
    return redirect('admin');
}    
    }
    public function dashboard()
    {
        return view('Admin.dashboard');
    }
    public function update()
    {
        $r = Admin::find(1);
        $r -> password=Hash::make('12345');
        $r->save();
    }

}
?>