@extends('layouts.app')
@section('content')
<div class="container">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="content">
         <div class="title m-b-md">
            <h1>
            Services
              </h1>

         </div>


         <br>
         <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
              </tr>
            </thead>
            <tbody>
                @if(isset ($services) && $services -> count() > 0 )

                  @foreach ($services as  $service)
              <tr>
                <th scope="row">{{ $service->id }}</th>
                <td>{{ $service->name }}</td>
                <td></td>
              </tr>
              @endforeach
              @endif


            </tbody>
          </table>
          <br><br>
          <form method="POST" action="{{ route('save.doctors.services') }}" >
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Select Doctor</label>


               <select class="form-control" name="doctor_id"  >
                @foreach ($doctors as $doctor )
                <option value="{{ $doctor -> id }}">{{ $doctor -> name }}</option>
                @endforeach


                </select>

              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Select Services</label>

                <select class="form-control" name="servicesIds[]"  multiple >
                    @foreach ($allServices as $allService )
                    <option value="{{ $allService -> id }}">{{ $allService -> name }}</option>
                    @endforeach
                </select>

              </div>




            <button type="submit" class="btn btn-primary">Save </button>
          </form>
       </div>


    </div>

        </div>


     </div>


</div>

@endsection


