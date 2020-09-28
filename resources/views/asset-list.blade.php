@extends('layouts.master')

@section('title', 'Vulnerability Prioritization | Asset List')
@section('page', $page)

@section('content')
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <p>{{ $message }}</p>
  <button type="button" class="close close-btn-alert" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <script type="text/javascript">
   setTimeout(() => {
      $('.close-btn-alert').trigger('click');
   }, 5000);
  </script>
</div>
@endif
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <p>{{ $message }}</p>
  <button type="button" class="close close-btn-alert" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <script type="text/javascript">
    setTimeout(() => {
       $('.close-btn-alert').trigger('click');
    }, 5000);
   </script>
</div>
@endif
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">
                <h5 class="m-0">Assets Lists</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="criticality">Criticality</label>
                  <select class="form-control form-control-sm" id="criticality" name="criticality" onchange="criticality(this.value)">
                    <option value="">None</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exposure">Exposure</label>
                  <select class="form-control form-control-sm" id="exposure" name="exposure" onchange="exposure(this.value)">
                    <option value="">None</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <form method="POST" action="{{route('asset.lists.update')}}" id="asset-list-form">
                  @csrf
                  <input type="hidden" name="data" id="data" value="">
                  <button class="btn btn-success btn-sm float-right" type="button" style="margin-top: 30px;" onclick="update()">Update</button>
                </form>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <table id="asset-list" class="table display" style="width:100%">
                  <thead>
                      <tr>
                          <th><input type="checkbox" name="select-all" id="select-all"></th>
                          <th>IP Address</th>
                          <th>Host Name FDQN</th>
                          <th>Severity</th>
                          <th>Protocol</th>
                          <th>Port</th>
                          <th>CVSSV3 Score</th>
                          <th>CVE ID</th>
                          <th>Criticality</th>
                          <th>Exposure</th>
                      </tr>
                  </thead>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

@endsection

@section('js')
<script src="{{asset('js/site/asset-lists.js')}}"></script>
@endsection