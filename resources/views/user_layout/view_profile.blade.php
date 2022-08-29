<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>View Profile</title>
  </head>
  <body>
    @foreach($users as $item)
    <form action="{{route('view_profile')}}" method="GET">
        @csrf 
        @method('GET')
        <div class="form-group">
            <div class='col-sm-12'>
                <h2 style="text-align:center; color:blue">View Profile</h2>
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name_id" value="{{$item->name}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{$item->email}}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address_id" value="{{$item->address}}">
        </div>
        <div class="mb-3">
              <label for="gender" class="form-label">Gender</label>
              <div class="form-check">
                    <input class="text" name="exampleRadios"  value="{{$item->gender}}"/>
              </div>
        </div>
        <button type="submit" class="btn btn-primary" onclick="{{url('sidebar')}}" name="submit">Back</button>
      </form>
      @endforeach
    
  </body>
</html>