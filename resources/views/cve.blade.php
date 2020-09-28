@extends('layouts.master')

@section('title', 'Vulnerability Prioritization | CVE')
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
                <h5 class="m-0">CVE</h5>
              </div>
              <div class="col-md-6">
                <div class="row justify-content-end">
                  <div class="col-auto">
                    <a href="{{asset('/format/cve.csv')}}" target="_blank" class="btn btn-primary btn block btn-sm"><i class="fa fa-cloud-download"></i> Download Sample Format</a>
                  </div>
                  <div class="col-auto">
                    <form action="{{route('cve.upload')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="file" name="cve_csv" id="cve_csv" accept=".csv">
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
                <table id="cve" class="table display" style="width:100%">
                  <thead>
                      <tr>
                          <th>Severity V2</th>
                          <th>Severity V2</th>
                          <th>Type</th>
                          <th>Title</th>
                          <th>Cve</th>
                          <th>CVSS V2</th>
                          <th>CVSS V3</th>
                          <th>CWE ID</th>
                          <th>CWE Label</th>
                          <th>Affected Vendors</th>
                          <th>Affected CPES</th>
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


  <div class="modal fade cve-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update CVE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="cve-from">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="severity_v2" class="col-form-label">Severity V2</label>
                  <input type="text" class="form-control-sm form-control" id="severity_v2" name="severity_v2" placeholder="Enter Severity V2">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="severity_v3" class="col-form-label">Severity V3</label>
                  <input type="text" class="form-control-sm form-control" id="severity_v3" name="severity_v3" placeholder="Enter Severity V3">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="type" class="col-form-label">Type</label>
                  <input type="text" class="form-control-sm form-control" id="type" name="type" placeholder="Enter Type">
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="title" class="col-form-label">Title</label>
                  <textarea class="form-control-sm form-control" id="title" name="title" rows="2" placeholder="Enter Title"></textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cve" class="col-form-label">Cve</label>
                  <input type="text" class="form-control-sm form-control" id="cve" name="cve" placeholder="Enter Cve">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cvss_v2" class="col-form-label">CVSS V2</label>
                  <input type="text" class="form-control-sm form-control" id="cvss_v2" name="cvss_v2" placeholder="Enter CVSS V2">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cvss_v3" class="col-form-label">CVSS V3</label>
                  <input type="text" class="form-control-sm form-control" id="cvss_v3" name="cvss_v3" placeholder="Enter CVSS V3">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cwe_id" class="col-form-label">CWE ID</label>
                  <input type="text" class="form-control-sm form-control" id="cwe_id" name="cwe_id" placeholder="Enter CWE ID">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cwe_label" class="col-form-label">CWE Label</label>
                  <textarea class="form-control-sm form-control" id="cwe_label" name="cwe_label" rows="2" placeholder="Enter CWE Label"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="affected_vendors" class="col-form-label">Affected Vendors</label>
                  <textarea class="form-control-sm form-control" id="affected_vendors" name="affected_vendors" rows="2" placeholder="Enter Affected Vendors"></textarea>
                </div>
              </div>
            </div>
           
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="affected_cpes" class="col-form-label">Affected CPES</label>
                  <textarea class="form-control-sm form-control" id="affected_cpes" name="affected_cpes" rows="2" placeholder="Enter Affected CPES"></textarea>
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
<script src="{{asset('js/site/cve.js')}}"></script>
@endsection