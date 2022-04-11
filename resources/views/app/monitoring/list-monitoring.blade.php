@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Bootstrap Tables')
@section('content')
<!-- Contextual classes start -->
<div class="row" id="table-contexual">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Monitoring</h4>
      </div>
      <div class="card-content">
        <!-- table contextual / colored -->
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th>NAME</th>
                <th>RATE</th>
                <th>SKILL</th>
                <th>TYPE</th>
                <th>LOCATION</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-active">
                <td class="text-bold-500">Michael Right</td>
                <td>$15/hr</td>
                <td class="text-bold-500">UI/UX</td>
                <td>Remote</td>
                <td>Austin,Taxes</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr class="table-primary">
                <td class="text-bold-500">Morgan Vanblum</td>
                <td>$13/hr</td>
                <td class="text-bold-500">Graphic concepts</td>
                <td>Remote</td>
                <td>Shangai,China</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr class="table-secondary">
                <td class="text-bold-500">Tiffani Blogz</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr class="table-success">
                <td class="text-bold-500">Ashley Boul</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr class="table-danger">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr class="table-warning">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr class="table-info">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr class="table-light">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr class="table-dark">
                <td class="text-bold-500">Mikkey Mice</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contextual classes end -->

@endsection