@extends('layouts.admin')
@section('title', 'Edit Company:')
@section('content')
    <section class="form" >
        <div class="card mx-auto mt-3 position-relative col-md-6">
            <div class="card-header">
                <h3 class="card-title">Edit form</h3>
            </div>
            <form method="POST" action="{{route('company-update', $company->id)}}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Enter email" value="{{old('name')?? $company->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="{{old('email')?? $company->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone">Phone number</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputPhone" placeholder="Enter email" value="{{old('phone')?? $company->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDesc">Description</label>
                        <input type="text" class="form-control" name="description" id="exampleInputDesc" placeholder="Password" value="{{old('description')?? $company->description}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
