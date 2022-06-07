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
@if(Auth::user()->id == $account->user_id && $account->applied_for_payout != 1 )
            
            {!! Form::open(['route' => ['accounts.apply_for_payout', ], 'method' => 'post', 'class'=> 'pull-left']) !!}
            <input type="hidden" name="apply_for_payout" value="{{ $account->id }}">
            {!! Form::button('<i class="glyphicon glyphicon-ok"></i>Apply for Payout', ['type' => 'submit', 'class' => 'btn btn-primary', 'onclick' => "return confirm('Are You Yure You Want to Apply for Payout?')"]) !!}
        
            {!! Form::close() !!}
@endif

@if(Auth::user()->role_id < 3 && $account->paid != 1 )
            {!! Form::open(['route' => ['accounts.mark_as_paid', ], 'method' => 'post', 'class'=> 'pull-right', 'style'=> 'margin-left:10px']) !!}
            <input type="hidden" name="mark_as_paid" value="{{ $account->id }}">
            {!! Form::button('<i class="glyphicon glyphicon-ok"></i> Mark as Paid', ['type' => 'submit', 'class' => 'btn btn-primary', 'onclick' => "return confirm('Are You Sure You Want to Mark Payout as Paid?')"]) !!}
        
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
