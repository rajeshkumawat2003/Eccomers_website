<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $result['data']= Category::all();
       return view('admin/category',$result);
   }
   public function manage_category(Request $request)
   {
     return view('Admin.manage_category');
   }
 
   public function manage_category_process(Request $request){
 
 
       request()->validate([
         'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
             ]);
       $post=new Category;
       $post->category_name=$request->get('category_name');
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
       return redirect('admin/category');
   }
   public function delete(Request $request,$id){

    $post=Category::find($id);
    $post->delete();
    return redirect('admin/category');
    }
  public function update(Request $request, $id)
  {
      $post=Category::find($id);
      $post->category_name=$request->get('category_name');
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
      return redirect('admin/category');
    }
  public function edit(Request $request, $id)
  {
      $post=Category::find($id);
      return view('Admin/manage_category_update', Compact(['post']));
  }
   
}
