@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Bootstrap Tables')
@section('content')
<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Basic TablesSS</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <p class="card-text">Using the most basic table up, here’s how
            <code>.table</code>-based tables look in Bootstrap. You can use any example
            of below table for your table and it can be use with any type of bootstrap tables.</p>
          <p><span class="text-bold-600">Example 1:</span> Table with outer spacing</p>
          <!-- Table with outer spacing -->
          <div class="table-responsive">
            <table class="table">
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
                <tr>
                  <td class="text-bold-500">Michael Right</td>
                  <td>$15/hr</td>
                  <td class="text-bold-500">UI/UX</td>
                  <td>Remote</td>
                  <td>Austin,Taxes</td>
                  <td><a href="#"><i
                        class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
                </tr>
                <tr>
                  <td class="text-bold-500">Morgan Vanblum</td>
                  <td>$13/hr</td>
                  <td class="text-bold-500">Graphic concepts</td>
                  <td>Remote</td>
                  <td>Shangai,China</td>
                  <td><a href="#"><i
                        class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
                </tr>
                <tr>
                  <td class="text-bold-500">Tiffani Blogz</td>
                  <td>$15/hr</td>
                  <td class="text-bold-500">Animation</td>
                  <td>Remote</td>
                  <td>Austin,Texas</td>
                  <td><a href="#"><i
                        class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
                </tr>
                <tr>
                  <td class="text-bold-500">Ashley Boul</td>
                  <td>$15/hr</td>
                  <td class="text-bold-500">Animation</td>
                  <td>Remote</td>
                  <td>Austin,Texas</td>
                  <td><a href="#"><i
                        class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
                </tr>
                <tr>
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
        <p class="px-2"><span class="text-bold-600">Example 2:</span> Minimal Table with no outer spacing.</p>

        <!-- Table with no outer spacing -->
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
              <tr>
                <td class="text-bold-500">Michael Right</td>
                <td>$15/hr</td>
                <td class="text-bold-500">UI/UX</td>
                <td>Remote</td>
                <td>Austin,Taxes</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr>
                <td class="text-bold-500">Morgan Vanblum</td>
                <td>$13/hr</td>
                <td class="text-bold-500">Graphic concepts</td>
                <td>Remote</td>
                <td>Shangai,China</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr>
                <td class="text-bold-500">Tiffani Blogz</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr>
                <td class="text-bold-500">Ashley Boul</td>
                <td>$15/hr</td>
                <td class="text-bold-500">Animation</td>
                <td>Remote</td>
                <td>Austin,Texas</td>
                <td><a href="#"><i
                      class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
              </tr>
              <tr>
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
<!-- Basic Tables end -->

@endsection