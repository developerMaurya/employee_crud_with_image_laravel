<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="bg-dark py-3">
        <div class="container d-flex justify-content-between">
            <div class="h4 text-white"> Employee Details in | laravel</div>
            <a href="{{url('/')}}"><button class="btn btn-primary btn-sm">Home</button></a>
        </div>
    </div>
    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Employee</div>
            <div>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success') }}
        </div>
        @endif
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>E.Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>action</th>
                        
                    </tr>
                    @if($employees->isNotEmpty())
                    @foreach($employees as $employee)
                    <tr valign="middle">
                        <td>{{$employee->id}}</td>
                        <td>
                            @if($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                               <img src="{{ url('uploads/employees/'.$employee->image) }}" alt="" width="40" height="40" class="rounded-circle">
                            @else
                            <img src="{{ url('assets/images/noimage.png') }}" alt="" width="40" height="40" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->address}}</td>
                        <td>
                            <a href="{{route('employees.edit',$employee->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" onclick="deleteEmployee({{ $employee->id}})" class="btn btn-danger btn-sm">Delete</a>
                            <form id="employee-edit-action-{{ $employee->id }}" action="{{ route('employees.destroy',$employee->id)}}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6">Record Not Found !</td>
                    </tr>

                    @endif
                </table>
            </div>
        </div>
        <!-- display pagination  -->
        
        <div class="mt-3">
        {{ $employees->links()}}
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<script>

function deleteEmployee(id){
    if(confirm("Are you want to delete id  "+id+" ?")){
        document.getElementById('employee-edit-action-'+id).submit();
    }
}
</script>