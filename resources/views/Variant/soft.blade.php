@extends('layouts.admin')

@section('style')
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
@stop

@section('content')
<script src="{{  asset('js/jquery.min.js')  }}"></script>
<script src="{{  asset('js/toastr.js')  }}"></script>
@if(session('success'))
<script type="text/javascript">
    toastr.success(' <?php echo session('success'); ?>', 'Success!')
</script>
@endif
@if(session('error'))
<script type="text/javascript">
    toastr.error(' <?php echo session('error'); ?>', "There's something wrong!")
</script>
@endif
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Product Variant</h3>
        <div class="box-tools pull-right">
            <a href="{{ url('/ProductVariant/Create') }}" class="btn btn-xs btn-success">New Record</a>
        </div>
        </div>
        <div class="box-body">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Variant</th>
                        <th>Product Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($post as $posts)
                    <tr>
                        <td>{{$posts->size}} {{$posts->unit}}</td>
                        <td>
                            @foreach($posts->Type as $type)
                                <li>{{$type->Type->name}}</li>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ url('/ProductVariant/Reactivate/id='.$posts->id) }}" onclick="return updateForm()" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Reactivate record">
                            <i class="fa fa-recycle" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/ProductVariant/Remove/id='.$posts->id) }}"  onclick="return deleteForm()" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete record">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right">
                <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/ProductVariant') }}';" id="showDeactivated"> Show Active Records</label>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
    function updateForm(){
        var x = confirm("Are you sure you want to modify this record?");
        if (x)
          return true;
        else
          return false;
     }

     function deleteForm(){
        var x = confirm("Are you sure you want to deactivate this record? All items included in this record will also be deactivated.");
        if (x)
          return true;
        else
          return false;
     }

</script>
@stop