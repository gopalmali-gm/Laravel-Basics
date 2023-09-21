@extends('layout')

@section('content')
<style>
.mainDiv{
    max-height: 500px; /* Set a fixed height for the scrolling area */
overflow-y: auto; /* Add vertical scrolling */
}
.loader{
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('images/loader.gif') 50% 50% no-repeat rgb(249,249,249);
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<div class="container">
@if(session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success" id="successMessage">
        {{ session('success') }}
    </div>
@endif
<div class="loader"></div>
<div class="d-flex justify-content-between col-6" style="margin-top: 20px; margin-bottom: 20px;">
        <input class="form-control me-2" type="search" id="searchQuery" placeholder="Search" aria-label="Search"><br>
        <div class="col-6">
            <select class="form-select" id="product_category" name="product_category">
                <option value="1" selected>Active Products</option>
                <option value="0">Inactive Products</option>
        </select>
        </div>
       
    </div>
        <div class="mainDiv">
            <div class="card">        
            <table border="1px">
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach($product as $val)
                <tr>
                    <td><h5>{{$val->name}} </h5></td>
                    <td><p>{{$val->category}} </p></td>
                    <td><p>{{$val->description}} </p></td>
                    <td><a href="{{route('update.product',$val->id) }}" class="btn btn-primary mx-2">Edit</a></td>
                    <td><a href="{{route('delete.product',$val->id) }}" class="btn btn-danger mx-2">Delete</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div id="searchResults"></div>
</div>
<!-- resources/views/search.blade.php -->




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        setTimeout(function() {
            $('#successMessage').fadeOut('slow');
         }, 2000);
        $(".loader").fadeOut("slow");
        $('#searchQuery').on('input', function () {
          
            var query = $(this).val();
           
            $.ajax({
                type: 'GET',
                url: '{{ route('search') }}',
                data: { query: query },
                success: function (data) {
                    $(".loader").hide();
                    $('.mainDiv').hide();
                    $('#searchResults').html(data);
                }
            });
        });
        //get active inactive data
        $('#product_category').on('change', function () {
                var selectedCategory = $(this).val();
                $(".loader").show();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('get.data') }}',
                    data: { category: selectedCategory },
                    success: function (data) {
                        $(".loader").hide();
                        $('.mainDiv').hide();
                        $('#searchResults').html(data);
                    }
                });
            });

    });
</script>

@endsection
