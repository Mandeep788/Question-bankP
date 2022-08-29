<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
                <div class="col-sm-2">
                </div>
            <div class="col-sm-8">
               <form action="{{url('/user_edit')}}" method="POST">
                    @csrf 
                    
                    <div class="form-group">
                        <div class='col-sm-12'>
                            <h2 style="text-align:center; color:blue">Person Details</h2>
                        </div>
                    </div>
                    <div class=row>
                        @foreach ($user as $std)
                        <div class="mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$std->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{$std->email}}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="{{$std->gender}}" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="{{$std->gender}}">
                                <label class="form-check-label" for="exampleRadios2">
                                   Female
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios3" value="{{$std->gender}}">
                                <label class="form-check-label" for="exampleRadios3">
                                   Others
                                </label>
                            </div>
                        </div>
                       
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address_id" value="{{$std->address}}">
                        </div>
                        <button type="submit" class="btn btn-primary"name="submit">Update</button>
                    </div>
                </form>
                @endforeach
            </div>
            <div class="col-sm-2">
            </div>   
        </div>
    </div>
   
  </body>
</html>