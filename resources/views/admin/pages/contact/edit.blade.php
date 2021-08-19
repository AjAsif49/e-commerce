@extends('admin.layouts.admin_master')
@section('admin')


<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Contact</h2>
        </div>
        <div class="card-body">
        <form action="{{ url('admin/update/contact/'.$contacts->id) }}" method="POST">
            @csrf
            <div class="form-group">
                    <label for="exampleFormControlInput1"> Contact Email</label>
                    <input type="email" name='email' class="form-control" id="exampleFormControlInput1" placeholder="Contact Email" value="{{ $contacts->email }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1"> Contact Phone</label>
                    <input type="text" name='phone' class="form-control" id="exampleFormControlInput1" placeholder="Contact Phone" value="{{ $contacts->phone }}">
                </div>
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Contact Address</label>
                    <textarea class="form-control" name='address' id="exampleFormControlTextarea1" rows="3" placeholder="Contact Address" >{{ $contacts->address }}</textarea>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default" >Update Contact</button>
                </div>
            </form>
        </div>
    </div>

@endsection