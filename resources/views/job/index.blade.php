@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home | <a href="{{ URL::to('job/create') }}">Create job</a> </div>

                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <table width="100%" border="1">
                            <tr>
                                <th>Title</th>
                                <th>User Name</th>
                                <th>Action</th>
                            </tr>
                            @if(count($jobs) > 0)
                                @foreach($jobs as $job)

                                    <tr>
                                        <td>{{ $job->title ? $job->title : 'N/A' }}</td>
                                        <td>{{ $job->name }}</td>
                                        <td>
                                            @if($job->user_id == Auth::user()->id)
                                                <a href="{{ URL::to("user-inbox/".base64_encode($job->job_id)) }}">inbox</a>
                                            @else
                                                <a href="{{ URL::to("job-contact/".base64_encode($job->job_id)."/".base64_encode($job->user_id)) }}">contact</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
