@extends('layouts.master')

@section('title', 'Vulnerability Prioritization | Home')
@section('page', $page)
@section('css')
<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
@endsection


@section('content')
<div class="container-fluid">
  <!-- Info boxes -->

 <div class="row">
  <div class="col-md-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6">
            <h5 class="m-0">Prioritized Vanalability <span class="badge badge-primary px-2">Top 20</span></h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table id="pv-table" class="table display" style="width:100%">
              <thead>
                  <tr>
                      <th>IP Address</th>
                      <th>Host Name FDQN</th>
                      <th>Vulnerability</th>
                      <th>Solution</th>
                      <th>CVSSV3 Score</th>
                      <th>VPS Vulnerability</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($pv as $row)
                    <tr>
                      <td>
                        {{$row['ip_address'] ?? 'Not Available'}}
                      </td>
                      <td>
                        {{$row['host_name'] ?? 'Not Available'}}
                      </td>
                      <td>
                        {{$row['vulnerability'] ?? 'Not Available'}}
                      </td>
                      <td>
                        {{$row['solution'] ?? 'Not Available'}}
                      </td>
                      <td>
                        {{$row['cvss_v3'] ?? 'Not Available'}}
                      </td>
                      <td>
                        {{$row['vps'] ?? 'Not Available'}}
                      </td>
                    </tr>
                @endforeach
              </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card card-danger card-outline">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6">
            <h5 class="m-0">Asset Exposure Heat Map</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table id="pv-table" class="table display table-borderless table-striped" style="width:100%">
              <thead>
                  <tr>
                      <th>Asset Criticality</th>
                      <th>IPS</th>
                      <th>EDR</th>
                      <th>Anti Malware</th>
                      <th>Other</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($heapMap as $row)
                    <tr>
                      <td>
                        {{ $row['criticality'] ?? 'Not Available'}}
                      </td>
                      <td>
                        {{ round($row['ips_signature'],2).' %' ?? 'Not Available'}}
                      </td>
                      <td>
                        {{ round($row['edr_prevention'],2).' %' ?? 'Not Available'}}
                      </td>
                      <td>
                        {{ round($row['anti_malware_prevention'],2).' %' ?? 'Not Available'}}
                      </td>
                      <td>
                        {{ round($row['other'],2).' %' ?? 'Not Available'}}
                      </td>
                    </tr>
                @endforeach
              </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">

    <div class="card card-danger card-outline">
      <div class="card-header">
        <h3 class="card-title">Affteced Vendors</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <table id="af-table" class="table display table-borderless table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Affteced Vendor</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($affteced_vendors as $key=>$val)
                  <tr>
                    <td>
                      {{ $key }}
                    </td>
                    <td>
                      {{ $val }}
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
          {{-- <div class="col-md-8">
            <div class="chart-responsive">
              <canvas id="pieChart" height="150"></canvas>
            </div>
            <!-- ./chart-responsive -->
          </div> --}}
          {{-- <div class="col-md-4">
            <ul class="chart-legend clearfix">
              <li><i class="far fa-circle text-danger"></i> Chrome</li>
              <li><i class="far fa-circle text-success"></i> IE</li>
              <li><i class="far fa-circle text-warning"></i> FireFox</li>
              <li><i class="far fa-circle text-info"></i> Safari</li>
              <li><i class="far fa-circle text-primary"></i> Opera</li>
              <li><i class="far fa-circle text-secondary"></i> Navigator</li>
            </ul>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
</div>

  {{-- <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Monthly Recap Report</h5>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-wrench"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right" role="menu">
                <a href="#" class="dropdown-item">Action</a>
                <a href="#" class="dropdown-item">Another action</a>
                <a href="#" class="dropdown-item">Something else here</a>
                <a class="dropdown-divider"></a>
                <a href="#" class="dropdown-item">Separated link</a>
              </div>
            </div>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
              </div>
              <!-- /.chart-responsive -->
            </div>
            <!-- /.col -->
          </div>
        </div>
      </div>
    </div>
  </div> --}}

  {{-- <!-- Main row -->
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Browser Usage</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <div class="chart-responsive">
                <canvas id="pieChart" height="150"></canvas>
              </div>
              <!-- ./chart-responsive -->
            </div>
            <div class="col-md-4">
              <ul class="chart-legend clearfix">
                <li><i class="far fa-circle text-danger"></i> Chrome</li>
                <li><i class="far fa-circle text-success"></i> IE</li>
                <li><i class="far fa-circle text-warning"></i> FireFox</li>
                <li><i class="far fa-circle text-info"></i> Safari</li>
                <li><i class="far fa-circle text-primary"></i> Opera</li>
                <li><i class="far fa-circle text-secondary"></i> Navigator</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
</div>
@endsection

@section('js')
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- OPTIONAL SCRIPTS -->
  <script src="dist/js/demo.js"></script>
  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>

  <!-- PAGE SCRIPTS -->
  <script src="dist/js/pages/dashboard2.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>

  <script src="{{asset('js/site/dahboard.js')}}"></script>
@endsection