@extends('layouts.master')

@section('title', 'Vulnerability Prioritization | Scan Data')
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
                <h5 class="m-0">Scan Data</h5>
              </div>
              <div class="col-md-6">
                <div class="row justify-content-end">
                  <div class="col-auto">
                    <a href="{{asset('/format/scan_data.csv')}}" target="_blank" class="btn btn-primary btn block btn-sm"><i class="fa fa-cloud-download"></i> Download Sample Format</a>
                  </div>
                  <div class="col-auto">
                    <form action="{{route('scan.data.upload')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="file" name="scan_csv" id="scan_csv" accept=".csv">
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
                <table id="scan-data" class="table display" style="width:100%">
                  <thead>
                      <tr>
                          <th>IP Address</th>
                          <th>Host Name FDQN</th>
                          <th>VULN Name</th>
                          <th>Severity</th>
                          <th>Protocol</th>
                          <th>Port</th>
                          <th>Vulnerability</th>
                          <th>Solution</th>
                          <th>CVSSV3 Score</th>
                          <th>CVE ID</th>
                          <th>Action</th>
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


  <div class="modal fade sacn-data-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Scan Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="scan-data-from">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="ip_address" class="col-form-label">IP Address</label>
                  <input type="text" class="form-control-sm form-control" id="ip_address" name="ip_address" placeholder="Enter IP Address">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="host_name_fdqn" class="col-form-label">Host Name FDQN</label>
                  <input type="text" class="form-control-sm form-control" id="host_name_fdqn" name="host_name_fdqn" placeholder="Enter Host Name FDQN">
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="vuln_name" class="col-form-label">VULN Name</label>
                  <textarea class="form-control-sm form-control" id="vuln_name" name="vuln_name" rows="2" placeholder="Enter VULN Name"></textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="severity" class="col-form-label">Severity</label>
                  <input type="text" class="form-control-sm form-control" id="severity" name="severity" placeholder="Enter Severity">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="protocol" class="col-form-label">Protocol</label>
                  <input type="text" class="form-control-sm form-control" id="protocol" name="protocol" placeholder="Enter Protocol">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="port" class="col-form-label">Port</label>
                  <input type="text" class="form-control-sm form-control" id="port" name="port" placeholder="Enter Port">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="vulnerability" class="col-form-label">Vulnerability</label>
                  <textarea class="form-control-sm form-control" id="vulnerability" name="vulnerability" rows="2" placeholder="Enter Vulnerability"></textarea>
                </div>
              </div>
            </div>
           
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="solution" class="col-form-label">Solution</label>
                  <textarea class="form-control-sm form-control" id="solution" name="solution" rows="2" placeholder="Enter Solution"></textarea>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cvssv3_score" class="col-form-label">CVSSV3 Score</label>
                  <input type="number" step=".01" class="form-control-sm form-control" id="cvssv3_score" name="cvssv3_score" placeholder="Enter CVSSV3 Score">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cve_id" class="col-form-label">CVE ID</label>
                  <input type="text" class="form-control-sm form-control" id="cve_id" name="cve_id" placeholder="Enter CVE ID">
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
<script src="{{asset('js/site/scan-data.js')}}"></script>
@endsection