<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index(){
        $result['data']= Products::all();
       return view('admin/product',$result);
   }
   public function manage_product(Request $request)
   {
     return view('Admin.manage_product');
 
   }
   public function manage_product_process(Request $request){
 
 
    request()->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
          ]);
    $post=new Products;
    $post->product_name=$request->get('product_name');
    $post->tatal_product=$request->get('tatal_product');

    if($request->hasFile('image')){
      $rand = rand('111111111','999999999');
       $image=$request->file('image');
       $ext=$image->extension();
       $image_name=$rand.'.'.$ext;
       $image->storeAs('/public/media',$image_name);
       $post->image=$image_name;
     }
    $post->save();
    return redirect('admin/product');
}
public function delete(Request $request,$id){

    $post=Products::find($id);
    $post->delete();
    return redirect('admin/product');
      }

      public function update(Request $request, $id)
      {
          $post=Products::find($id);
          $post->product_name=$request->get('product_name');
          $post->tatal_product=$request->get('tatal_product');
          if($request->hasFile('image')){
            $rand = rand('111111111','999999999');
             $image=$request->file('image');
             $ext=$image->extension();
             $image_name=$rand.'.'.$ext;
             $image->storeAs('/public/media',$image_name);
             $post->image=$image_name;
           }
          $post->save();
          return redirect('admin/product');
        }
      public function edit(Request $request, $id)
      {
          $post=Products::find($id);
          return view('Admin/manage_product_update', Compact(['post']));
      }



}
