<div class="col-md-6">

        <!-- Product Name Field -->
        <div class="form-group">
            
            <h3>{{ $qrcode->product_name }}</h3>
            <br>
            @if(isset($qrcode->company_name))
            <small> By {{ $qrcode->company_name }}</small>
            @endif
        </div>


         <!-- Amount Field -->
         <div class="form-group">
            
            <h4>Amount: ${{ $qrcode->amount }}</h4>
        </div>


        <!-- Product Url Field -->
        <div class="form-group">
            {!! Form::label('product_url', 'Product Url:') !!}
            <p>
                <a href=" {{ $qrcode->product_url }} " target="_blank"> {{ $qrcode->product_url }} </a>
            </p>
        </div>

 @if(!Auth::guest() && ($qrcode->user_id == Auth::user()->id || Auth::user()->role_id < 3))
 <hr>
        <!-- User Id Field -->
        <div class="form-group">
            {!! Form::label('user_id', 'User:') !!}
            <p>{{ $qrcode->user['email'] }}</p>
        </div>


        <!-- Website Field -->
        <div class="form-group">
            {!! Form::label('website', 'Website:') !!}
            <p><a href="{{ $qrcode->website }}" target="_blank">{{ $qrcode->website }}</a></p>
        </div>

        
        

        <!-- Callback Url Field -->
        <div class="form-group">
            {!! Form::label('callback_url', 'Callback Url:') !!}
            <p><a href="{{ $qrcode->callback_url }}" target="_blank">{{ $qrcode->callback_url }}</a></p>
        </div>

       

       
        <!-- Status Field -->
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            <p>
              @if($qrcode->status==1)  
              Active
              @else
              Inactive
              @endif
             </p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Created At:') !!}
            <p>{{ $qrcode->created_at }}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At:') !!}
            <p>{{ $qrcode->updated_at }}</p>
        </div>

        <a href="{{ route('qrcodes.index') }}" class="btn btn-default">Back</a>

 
@endif
</div>


 <div class="col-md-5 pull-right">

        <!-- Qrcode Path Field -->
        <div class="form-group">
                    {!! Form::label('qrcode_path', 'Scan Qrcode and Pay With Our APP :') !!}
                    <p>
                        <img src="{{ asset($qrcode->qrcode_path)}}" >
                    </p>
                </div>


                @if(!Auth::guest())

                @include('qrcodes.paystack-form')

                @else

                 <form action="" method="post"  role="form" class="col-md-6">
                    <div class="form-group">
                     <label for="email">Enter Your Email</label>
                     <input type="email" name="email" id="email" placeholder="johndoe@gmail.com" class="form-control">
                    </div>

                    <p>
                        <button class="btn btn-success btn-lg " type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                        </button>
                    </p>
                 </form>

                @endif
 </div>

 @if(!Auth::guest() && ($qrcode->user_id == Auth::user()->id || Auth::user()->role_id < 3))
 <div class="col-xs-12">
 <h3 class="text-center">Transactions done on this QRCode </h3>
   @include('transactions.table')
   </div>
   @endif