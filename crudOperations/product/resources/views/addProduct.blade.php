@extends('layoutHome')

@section('content')
<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
}

.switch input[type="checkbox"] {
  display: none;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  border-radius: 13px;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  border-radius: 50%;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(24px);
  -ms-transform: translateX(24px);
  transform: translateX(24px);
}
.form-label{
  font-weight: 700;
}


</style>
<div class="d-flex justify-content-center align-items-center">
    <div class="container">
        <h1 class="text-center mb-4">Add Product</h1>
        <!-- Error Container -->
        <div id="errors" class="alert alert-danger" style="display: none;"></div>
        <div id="successMessage" class="alert alert-success" style="display: none;"></div>

        <form action="{{ route('store.product') }}" method="POST" id="myForm" autocomplete="off">
            @csrf
            <div class="col-8">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-8">
                 <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category">
                     <option value="" selected disabled>Select a Category</option>
                    @foreach($category as $val)
                        <option value="{{$val->p_category}}">{{$val->p_category}}</option>
                    @endforeach
                   
                </select>
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                 @enderror
               
            </div>
            <div class="col-8">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter description"></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div><br>
            <div class="col-8">
                <div class="form-check">
                <label class="switch">
                     <input type="checkbox" name="active" id="toggle"/>
                    <span class="slider"></span>
                </label>
              
            </div>
            <div class="col-8 mt-3">
                <button type="submit" class="btn btn-primary w-100">Add Product</button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

// $(document).ready(function() {
//     $('#myForm').submit(function(event) {
//         event.preventDefault();
        
//         // Clear existing error messages
//         $('.is-invalid').removeClass('is-invalid');
//         $('.invalid-feedback').remove();
        
//         // var productName = $('#name').val();
//         // var category = $('#category').val();
//         // var description = $('#description').val();
//         // var active1 = $('#toggle').val();
//         // alert(active1)
//         var formData = $('#myForm').serialize();
//         //alert(formData);
//         $.ajax({
//             type: 'POST',
//             url: $(this).attr('action'),
//             data: formData,
//             success: function(data) {
//                 // Clear form fields
//                 $('#name').val('');
//                 $('#category').val('');
//                 $('#description').val('');
//                 $('#errors').empty().hide();
//                 $('#toggle').prop('checked', false);
//                 $('#successMessage').text(data.message).show();              
//                 setTimeout(function() {
//                     $('#successMessage').fadeOut('slow');
//                 }, 2000);
//             },
//             error: function(response) {
//                 var errors = response.responseJSON.errors;
//                 for (var key in errors) {
//                     $('#' + key).addClass('is-invalid');
//                     $('#' + key).after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
//                 }
//             }
//         });
//     });

    
// });
</script>

</script>
@endsection
