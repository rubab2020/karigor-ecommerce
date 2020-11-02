<style type="text/css">
  .right-section{max-height: 400px; overflow-y: auto;}

  .parent div{margin-left:20px;}
</style>

<div class="row mt-4">
  <!-- left sections -->
  <div class="col-lg-8">
    <!-- general -->
    <div class="card">
      <div class="card-body">
        <p>General</p><hr>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Vendor</label>
          <div class="col-sm-10">
            {!! Form::select('vendor_id', [null=>'Please Select']+$Vendors, null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Product Image</label>
          <div class="col-sm-10">
            {!! Form::file('image', null, ['class'=>'form-control', 'accept'=>'image/*']) !!} <!--
            <small>*image size 600 X 583</small> -->

            <br>
            @if(isset($product->image))
              <img
                src="{{ asset($product->image) }}"
                style="width: 120px;
                height: 80px;">
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-10">
            <textarea name="description" id="editorProductDesc">
              @if(isset($product))
                {{ $product->description }}
              @endif
            </textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- images -->
    <div class="card">
      <div class="card-body">
        <p>Images</p><hr>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">gallery Images</label>
          <div class="col-sm-10">
            {!! Form::file('images[]', ['class'=>'form-control', 'multiple'=>true, 'accept'=>'image/*'])
            !!}
            <!--<small>*image size 600 X 583</small> -->

            <br>
            @if(isset($product->images))
            <div class="row">
              @foreach($product->images as $image)
                <div class="col-md-2" style="margin-top: 5px;display: inline">
                  <img
                    src="{{ asset($image->image_path) }}"
                    style="width: 120px; height: 80px; border: 1px solid #ddd; object-fit: fill">
                  <br>
                  <a
                    class="remove-image text-center"
                    href="#"
                    data-id="{{ $image->id }}"
                    style="display: inline;
                      color: #e74c3c;
                      margin-left: 30px;"
                    onclick="return confirm(' you want to delete?');"
                  >
                    Delete
                  </a>
                </div>
              @endforeach
            </div>
          @endif
          </div>
        </div>
      </div>
    </div>

    <!-- price -->
    <div class="card">
      <div class="card-body">
        <p>Price</p><hr>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Regular Price</label>
          <div class="col-sm-10">
            {!! Form::text('price', null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Sale Price</label>
          <div class="col-sm-10">
            {!! Form::text('sale_price', null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Sale Price From</label>
          <div class="col-sm-10">
            {!! Form::text('sale_price_from', null, ['class'=>'form-control', 'id'=>'salePriceFrom', 'placeholder'=>'yyyy-mm-dd']) !!}
          </div>
        </div>
        <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Sale Price To</label>
          <div class="col-sm-10">
            {!! Form::text('sale_price_to', null, ['class'=>'form-control', 'id'=>'salePriceTo', 'placeholder'=>'yyyy-mm-dd']) !!}
          </div>
        </div>
      </div>
    </div>

    <!-- attributes -->
    <div class="card">
      <div class="card-body">
        <p>Attributes</p><hr>
      </div>
    </div>
  </div>

  <!-- right sections -->
  <div class="col-lg-4">
    <!-- categories -->
    <div class="card">
      <div class="card-body right-section">
        <p>Categories</p><hr>
        <div class="parent">
          @foreach($categories as $category)
            <input type="checkbox" name="" value=""> {{ $category->name }}
            <div>
              @foreach($category->sub_categories as $subCategory)
                <input type="checkbox" name="" value=""> {{ $subCategory->name }}
                <br>
              @endforeach
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- linked products -->
    <div class="card">
      <div class="card-body right-section">
        <p>Linked Products</p><hr>

        <div class="form-group row">
          <div class="col-sm-12">
            <label>Up Sells</label>
            {!! Form::text('price', null, ['class'=>'form-control']) !!}
          </div>  

        </div>
        <div class="form-group row">
          <div class="col-sm-12">
            <label>Cross Sells</label>
            {!! Form::text('sale_price', null, ['class'=>'form-control']) !!}
          </div>
        </div>
      </div>
    </div>

    <!-- tags -->
    <div class="card">
      <div class="card-body right-section">
        <p>Tags</p><hr>
      </div>
    </div>
  </div>
</div>

<br>
<div class="form-group row">
  <div class="col-lg-9"></div>
  <div class="col-lg-3 float-right">
    <button class="form-control btn btn-primary" type="submit">
      {{ $submitButtonText }}
    </button>
  </div>
</div>

@section('scripts')
  <!-- ck editor -->
  <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'editorProductDesc', {
      filebrowserUploadUrl: "{{route('editor-image-upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });
  </script>
  <script type="text/javascript">
    $('#salePriceFrom').datepicker({
      format: "yyyy-mm-dd"
    });
    $('#salePriceTo').datepicker({
      format: "yyyy-mm-dd"
    });

    // multi hiarchy select
    $('input').change(function(){
      var status = false;
      $(this).next().find('input').prop('checked', this.checked); 
      status = ($(this).parent().find('> input').not(':checked').length === 0);
      $(this).parent().prev().prop('checked', status);
      console.log(status)
      if(status){
          $(this).parent().prev().trigger("change");
      }
      else{
        $(this).parents().prev().prop('checked', false);
      }
    });
  </script>
@endsection