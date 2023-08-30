@extends('layouts.app')
@section('content')
<div class="container">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="content">
         <div class="title m-b-md">
            <h1>
            Hospitals
              </h1>

         </div>


         <br>
         <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Process</th>
              </tr>
            </thead>
            <tbody>
                @if(isset ($hospitals) && $hospitals -> count() > 0 )

                  @foreach ($hospitals as  $hospital)
              <tr>
                <th scope="row">{{$hospital -> id}}</th>
                <td>{{$hospital -> name}}</td>
                <td>{{$hospital -> address}}</td>
                <td><a href="{{ route('hospital.doctors',$hospital -> id) }}" class="btn btn-success"> Show Doctors</button></td>
                <td><a href="{{ route('hospital.delete',$hospital -> id) }}" class="btn btn-danger"> Delete</button></td>

                </tr>
              @endforeach
              @endif


            </tbody>
          </table>
        </div>


     </div>


</div>

@endsection


