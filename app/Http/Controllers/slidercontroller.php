<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slider;
class slidercontroller extends Controller
{
    public function index(){
        $result['data']= slider::all();
       return view('admin/slider',$result);
   }
   public function manage_slider(Request $request)
   {
     return view('Admin.manage_slider');
 
   }
  public function manage_slider_process(Request $request){
 
    request()->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
          ]);
    $post=new slider;
    $post->product_name=$request->get('product_name');
    $post->description=$request->get('description');

    if($request->hasFile('image')){
      $rand = rand('111111111','999999999');
       $image=$request->file('image');
       $ext=$image->extension();
       $image_name=$rand.'.'.$ext;
       $image->storeAs('/public/media',$image_name);
       $post->image=$image_name;
     }
    $post->save();
    return redirect('admin/slider');
}
public function delete(Request $request,$id){

    $post=slider::find($id);
    $post->delete();
    return redirect('admin/slider');
      }
      public function update(Request $request, $id)
      {
          $post=slider::find($id);
          $post->product_name=$request->get('product_name');
          $post->description=$request->get('description');
          if($request->hasFile('image')){
            $rand = rand('111111111','999999999');
             $image=$request->file('image');
             $ext=$image->extension();
             $image_name=$rand.'.'.$ext;
             $image->storeAs('/public/media',$image_name);
             $post->image=$image_name;
           }
          $post->save();
          return redirect('admin/slider');
        }
      public function edit(Request $request, $id)
      {
          $post=slider::find($id);
          return view('Admin/manage_slider_update', Compact(['post']));
      }





}
