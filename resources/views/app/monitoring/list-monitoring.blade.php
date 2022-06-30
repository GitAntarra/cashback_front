
@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Monitoring')
{{-- vendor css --}}

@section('content')
<!-- Contextual classes start -->
<div class="row" id="table-contexual">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-6">
            <form action="{{route('searchMonit.post')}}" method="POST">
              @csrf
            <div class="col-12 pt-1">
              <div class="row">
                <div class="col-md-3">
                  <label class="pt-1">External ID</label>
                </div>  
                <div class="col-md-9">
                <input type="text" name="externalid" id="externalid" placeholder="Search by external id" value="{{($externalid) ? $externalid : '' }}" class="form-control" min="1">
                  </fieldset>
                </div>
              </div>
            </div>
            <div class="col-12 pt-1">
              <div class="row">
                <div class="col-md-3">
                  <label class="pt-1">Date</label>
                </div>  
                <div class="col-md-9">
                <input type="date" name="dateMonit" id="dateMonit" value="{{$dates}}" class="form-control" min="1">
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="col-12 pt-1">
              <div class="row">
                <div class="col-md-3">
                  <label class="pt-1">Request By</label>
                </div>  
                <div class="col-md-9">
                  <input type="text" name="requestby" id="requestby" value="{{($requestby) ? $requestby : '' }}" placeholder="Search by personal number" class="form-control" oninput="allow_number(this)" title="Please Enter on Number Only">
                </div>
              </div>
            </div>
            <div class="col-12 pt-1">
              <div class="row">
                <div class="col-md-3">
                  <label class="pt-1">Response Code</label>
                </div>  
                <div class="col-md-9">
                  <input type="number" name="responsecode" placeholder="Search by response code" min="1" id="responsecode" value="{{($responsecode) ? $responsecode : '' }}" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 pt-1">
            <div class="row justify-content-center">
              <button type="submit" title="Find" name="find" value="1" class="btn btn-primary glow mr-sm-1 mb-1"><i class="bx bx-search"></i> Find</button>
              <button type="submit" title="Show All" name="all" value="1" class="btn btn-success glow mr-sm-1 mb-1"><i class="bx bx-list-ul"></i> Show All</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <hr>
      <div class="card-content">
        <!-- table contextual / colored -->
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>No</th>
                <th>External ID</th>
                <th>Date</th>
                <th>Channel ID</th>
                <th>Service ID</th>
                <th>Terminal ID</th>
                <th>Device Name</th>
                <th>Request By</th>
                <th>Response Code</th>
                <th>Response Message</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($datamonit) && isset($datamonit))
              @foreach($datamonit as $row)
              <tr class="{{ ($row['response_code'] == 00) ? 'table-active' : 'table-warning' }}">
                <td>{{$number++}}</td>
                <td class="text-bold-500">{{$row['external_id']}}</td>
                <td>{{date('Y-m-d', strtotime($row['created_at']))}}</td>
                <td>{{$row['channel_id']}}</td>
                <td class="text-bold-500">{{$row['service_id']}}</td>
                <td>{{$row['terminal_id']}}</td>
                <td>{{$row['device_name']}}</td>
                <td>{{$row['request_by']}}</td>
                <td>{{$row['response_code']}}</td>
                <td>{{$row['response_msg']}}</td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="10" align="center">No Result Data!</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row pt-1">
      <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page {{$page}} of {{$meta->pageCount}} | Total Data : {{$meta->itemCount}}</div>
      </div>
      <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
          <ul class="pagination">
            <li class="paginate_button page-item previous <?php if($meta->hasPreviousPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_previous">
                <a class="page-link" href="<?php echo asset('/monitoring').'?page='.$prevPage.'&take='.$take; ?>"><i class='bx bx-chevrons-left'></i>Prev</a>
            </li>
            <li class="paginate_button page-item next <?php if($meta->hasNextPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_next">
                <a class="page-link" href="<?php echo asset('/monitoring').'?page='.$nextPage.'&take='.$take; ?>">Next<i class='bx bx-chevrons-right'></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contextual classes end -->

@endsection


@section('vendor-scripts')
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  function allow_number(element){
      let textInput = element.value;
      textInput = textInput.replace(/[^0-9]/gm, ""); 
      element.value = textInput;
  }


</script>
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
@endsection

