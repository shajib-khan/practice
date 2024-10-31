<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <div class="container">

        <a class="btn btn-primary m-3"href="{{ url('/add-data') }}">Add Data</a>
        <form action="{{ url('/search') }}" method="GET">
            <div class="input-group">
                <div class="form-outline" data-mdb-input-init>
                  <input type="search" name="search" class="form-control" />
                <button type="button" class="btn btn-primary mt-2">Search </button>
              </div>
            </div>
        </form>
        @if(session()->has('DeleteData'))
        <div class="alert alert-success">
            {{ session()->get('DeleteData') }}
        </div>
    @endif
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($showData as $data)
              <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td><img src="/image/products/{{ $data->image}}" height="100px" width="100px" /></td>

                <td><a class="btn btn-primary"onclick="return confirm('Are you sure you want to edit this item?')" href="{{ url('/edit-data/'.$data->id) }}">Edit</a></td>
                <td><a class="btn btn-danger"onclick="return confirm('Are you sure you want to delete this item?')" href="{{ url('/delete-data/'.$data->id) }}">Delete</a></td>
              </tr>

              @endforeach
            </tbody>
          </table>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
