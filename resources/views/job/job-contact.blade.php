@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ URL::to('/') }}"> Home</a></div>

                    <div class="card-body">
                        <h3>{{ $job->title }}</h3>

                        {!! Form::open(['url' => URL::to("job-contact/$job->id/$user_id"), 'method' => 'POST', 'name' => 'job_contact']) !!}

                            {!! Form::textarea('message', '', ['rows' => 7, 'cols' => 35, 'class' => 'form-control', 'required']) !!}

                        {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
                        @if(count($messages) > 0)
                            @foreach($messages as $message)
                                <p>{{ $message->name }} : {{ $message->message }} ({{ date('d-m-Y H:i', strtotime($message->msg_time)) }})</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
