@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ URL::to('/') }}">Home</a> </div>

                    <div class="card-body">
                        {!! Form::open(['url' => URL::route('job.store'), 'method' => 'POST']) !!}
                            <div class="form-group row">
                                <div class="col-md-6">
                                    Title {!! Form::text('title',null,['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    Description {!! Form::textarea('description',null,['class' => 'form-control', 'cols' => 7, 'rows' => 5, 'required']) !!}
                                </div>
                            </div>
                                {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
