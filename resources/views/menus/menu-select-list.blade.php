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
    <div class="card-header">

    </div>
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
                <td><?= $row['checked'] ? "<button class='btn btn-light-primary'>Selected</button>" : "<button class='btn btn-light-warning'>Unselect</button>" ?></td>
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
@endsection

{{-- page scripts --}}
@section('page-scripts')

@endsection