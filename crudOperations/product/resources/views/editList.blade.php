@extends('layoutHome')

@section('content')
<style>
     #editForm { margin-left: 20%; }
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

</style>
<div class="d-flex justify-content-center align-items-center">
    <div class="container">
        <h1 class="text-center mb-4">Update Product</h1>
        <div id="errors" class="alert alert-danger" style="display: none;"></div>
        <div id="successMessage" class="alert alert-success" style="display: none;"></div>
        <form action="{{ route('update.insert') }}" method="POST" id="editForm">
            @csrf
            <div class="col-8">
                <input type="hidden" id="id" name="id" value="{{$product[0]->id}}">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$product[0]->name}}">
            </div>
            <div class="col-8">
                 <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" >
                @foreach($category as $val)
                    <option value="{{$val->p_category}}" @if($product[0]->category == $val->p_category) selected @endif>{{$val->p_category}}</option>
                 @endforeach
                    
                   
                </select>
            </div>
            <div class="col-8">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" >{{$product[0]->description}}</textarea>
            </div><br>
            <div class="col-8">
            <div class="form-check">
             <label class="switch">
                     <input type="checkbox" name="active" id="toggle"/>
                    <span class="slider"></span>
                </label>
            </div>
            </div>
            <div class="col-6" style="float:right">
                <button type="submit" class="btn btn-primary w-50">Update</button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
    $('#editForm').submit(function(event) {
        event.preventDefault();
        
        // Clear existing error messages
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        var productName = $('#name').val();
        var id = $('#id').val();
        var category = $('#category').val();
        var description = $('#description').val();
        var active = $('#active').val();
        
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: {
                _token: '{{ csrf_token() }}',
                name: productName,
                id:id,
                category: category,
                description: description,
                active: active
            },
            success: function(data) {
                //window.location.href ='product-list';
                $('#successMessage').text(data.message).show();              
                setTimeout(function() {
                    $('#successMessage').fadeOut('slow');
                }, 2000);
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                for (var key in errors) {
                    $('#' + key).addClass('is-invalid');
                    $('#' + key).after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
                }
            }
        });
    });
});
</script>
@endsection
