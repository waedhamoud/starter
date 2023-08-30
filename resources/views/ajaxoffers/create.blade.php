@extends('layouts.app')
@section('content')
<div class="container">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="content">
         <div class="title m-b-md">
            <h1>
             {{__('messages.Add Your Offers') }}
              </h1>

         </div>
         @if(Session::has('success'))
         <div class="alert alert-success" role="alert">
             {{ Session::get('success') }}
         </div>
         @endif

         <br>
         <form method="POST" action="" enctype="multipart/form-data">
             @csrf
             <div class="form-group">
               <label for="exampleInputEmail1">choose Photo</label>

               <input type="file" class="form-control" name="photo" >
               @error('photo')
               <small class="form-text text-danger">{{ $message }}</small>
               @enderror

             </div>
             <div class="form-group">
                 <label for="exampleInputEmail1">Offer Name</label>

                 <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter The name">
                 @error('name')
                 <small class="form-text text-danger">{{ $message }}</small>
                 @enderror

               </div>
             <div class="form-group">
               <label for="exampleInputPassword1">Offer Price</label>
               <input type="number" class="form-control" name="price" placeholder="price">
             @error('price')
             <small class="form-text text-danger">{{ $message }}</small>

             @enderror

             </div>
             <div class="form-group">
                 <label for="exampleInputPassword1">Offer Details</label>
                 <input type="text" class="form-control" name="details" placeholder="Details">
                 @error('details')
                 <small class="form-text text-danger">{{ $message }}</small>
                 @enderror

               </div>

             <button id="save_offer" class="btn btn-primary">Save Offer</button>
           </form>
        </div>


     </div>


</div>

@endsection

@section('scripts')
<script>
    $(document).on('click','#save_offer',function(e){
        e.preventDefault();
        $.ajax({
        type: 'post',
        url: "{{route('ajax.offers.store')}}",
        data: {
            '_method' :"POST"
            '_token':"{{csrf_token()}}",
           //'photo' : $("input[name='photo']").val(),
            'name' : $("input[name='name']").val(),
            'price' : $("input[name='price']").val(),
            'details' : $("input[name='details']").val(),

        }
        success: function(data){},
        error: function(rejec){}

    });

    });


</script>
@stop
