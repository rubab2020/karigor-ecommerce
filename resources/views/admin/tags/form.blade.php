<div class="row mt-4">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">

        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
          </div>
        </div>

        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-10">
            {!! Form::textarea('description', null, ['class'=>'form-control', 'style'=>'height: 50px;']) !!}
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
</div>