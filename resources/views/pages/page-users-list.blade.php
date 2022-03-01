@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','User Management')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection
@section('content')
<!-- users list start -->
<section class="users-list-wrapper">
  <div class="users-list-filter px-1">
    <form>
      <!-- <div class="row border rounded py-2 mb-2">
        <div class="col-12 col-sm-6 col-lg-3">
          <label for="users-list-verified">Verified</label>
          <fieldset class="form-group">
            <select class="form-control" id="users-list-verified">
                <option value="">Any</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
          </fieldset>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <label for="users-list-role">Role</label>
          <fieldset class="form-group">
            <select class="form-control" id="users-list-role">
              <option value="">Any</option>
              <option value="User">User</option>
              <option value="Staff">Staff</option>
            </select>
          </fieldset>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <label for="users-list-status">Status</label>
          <fieldset class="form-group">
            <select class="form-control" id="users-list-status">
              <option value="">Any</option>
              <option value="Active">Active</option>
              <option value="Close">Close</option>
              <option value="Banned">Banned</option>
            </select>
          </fieldset>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
          <button type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0">Clear</button>
        </div>
      </div> -->
    </form>
  </div>
  <div class="users-list-table">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <!-- datatable start -->
          <div class="table-responsive">
            <table id="users-list-datatable" class="table">
              <thead>
                <tr>
                    <th>PERNR</th>
                    <th>NAME</th>
                    <th>UKER</th>
                    <th>LEVEL</th>
                    <th>BRANCH</th>
                    <th>OFFICE</th>
                    <th>STATUS</th>
                    <!-- <th>edit</th> -->
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>300</td>
                  <td><a href="{{asset('page-users-view')}}">dean3004</a>
                  </td>
                  <td>Dean Stanley</td>
                  <td>30/04/2019</td>
                  <td>No</td>
                  <td>Staff</td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <!-- <tr>
                  <td>301</td>
                  <td><a href="{{asset('page-users-view')}}">zena0604</a>
                  </td>
                  <td>Zena Buckley</td>
                  <td>06/04/2020</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <td><a href="{{asset('page-users-edit')}}"><i
                                class="bx bx-edit-alt"></i></a></td>
                </tr>
                <tr>
                  <td>302</td>
                  <td><a href="{{asset('page-users-view')}}">delilah0301</a>
                  </td>
                  <td>Delilah Moon</td>
                  <td>03/01/2020</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td>
                </tr> -->
                <!-- <tr>
                  <td>303</td>
                  <td><a href="{{asset('page-users-view')}}">hillary1807</a>
                  </td>
                  <td>Hillary Rasmussen</td>
                  <td>18/07/2019</td>
                  <td>No</td>
                  <td>Staff</td>
                  <td><span class="badge badge-light-danger">Banned</span></td>
                  <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td>
                </tr>
                <tr>
                  <td>304</td>
                  <td><a href="{{asset('page-users-view')}}">herman2003</a>
                  </td>
                  <td>Herman Tate</td>
                  <td>20/03/2020</td>
                  <td>No</td>
                  <td>Staff</td>
                  <td><span class="badge badge-light-danger">Banned</span></td>
                  <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td>
                </tr> -->
                <!-- <tr>
                  <td>305</td>
                  <td><a href="{{asset('page-users-view')}}">kuame3008</a>
                  </td>
                  <td>Kuame Ford</td>
                  <td>30/08/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td>
                </tr>
                <tr>
                  <td>306</td>
                  <td><a href="{{asset('page-users-view')}}">fulton2009</a>
                  </td>
                  <td>Fulton Stafford</td>
                  <td>20/09/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td>
                </tr> -->
                <tr>
                  <td>319</td>
                  <td><a href="{{asset('page-users-view')}}">gray2702</a>
                  </td>
                  <td>Gray Valenzuela</td>
                  <td>27/02/2020</td>
                  <td>No</td>
                  <td>Staff</td>
                  <td><span class="badge badge-light-warning">Close</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>320</td>
                  <td><a href="{{asset('page-users-view')}}">hoyt0305</a>
                  </td>
                  <td>Hoyt Ellison</td>
                  <td>03/05/2020</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>321</td>
                  <td><a href="{{asset('page-users-view')}}">damon0209</a>
                  </td>
                  <td>Damon Berry</td>
                  <td>02/09/2019</td>
                  <td>No</td>
                  <td>Staff</td>
                  <td><span class="badge badge-light-danger">Banned</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>322</td>
                  <td><a href="{{asset('page-users-view')}}">kelsie0511</a>
                  </td>
                  <td>Kelsie Dunlap</td>
                  <td>05/11/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-warning">Close</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                                class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>323</td>
                  <td><a href="{{asset('page-users-view')}}">abel1606</a>
                  </td>
                  <td>Abel Dunn</td>
                  <td>16/06/2020</td>
                  <td>No</td>
                  <td>Staff</td>
                  <td><span class="badge badge-light-danger">Banned</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>324</td>
                  <td><a href="{{asset('page-users-view')}}">nina2208</a>
                  </td>
                  <td>Nina Byers</td>
                  <td>22/08/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-warning">Close</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>325</td>
                  <td><a href="{{asset('page-users-view')}}">erasmus1809</a>
                  </td>
                  <td>Erasmus Walter</td>
                  <td>18/09/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>326</td>
                  <td><a href="{{asset('page-users-view')}}">yael2612</a>
                  </td>
                  <td>Yael Marshall</td>
                  <td>26/12/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-warning">Close</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>327</td>
                  <td><a href="{{asset('page-users-view')}}">thomas2012</a>
                  </td>
                  <td>Thomas Dudley</td>
                  <td>20/12/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>328</td>
                  <td><a href="{{asset('page-users-view')}}">althea2810</a>
                  </td>
                  <td>Althea Turner</td>
                  <td>28/10/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>329</td>
                  <td><a href="{{asset('page-users-view')}}">jena2206</a>
                  </td>
                  <td>Jena Schroeder</td>
                  <td>22/06/2019</td>
                  <td>No</td>
                  <td>Staff</td>
                  <td><span class="badge badge-light-danger">Banned</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>330</td>
                  <td><a href="{{asset('page-users-view')}}">hyacinth2201</a>
                  </td>
                  <td>Hyacinth Maxwell</td>
                  <td>22/01/2019</td>
                  <td>No</td>
                  <td>Staff</td>
                  <td><span class="badge badge-light-danger">Banned</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>331</td>
                  <td><a href="{{asset('page-users-view')}}">madeson1907</a>
                  </td>
                  <td>Madeson Byers</td>
                  <td>19/07/2020</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>332</td>
                  <td><a href="{{asset('page-users-view')}}">elmo0707</a>
                  </td>
                  <td>Elmo Tran</td>
                  <td>07/07/2020</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                <tr>
                  <td>333</td>
                  <td><a href="{{asset('page-users-view')}}">shelley0309</a>
                  </td>
                  <td>Shelley Eaton</td>
                  <td>03/09/2019</td>
                  <td>Yes</td>
                  <td>User </td>
                  <td><span class="badge badge-light-success">Active</span></td>
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
              </tbody>
            </table>
          </div>
          <!-- datatable ends -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
@endsection