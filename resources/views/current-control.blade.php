@extends('layouts.master')

@section('title', 'Vulnerability Prioritization | Self Guard')
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
                <h5 class="m-0">SafeGuards</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="ips_signature">IPS Signature</label>
                  <select class="form-control form-control-sm" id="ips_signature" name="ips_signature" onchange="handelChange(this.value,'ips-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="edr_prevention">EDR Prevention</label>
                  <select class="form-control form-control-sm" id="edr_prevention" name="edr_prevention" 
                  onchange="handelChange(this.value,'edr-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="xdr_prevention">XDR Prevention</label>
                  <select class="form-control form-control-sm" id="xdr_prevention" name="xdr_prevention" 
                  onchange="handelChange(this.value,'xdr-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="sandbox_prevention">Sandbox Prevention</label>
                  <select class="form-control form-control-sm" id="sandbox_prevention" name="sandbox_prevention" 
                  onchange="handelChange(this.value,'sandbox-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="anti_malware_prevention">Anti Malware Prevention</label>
                  <select class="form-control form-control-sm" id="anti_malware_prevention" name="anti_malware_prevention"
                  onchange="handelChange(this.value,'antimalware-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="multi_factor_authentication">Multi Factor Authentication</label>
                  <select class="form-control form-control-sm" id="multi_factor_authentication" name="multi_factor_authentication"
                  onchange="handelChange(this.value,'authentication-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="virtual_patching">Virtual Patching</label>
                  <select class="form-control form-control-sm" id="virtual_patching" name="virtual_patching"
                  onchange="handelChange(this.value,'virtualpatching-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="zero_day_prevention">Zero Day Prevention</label>
                  <select class="form-control form-control-sm" id="zero_day_prevention" name="zero_day_prevention"
                  onchange="handelChange(this.value,'zeroday-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exploit_prevention">Exploit Prevention</label>
                  <select class="form-control form-control-sm" id="exploit_prevention" name="exploit_prevention"
                  onchange="handelChange(this.value,'exploit-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="other">Other</label>
                  <select class="form-control form-control-sm" id="other" name="other"
                  onchange="handelChange(this.value,'other-')">
                    <option value="">None</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <form method="POST" action="{{route('current-control.update')}}" id="current-control-form">
                  @csrf
                  <input type="hidden" name="data" id="data" value="">
                  <button class="btn btn-success btn-sm float-right" type="button" style="margin-top: 30px;" onclick="update()">Update</button>
                </form>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <table id="current-control" class="table display" style="width:100%">
                  <thead>
                      <tr>
                          <th><input type="checkbox" name="select-all" id="select-all"></th>
                          <th>IP Address</th>
                          <th>Host Name FDQN</th>
                          <th>CVE ID</th>
                          <th>IPS</th>
                          <th>EDR</th>
                          <th>XDR</th>
                          <th>Sandbox</th>
                          <th>Anti Malware</th>
                          <th>Authentication</th>
                          <th>Virtual Patching</th>
                          <th>Zero Day</th>
                          <th>Exploit</th>
                          <th>Other</th>
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
<script src="{{asset('js/site/current-control.js')}}"></script>
@endsection