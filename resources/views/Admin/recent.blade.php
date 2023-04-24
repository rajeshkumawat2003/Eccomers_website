@extends('admin/layout')
@section('page_title','Category')
@section('category_select','active')
@section('container')
@if(session()->has('message'))
 
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
  {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
      @endif
 <!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                            <h1 class="mb10">Product</h1>
                                <a href="{{url('admin/recent/manage_recent')}}" class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success">
                                 Add Product</button>
                                </a>
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                               
                                                <th>order ID</th>
                                                <th>product Name</th>
                                                <th class="text-right">price</th>
                                                <th class="text-right">Image</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)
                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->product_name}}</td>
                                                <td class="text-right">{{$list->price}}</td>
                                                <td class="text-right">
                                                <img width="100px" src="{{asset('storage/media/'.$list->image)}}">
                                                </td>
                                                <td class="text-right">
                                                <a href="{{url('edit/recent')}}/{{$list->id}}"><button type="button" class="btn btn-success btn-sm">Edit</button></a>
                                              <a href="{{url('delete/recent')}}/{{$list->id}}"> <button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                                </td>
                                            </tr>
                                                @endforeach                                   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            @endsection