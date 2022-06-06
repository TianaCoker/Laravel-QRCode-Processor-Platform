@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            Account: {{ $account->id }}

            <small>    
            <div class="form-group">
                
                @if($account->applied_for_payout == 1)  
                Payout Request Pending
                
                @endif
                

            </small>
        </h1>

        <h1 class="pull-right">
@if(Auth::user()->id == $account->user_id)
            
            {!! Form::open(['route' => ['roles.destroy', $account->id], 'method' => 'delete', 'class'=> 'pull-left']) !!}
        
            {!! Form::button('<i class="glyphicon glyphicon-ok"></i>Apply for Payout', ['type' => 'submit', 'class' => 'btn btn-primary', 'onclick' => "return confirm('Are you sure you want to apply for payout?')"]) !!}
        
            {!! Form::close() !!}
@endif

@if(Auth::user()->role_id < 3)
            {!! Form::open(['route' => ['roles.destroy', $account->id], 'method' => 'delete', 'class'=> 'pull-right', 'style'=> 'margin-left:10px']) !!}
        
            {!! Form::button('<i class="glyphicon glyphicon-ok"></i> Mark as Paid', ['type' => 'submit', 'class' => 'btn btn-primary', 'onclick' => "return confirm('Are you sure?')"]) !!}
        
            {!! Form::close() !!}
@endif

        </h1>


        
        

    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('accounts.show_fields')
                    
                </div>
            </div>
        </div>
    </div>
@endsection
