@extends('admin.layouts.admin_master')
@section('admin')



<div class="py-12">

    <div class="container">
        <div class="row">

            <h4>Admin Message Page</h4>


            <div class="col-md-12">
                <div class="card">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card-header"> All Messages </div>

                    <table class="table">
                        <thead>
                            <tr>

                                <th scope="col" width="5%">SL No</th>
                                <th scope="col" width="15%"> Name</th>
                                <th scope="col" width="15%"> Email </th>
                                <th scope="col" width="15%"> Subject </th>
                                <th scope="col" width="25%">Message</th>
                                <th scope="col" width="15%"> Action </th>

                            </tr>
                        </thead>
                        <tbody>

                            @php($i=1)
                            @foreach($messages as $message)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td> {{ $message->name }} </td>
                                <td> {{ $message->email }} </td>
                                <td> {{ $message->subjct }} </td>
                                <td> {{ $message->message }} </td>
                                <td>
                                    <a href="{{ url('admin/message/delete/'.$message->id) }}"
                                        onclick="return confirm('Are you Sure to Delete?')"
                                        class="btn btn-danger">Delete</a>
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
@endsection
