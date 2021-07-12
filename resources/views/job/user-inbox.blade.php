@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ URL::to('/') }}"> Home</a></div>

                    <div class="card-body">
                        <h3>{{ $job->title }}</h3>
                            @if(count($jobs) > 0)
                            <ul>

                                @foreach($jobs as $job)
                                    <li><a href="{{ URL::to("job-contact/".base64_encode($job->job_id)."/".base64_encode($job->user_id)) }}">{{ $job->name }}</a></li>
                                @endforeach
                                </ul>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
