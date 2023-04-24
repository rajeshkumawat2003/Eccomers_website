
@extends('admin/layout')
@section('page_title','Manage Categries')
@section('category_select','active')

@section('container')


<!-- MAIN CONTENT-->
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-9">
                            <h1 class="mb10">Manage Category</h1>
                                 <a href="{{url('admin/category')}}" class="d-flex justify-content-end">
                                 <button type="button" class="btn btn-success">
                                  Back   </button> 
                                 </a>
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Manage Category</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('category.manage_category_process')}}" method="post" enctype="multipart/form-data">
                                        @csrf  
                                            <div class="form-group">
                                                <label for="category_name" class="control-label mb-1">Category Name</label>
                                                <input id="category_name" type="text" name="category_name" class="form-control" aria-required="true" aria-invalid="false">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="tatal_product" class="control-label mb-1">Total Product</label>
                                                <input id="tatal_product" name="tatal_product" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                            </div>
                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">product Image</label>
                                                <input id="image" name="image" type="file" class="form-control cc-number identified visa" value="" data-val="true"
                                                    data-val-required="Please enter the image" 
                                                    autocomplete="cc-number">
                                            </div>
                                           
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            @endsection