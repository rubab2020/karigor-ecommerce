<div class="row mt-4">
  <!-- <div class="col-lg-2">
  </div> -->

  <div class="col-lg-10">
    <div class="card">
      <div class="card-body">

        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Category Name</label>
          <div class="col-sm-10">
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Parent Category</label>
          <div class="col-sm-10">
            {!! Form::select('parent_id', [null=>'Please Select']+$categories, null, ['class'=>'form-control']) !!}
          </div>
        </div>

        <div class="form-group row">
          <label for="example-email-input" class="col-sm-2 col-form-label">Image</label>
          <div class="col-sm-10">
            {!! Form::file('image', null, ['class'=>'form-control']) !!}
            <!-- <small>*image size 600 X 583</small> -->
          </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-10">
            @if(isset($category->image_bg))
              <img src="{{ asset($uplaodPath.$category->image_bg) }}" style="width: auto; height: 50px;">
            @endif
          </div>
        </div>

        <div class="form-group row">
          <label for="example-email-input" class="col-sm-2 col-form-label">Icon</label>
          <div class="col-sm-10">
            {!! Form::file('icon', null, ['class'=>'form-control']) !!}
            <!-- <small>*image size 50 X 50</small> -->
          </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-10">
            @if(isset($category->icon))
              <img src="{{ asset($uplaodPath.$category->icon) }}" style="width: auto; height: 50px;">
            @endif
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
  </div><!-- end col -->
  <div class="col-lg-1">
  </div>
</div>