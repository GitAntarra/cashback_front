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
    <div class="row justify-content-end">
                    <div class="col-md-4 col-sm-12 form-group">
                      <label for="Email">Level </label>
                      <select class="form-control" id="levelSelected" name="levelSelected" required>
                        @foreach ($opt_level as $key => $value) 
                        <option value="{{ $key }}" {{ ( $key == $selectedLevel) ? 'selected' : '' }}>  
                          {{ $value }}  
                        </option> 
                          @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-12 form-group">
                      <label for="password">Work Unit</label>
                      <select class="form-control" id="ukerSelected" name="ukerSelected" required>
                        @foreach ($opt_uker as $key => $value) 
                        <option value="{{ $key }}" {{ ( $key == $selectedUker) ? 'selected' : '' }}>  
                          {{ $value }}  
                        </option> 
                          @endforeach
                      </select>
                    </div>
                  </div>
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
                <td><?= $row['checked'] ? "<button idMenu='{$row['id']}' class='btn btn-light-primary selectButton' onClick='selectMenu({$row['id']})' >Selected</button>" : "<button idMenu='{$row['id']}'  class='btn btn-light-warning selectButton' onClick='selectMenu({$row['id']})'>Unselect</button>" ?></td>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $('#selectButton').click(function(e) {
    //   let level = $("#levelSelected").val();
    //   let uker = $("#ukerSelected").val();
    //   var elmnt = document.getElementById("selectButton");
    //   let idMenu = elmnt.getAttribute("idMenu");
    //   alert(idMenu);

      
    // });

    
  });
  function selectMenu(id)
    {
      let level = $("#levelSelected").val();
      let uker = $("#ukerSelected").val();
      alert(id+level+uker);
    }
</script>
@endsection

{{-- page scripts --}}
@section('page-scripts')

@endsection