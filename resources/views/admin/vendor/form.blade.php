@if ($errors->any())

@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  {{$error}}
</div>
@endforeach

@endif
<div class="row mt-4">
  <div class="col-lg-1"></div>
  <div class="col-lg-10">
    <div class="card">
      <div class="card-body">
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            {!! Form::text('name', null, ['class'=>'form-control', 'required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            {!! Form::email('email', null, ['class'=>'form-control', 'required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Passowrd</label>
          <div class="col-sm-10">
            @if(isset($vendor->password))
            <div id="generated-password-div">
            </div>
            <button class="form-control btn btn-primary" id="generate-password-btn">Generate Password
            </button>
            @else
            <div id="generated-password-div">
            </div>
            <button class="form-control btn btn-primary" id="generate-password-btn">Generate Password
            </button>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="example-email-input" class="col-sm-2 col-form-label">Photo</label>
          <div class="col-sm-10">
            {!! Form::file('photo', null, ['class'=>'form-control']) !!}
            <!-- <small>*image size 600 X 583</small> -->
          </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-10">
            @if(isset($vendor->photo))
            <img src="{{asset($uplaodPath.$vendor->photo)}}" style="width: auto; height: 50px;">
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Phone</label>
          <div class="col-sm-10">
            {!! Form::text('phone', null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Shop Name</label>
          <div class="col-sm-10">
            {!! Form::text('shop_name', null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-email-input" class="col-sm-2 col-form-label">Brand Logo</label>
          <div class="col-sm-10">
            {!! Form::file('brand_logo', null, ['class'=>'form-control']) !!}
            <!-- <small>*image size 600 X 583</small> -->
          </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-10">
            @if(isset($vendor->brand_logo))
            <img src="{{asset($uplaodPath.$vendor->brand_logo)}}" style="width: auto; height: 50px;">
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="example-email-input" class="col-sm-2 col-form-label">Brand Banner</label>
          <div class="col-sm-10">
            {!! Form::file('brand_banner', null, ['class'=>'form-control']) !!}
            <!-- <small>*image size 600 X 583</small> -->
          </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-10">
            @if(isset($vendor->brand_banner))
            <img src="{{asset($uplaodPath.$vendor->brand_banner)}}" style="width: auto; height: 50px;">
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Brand Page Link</label>
          <div class="col-sm-10">
            {!! Form::text('brand_page_link', null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Gender</label>
          <div class="col-sm-10">
            {!! Form::select('gender', [null=>'Please Select']+['0'=>'Male','1'=>'Female'], null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Date Of Birth</label>
          <div class="col-sm-10">
            {!! Form::date('dob',null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Street 1 Address</label>
          <div class="col-sm-10">
            {!! Form::text('street_1',null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Street 2 Address</label>
          <div class="col-sm-10">
            {!! Form::text('street_2',null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">City</label>
          <div class="col-sm-10">
            {!! Form::select('city', [null=>'Please Select']+['1'=>'Dhaka'], null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">zipcode</label>
          <div class="col-sm-10">
            {!! Form::text('zipcode',null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Country</label>
          <div class="col-sm-10">
            {!! Form::select('country', [null=>'Please Select']+['1'=>'Bangladesh'], null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Banking Type</label>
          <div class="col-sm-10">
            {!! Form::select('banking_type', [null=>'Please Select']+$bankTypes, null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Account Name</label>
          <div class="col-sm-10">
            {!! Form::text('account_name',null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Account Number</label>
          <div class="col-sm-10">
            {!! Form::text('account_number',null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Bank Name</label>
          <div class="col-sm-10">
            {!! Form::text('bank_name',null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Branch Name</label>
          <div class="col-sm-10">
            {!! Form::text('branch_name',null, ['class'=>'form-control','required'=>'required']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Commision Pertcent</label>
          <div class="col-sm-10">
            {!! Form::number('commission_percent',null, ['class'=>'form-control','min'=>'0', 'max'=>'100']) !!}
          </div>
        </div>
        <div class="form-group row">
          <div class="col-lg-9"></div>
          <div class="col-lg-3 float-right">
            <button class="form-control btn btn-primary" type="submit">{{ $submitButtonText }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-1"></div>
</div>