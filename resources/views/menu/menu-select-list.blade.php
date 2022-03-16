@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Bootstrap Tables Extended')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/daterange/daterangepicker.css')}}">
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
              @foreach ($opt_uker as $key => $value)
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
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    <div class="card-body">
      <table id="table-extended-transactions" class="table mb-0">
          <thead>
            <tr>
              <th>Checked</th>
              <th>Type</th>
              <th>Name</th>
              <th>Url</th>
              <th>Icon</th>
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
            @endforeach
          </tbody>
      </table>
    </div>
    <div class="card-footer">

    </div>
  </div>
  
</section>
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script type="text/javascript">
  $(document).ready(function(){


  })
</script>
@endsection

{{-- page scripts --}}
@section('page-scripts')

@endsection