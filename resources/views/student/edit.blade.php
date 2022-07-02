@extends('student.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Edit Student Data
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('student.update', $Student->nim) }}" id="myForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Nim">Nim</label>
                            <input type="text" name="Nim" class="form-control" id="Nim"
                                value="{{ $Student->nim }}" ariadescribedby="Nim">
                        </div>
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="Name" class="form-control" id="Name"
                                value="{{ $Student->name }}" aria-describedby="Name">
                        </div>
                        <div class="form-group">
                            <label for="Kelas">Class</label>
                            <select name="Kelas" id="kelas" class="form-control">
                                @foreach ($kelas as $kls)
                                    <option value="{{$kls->id}}" {{$Student->kelas_id == $kls->id ? 'selected' : ''}}>{{$kls->kelas_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Major">Major</label>
                            <input type="text" name="Major" class="form-control" id="Major"
                                value="{{ $Student->major }}" aria-describedby="Major">
                        </div>
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <input type="text" name="Address" class="form-control" id="Address"
                                vakue="{{ $Student->address }}" ariadescribedby="Major">
                        </div>
                        <div class="form-group">
                            <label for="DateOfBirth">Date Of Birth</label>
                            <input type="date" name="DateOfBirth" class="form-control" id="DateOfBirth"
                                value="{{ $Student->dateofbirth }}" ariadescribedby="DateOfBirth">
                        </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            </form>
        </div>
    </div>
    </div>
    </div>


@endsection
