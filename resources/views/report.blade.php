<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    .page-break {
        page-break-after: always;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-3">
        <div class="card-body">
          <h5 class="card-header text-center">Gate Entry</h5>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>Category</th>
                <th>Gate In</th>
                <th>Gate Out</th>
                <th>Gate Pass</th>
                <th>Created At</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($gedata as $info)
                <tr>
                  <td>{{  ucfirst($info->category) }}</td>
                  <td>{{ $info->gateIn }}</td>
                  <td>{{ $info->gateOut }}</td>
                  <td>{{ $info->gatePass }}</td>
                  <td>{{ $info->created_at->format('d/m/Y') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="row justify-content-center mt-3">
      <div class="card-body">
        <h5 class="card-title text-center">Yarn Store</h5>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Color</th>
              <th>Fiber Content</th>
              <th>Weight</th>
              <th>Yardage/Ball</th>
              <th>Gauge</th>
              <th>Care</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($ysdata as $info)
              <tr>
                <td>{{ $info->color }}</td>
                <td>{{ $info->fiber_content }}</td>
                <td>{{ $info->weight }}</td>
                <td>{{ $info->yardageORball }}</td>
                <td>{{ $info->gauge }}</td>
                <td>{{ $info->care }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="page-break"></div>

    <div class="row justify-content-center mt-3">
      <div class="card-body">
        <h5 class="card-title text-center">Grey Fabric Store</h5>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Content</th>
              <th>Quantity</th>
              <th>Width</th>
              <th>Care</th>
              <th>Created At</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($gfdata as $info)
              <tr>
                <td>{{ $info->fabric_content }}</td>
                <td>{{ $info->quantity }}</td>
                <td>{{ $info->width }}"</td>
                <td>{{ $info->care }}</td>
                <td>{{ $info->created_at->format('d/m/Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="page-break"></div>

    <div class="row justify-content-center mt-3">
      <div class="card-body">
        <h5 class="card-title text-center">Finish Fabric Store</h5>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Classification</th>
              <th>Status</th>
              <th>Created At</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($ffdata as $info)
              <tr>
                <td>{{ $info->classification }}</td>
                <td>{{ $info->status }}</td>
                <td>{{ $info->created_at->format('d/m/Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="page-break"></div>

    <div class="row justify-content-center mt-3">
      <div class="card-body">
        <h5 class="card-title text-center">Dyes and Chemical Store</h5>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Color</th>
              <th>Classification</th>
              <th>Dyes</th>
              <th>Concentration(%)</th>
              <th>Bulk Density(kg/m3)</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($dcdata as $info)
              <tr>
                <td>{{ $info->color }}</td>
                <td>{{ $info->classification }}</td>
                <td>{{ $info->dyes }}</td>
                <td>{{ $info->concentration }}</td>
                <td>{{ $info->bulk_density }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
