@extends('layouts.admin-default')

@include('partials.admin.table.header')

@section('content')
  <div class="page-title-box">
    @include('partials.admin.table.breadcrumbs', ['featureName' => 'attribute-option'])
    
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap table-custom">
              <thead>
                <tr>
                  <th>Attribute</th>
                  <th>Option</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($options as $option)
                  <tr>
                    <td>{{ App\Models\Attribute::name($option->attribute_id) }}</td>
                    <td>{{ $option->name }}</td>
                    <td>
                      <!-- Edit -->
                      <a href="/admin/attribute-options/{{$option->id}}/edit">
                        <button type="submit" class="btn btn-default float-left"><i class="ti-pencil"></i></button>
                      </a>

                      <!-- delete -->
                      <form action="{{ route('attribute-options.destroy', $option->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-default float-left" style="margin-left: 10px;">
                          <i class="ti-trash"></i> 
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@include('partials.admin.table.scripts')
