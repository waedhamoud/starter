@extends('layouts.app')
@section('content')
<div class="container">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="content">
         <div class="title m-b-md">
            <h1>
            Doctors
              </h1>

         </div>


         <br>
         <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Title</th>
                <th scope="col">Operation</th>
              </tr>
            </thead>
            <tbody>
                @if(isset ($doctors) && $doctors -> count() > 0 )

                  @foreach ($doctors as  $doctor)
              <tr>
                <th scope="row">{{ $doctor->id }}</th>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->title }}</td>
                <td><a href="{{ route('doctors.services',$doctor->id) }}" class="btn btn-success">View Doctor Services</button></td>


                <td></td>
              </tr>
              @endforeach
              @endif


            </tbody>
          </table>
        </div>


     </div>


</div>

@endsection


