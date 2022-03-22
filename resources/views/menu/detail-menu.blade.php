@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Bootstrap Tables')
@section('content')
<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row ">
            <div class="col-6">
                <a href="javascript:history.back()" class="btn btn-primary" title="Back"><i class="bx bx-left-arrow-alt"></i> Back</a>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Nama menu..."/>    
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" title="Find"><i class="bx bx-search"></i> Find</button>
                        <button type="button" class="btn btn-success" title="Add Menu" data-toggle="modal" data-target="#addSecondModalform"><i class="bx bx-plus"></i> Add</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="card-content">    
        <div class="card-body">
          <!-- Table with outer spacing -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th width="30%">TYPE</th>
                  <th width="45%">NAME</th>
                  <th width="25%">ACTION</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($listOpt) && !empty($listOpt))
                @for($i = 0; $i < count($listOpt); $i++ )
                <tr>
                    <td class="text-bold-500">{{$listOpt[$i]['type']}}</td>
                    <td>{{$listOpt[$i]['name']}}</td>
                    <td>
                        <button class="btn btn-primary" title="Edit Menu"><i class="bx bx-edit-alt"></i></button>
                        <button class="btn btn-danger" title="Delete Menu"><i class="bx bx-trash"></i> </button>
                    </td>
                </tr>
                @endfor
                @else
                <tr>
                <td colspan="3" align="center">No Result</td>

                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Basic Tables end -->

<!-- Modal Form-->
<div class="modal fade text-left" id="addSecondModalform" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="exampleModalScrollableTitle">Add Menu </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="bx bx-x"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('addhrefMenu.post') }}" name="addmenusec" value="addmenusec" method="post">
            @csrf
            <input type="text" value="addMenuSec" name="addmenusec" id="addmenusec" hidden>
            <input type="text" value="{{$idMenu}}" name="idMenu" id="idMenu" hidden>
            <div class="col-12" id="formname">
            <label>Nama Menu </label>
            <div class="form-group">
                <input name="menuNameSec" id="menuNameSec" type="text" placeholder="Nama Menu" class="form-control" require>
            </div>
            </div>
            <div class="col-12" id="formurl">
            <label>Url</label>
            <div class="form-group"><input name="urlMenuSec" id="urlMenuSec" type="text" placeholder="Url Menu" class="form-control" require></div>
            </div>
            <div class="col-12" id="formlng">
            <label>Il8n Menu</label>
            <div class="form-group"><input name="lngMenuSec" id="lngMenuSec" type="text" placeholder="Il8n Menu" class="form-control" require></div>
            </div>
            <div class="col-12" id="formicon">
            <label>Icon</label>
            <div class="form-group"><input name="iconMenuSec" id="iconMenuSec" type="text" placeholder="Icon Menu" class="form-control" require></div>
            </div>
            <div class="col-12" id="formtag">
            <label>Tag Custom</label>
            <div class="form-group"><input name="tagMenuSec" id="tagMenuSec" type="text" placeholder="Tag Custom" class="form-control" require></div>
            </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Add</span>
                </button>
        </form>
        </div>
        </div>
    </div>
</div>

@endsection