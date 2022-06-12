@extends('layouts.admin')
@section('title', 'Create Company:')
@section('content')
    <section class="form" >
        <div class="card mx-auto mt-3 position-relative col-md-6">
            <div class="card-header">
                <h3 class="card-title">Create form</h3>
            </div>
            <form method="POST" action="{{route('company-store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Enter name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone">Phone number</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputPhone" placeholder="Enter phone" value="{{old('phone')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDesc">Description</label>
                        <input type="text" class="form-control" name="description" id="exampleInputDesc" placeholder="Enter description" value="{{old('description')}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
