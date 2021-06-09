<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			  <div class="container-fluid">
			    <a class="navbar-brand" href="{{ route('admin.profile')}}">Admin Profile</a>
			    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse" id="navbarText">
			      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
			        <li class="nav-item">
			           
			      <!--  <a class="nav-link" href="addadmin.php"><button type="button" class="btn btn-info" >Add Admin</button></a> -->
			        </li>
			      </ul>
			      <span class="navbar-text">
			        <a class="nav-link" href="{{ route('admin.logout')}}"><button type="button" class="btn btn-danger" >Logout</button></a>
			      </span>
			    </div>
			  </div>
		</nav>
    
    
     @foreach ($admin_users as $user)
		<div class="card mt-5">
           <div class="card-body">
		
                <h5> {{ $user->name }}</h5>
                <p> {{ $user->email }}</p>
          
           </div>
		 
        </div>
		@endforeach
   
       
    </body>
</html>