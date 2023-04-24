<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Models\Products;
use App\Models\Cart;
use App\Models\login;


use Session;
class frontController extends Controller
{
  public function index(Request $request){
$result['home_categories']=DB::table('categories')->get();
$result['home_product']=DB::table('products')->get();
$result['home_slider']=DB::table('sliders')->get();
$result['home_recent']=DB::table('recents')->get();
    return view('front.index',$result);
  }
  public function detail(Request $request, $id){
$result['home_product']=DB::table('products')->where('id','=',$id)->get();
return view('front.detail',$result);
  }
  public function detail_recent(Request $request, $id){
$result['home_recent']=DB::table('recents')->where('id','=',$id)->get();
return view('front.detail_recent',$result);
  }
public function addtocart(Request $request){
if($request->session()->has('ADMIN_LOGIN')){
$cart = new Cart;
$cart->user_id=$request->session()->get('ADMIN_LOGIN',['id']);
$cart->product_id=$request->product_id;
$cart->save();
return redirect('/');
}
else{
  return redirect('/login');
}
  }
 static function cartitem(){
$userid=Session::get('ADMIN_LOGIN',['id']);
return Cart::where('user_id',$userid)->count();
 }
public function cartlist(){
  $userid=Session::get('ADMIN_LOGIN',['id']);
$data= DB::table('cart')
->join('products','cart.product_id','products.id')
->select('products.*')
->where('cart.user_id',$userid)->get();

  return view('front.cartlist',['products'=>$data]);
}
public function login(Request $request){
 $user=login::where(['email'=>$request->email])->first();
       if(!$user||!Hash::check($request->password,$user->password)){
            return "username or password is not matches";
       }
       else{
        $request->session()->put('user',$user);
        return redirect('/');
       }
}
public function update()
{
    $r = login::find(1);
    $r -> password=Hash::make('12345');
    $r->save();
}

}
