<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white"> crud in laravel</div>
        </div>
    </div>
    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Edit Employee</div>
            <div>
                <a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put');
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$employee->name) }}">
                    @error('name')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$employee->email) }}">
                    @error('email')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" placeholder="Enter address" cols="30" rows="4" class="form-control">{{ old('address',$employee->address) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror">
                    @error('image')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    <div class="my-3">
                        @if($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                                <img src="{{ url('uploads/employees/'.$employee->image) }}" alt="" width="100" height="100">
                            
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary my-3">Update Employee</button>
        </from>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>