
<div class="card">
    @if(count($product)>0)
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
        
        @else
        <div class="alert alert-danger">
            No Data Found
        </div>
    @endif
</div>
