@extends('layouts.master')

@section('title', 'Vulnerability Prioritization | Upload')
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
                <h5 class="m-0">Upload Files</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <h5>Zero Days</h5>
                  </div>
                  <div class="col-auto">
                    <a href="{{asset('/format/zero_days.csv')}}" target="_blank" class="btn btn-primary btn block btn-sm"><i class="fa fa-cloud-download"></i> Download Sample Format</a>
                  </div>
                  <div class="col-auto">
                    <form action="{{route('upload.zero.day')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="file" name="zero_day_csv" id="zero_day_csv" accept=".csv">
                      <button disabled class="btn btn-primary btn-sm" type="submit" id="upload-btn-1" onclick="blockUiFullPage()"><i class="fa fa-cloud-upload"></i> Upload</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <h5>Active Exploit</h5>
                  </div>
                  <div class="col-auto">
                    <a href="{{asset('/format/active_exploits.csv')}}" target="_blank" class="btn btn-primary btn block btn-sm"><i class="fa fa-cloud-download"></i> Download Sample Format</a>
                  </div>
                  <div class="col-auto">
                    <form action="{{route('upload.active.exploit')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="file" name="active_exp_csv" id="active_exp_csv" accept=".csv">
                      <button disabled class="btn btn-primary btn-sm" type="submit" id="upload-btn-2" onclick="blockUiFullPage()"><i class="fa fa-cloud-upload"></i> Upload</button>
                    </form>
                  </div>
                </div>
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
<script src="{{asset('js/site/upload.js')}}"></script>
@endsection