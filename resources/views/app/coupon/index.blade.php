@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Selected Menu')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/dragula.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/drag-and-drop.css')}}">
@endsection

@section('content')
<!-- table Transactions start -->
<section id="table-transactions">
  <div class="card">
    <form method="POST">
      @csrf
    <div class="card-header">
      <div class="row justify-content-end">
        <div class="col-lg-8 col-md-12 row">
          <div class="input-group">
            <select class="custom-select" id="ukerSelected" name="uker" required>
              @foreach ($opt_uker ?? '' as $key => $value)
                  <option value="{{ $key }}" {{ ( $key == $selectedUker) ? 'selected' : '' }}> 
                      {{ $value }} 
                  </option>
              @endforeach    
            </select>  
            <select class="custom-select" id="levelSelected" name="level" required>
              @foreach ($opt_level as $key => $value)
                  <option value="{{ $key }}" {{ ( $key == $selectedLevel) ? 'selected' : '' }}> 
                      {{ $value }} 
                  </option>
              @endforeach    
            </select>       
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary"><i class="bx bx-search text-white">find</i></button>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#large"><i class="bx bx-sort text-white">Sorted</i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    <div class="card-body">
    <div class="table-responsive">
          <table class="table mb-0">
          <thead>
            <tr>
              <th>Checked</th>
              <th>Type</th>
              <th>Name</th>
              <th>Url</th>
              <th>Icon</th>
              <th>MainId</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($lists as $row)
              <tr>
                <td class="dt-checkboxes-cell">
                  <input type='checkbox' class='dt-checkboxes' disabled {{ $row['checked'] ? 'checked' : null }}>
                </td>
                <td>{{ $row['type'] }}</td>
                <td class="text-bold-600">{{ $row['name'] }}</td>
                <td>{{ $row['url'] }}</td>
                <td>{{ $row['icon'] }}</td>
                <td>{{ $row['menuId'] }}</td>
                <td>
                  <form method="POST">
                    @csrf
                    <input value={{ $row['id'] }} name="id" hidden>
                    <input value="{{$selectedUker}}" name="uker" hidden>
                    <input value="{{$selectedLevel}}" name="level" hidden>
                    <button type="submit" class="btn btn-light-{{ $row['checked'] ? 'warning' : 'primary' }} ">{{ $row['checked'] ? 'unselect' : 'select' }}</button>
                  </form>
                </td>
              </tr>
              @if($row['child'])
                  @foreach($row['child'] as $child)
                  <tr>
                    <td class="dt-checkboxes-cell">
                      <input type='checkbox' class='dt-checkboxes' disabled {{ $child['checked'] ? 'checked' : null }}>
                    </td>
                    <td>{{ $child['type'] }}</td>
                    <td class="text-bold-600">{{ $child['name'] }}</td>
                    <td>{{ $child['url'] }}</td>
                    <td>{{ $child['icon'] }}</td>
                    <td>{{ $child['menuId'] }}</td>
                    <td>
                      <form method="POST">
                        @csrf
                        <input value={{ $child['id'] }} name="id" hidden>
                        <input value="{{$selectedUker}}" name="uker" hidden>
                        <input value="{{$selectedLevel}}" name="level" hidden>
                        <button type="submit" class="btn btn-light-{{ $child['checked'] ? 'warning' : 'primary' }} ">{{ $child['checked'] ? 'unselect' : 'select' }}</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
              @endif
            @endforeach
          </tbody>
      </table>
</div>
    </div>
    <div class="card-footer">

    </div>
  </div>
  <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel17">Large Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
        </div>
        <form method="POST">
          <input type="hidden" name="sorted" value="1" />
        <div class="modal-body">
          <section id="dd-with-handle">
            <div class="row">
              <div class="col-sm-12">                
                <ul class="list-group" id="handle-list-1">
                  @foreach ($lists as $row)
                    @csrf
                    @if($row['type'] != 'HREF')
                      <li class="list-group-item">
                        <span class="handle mr-1">+</span> {{ $row['name'] }} ({{ $row['type'] }})
                        <input type="text" name="menusort[]" id="menusort" value="{{ $row['id'] }}" hidden>
                        <span class="badge badge-info badge-pill badge-round ml-1">7</span>
                        @if($row['child'])
                        <ul class="list-group list-group-flush mt-2" id="basic-list-group">
                          @foreach($row['child'] as $child)
                          <li class="list-group-item">
                            <i class="bx bx-right-arrow-alt"></i> {{ $child['name'] }} ({{ $child['type'] }})
                            <input type="text" name="menusort[]" id="menusort" value="{{ $child['id'] }}" hidden>
                          </li>
                          @endforeach
                        </ul>
                        @endif
                      </li>
                    @endif
                  @endforeach
                </ul>

              </div>
            </div>                      
          </section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>
          <button type="submit" class="btn btn-primary ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Accept</span>
          </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/dragula.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/extensions/drag-drop.js')}}"></script>
@endsection