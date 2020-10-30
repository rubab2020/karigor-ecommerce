<div class="row mt-4">
  <div class="col-lg-10">
    <div class="card">
      <div class="card-body">
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-10">
            {!! Form::select('category_id', [null=>'Select Category']+$bcategories, null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
          <div class="col-sm-10">
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Cover Photo</label>
          <div class="col-sm-10">
            {!! Form::file('cover_photo', null, ['class'=>'form-control']) !!}
            @if(isset($blog))
              <img src="{{ asset($uplaodPath.$blog->cover_photo_sm) }}" style="width:auto; height: 100px;">
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-10">
            {!! Form::textarea('description', null, ['class'=>'form-control description']) !!}
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