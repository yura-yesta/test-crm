@extends('layouts.admin')
@section('title', 'Edit Client:')
@section('content')
    <section class="form">
        <div class="card mx-auto mt-3 position-relative col-md-6">
            <div class="card-header">
                <h3 class="card-title">Edit form</h3>
            </div>
            <form method="POST"
                  action="{{route('client-update',['id' => $client->id, 'company_id' => $id_company?? null])}}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName"
                               placeholder="Enter email" value="{{old('name')?? $client->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                               placeholder="Enter email" value="{{old('email')?? $client->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone">Phone number</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputPhone"
                               placeholder="Enter email" value="{{old('phone')?? $client->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDesc">Description</label>
                        <input type="text" class="form-control" name="description" id="exampleInputDesc"
                               placeholder="Password" value="{{old('description')?? $client->description}}">
                    </div>
                </div>
                <input type="hidden" name="id_company" value="{{$id_company?? null}}">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
