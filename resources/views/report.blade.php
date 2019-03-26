<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body>
  <div class="container">
    <div class="row justify-content-center mt-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center">Gate Entry</h3>
          </div>

          <div class="card-body">
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
                @foreach ($data as $info)
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
      </div>
    </div>
  </div>

</body>
</html>
