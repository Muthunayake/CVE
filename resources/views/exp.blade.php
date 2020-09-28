@extends('layouts.master')

@section('title', 'Vulnerability Prioritization | EXPLOIT')
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
                <h5 class="m-0">EXPLOIT</h5>
              </div>
              <div class="col-md-6">
                <div class="row justify-content-end">
                  <div class="col-auto">
                    <a href="{{asset('/format/exp.csv')}}" target="_blank" class="btn btn-primary btn block btn-sm"><i class="fa fa-cloud-download"></i> Download Sample Format</a>
                  </div>
                  <div class="col-auto">
                    <form action="{{route('exp.upload')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="file" name="exp_csv" id="exp_csv" accept=".csv">
                      <button disabled class="btn btn-primary btn-sm" type="submit" id="upload-btn" onclick="blockUiFullPage()"><i class="fa fa-cloud-upload"></i> Upload</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <table id="exp" class="table display" style="width:100%">
                  <thead>
                      <tr>
                          <th style="width: 8%">Exploit</th>
                          <th style="width: 8%">CVE ID</th>
                          <th style="width: 8%">Action</th>
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


  <div class="modal fade exp-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update EXPLOIT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="exp-from">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exploit" class="col-form-label">Exploit</label>
                  <select id="exploit" name="exploit" class="form-control-sm form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="cve" class="col-form-label">CVE ID</label>
                  <textarea type="text" class="form-control-sm form-control" id="cve_id" name="cve_id" placeholder="Enter CVE">
                  </textarea>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
          <button type="submit" class="btn btn-primary" onclick="blockUiFullPage();closeModal();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{asset('js/site/exp.js')}}"></script>
@endsection