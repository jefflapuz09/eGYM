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
        <h3 class="box-title">Purchase Order</h3>
        <div class="box-tools pull-right">
            <a href="{{ url('/PurchaseOrder/Create') }}" class="btn btn-xs btn-success">New Record</a>
        </div>
        </div>
        <div class="box-body">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Purchase Id</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($post as $posts)
                    <tr>
                        <td>{{$posts->id}}</td>
                        <td>{{$posts->Supplier->name}}</td>
                        <td>
                            @if(!$posts->isFinalize)
                            {{"Not yet finalized"}}
                            @elseif($posts->isFinalize && !$posts->isDelivered)
                            {{"Finalized"}}
                            @elseif($posts->isDelivered)
                            {{"All items delivered"}}
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/PurchaseOrder/Reactivate/id='.$posts->id) }}" onclick="return updateForm()" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Reactivate record">
                                <i class="fa fa-recycle" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/PurchaseOrder/Remove/id='.$posts->id) }}"  onclick="return deleteForm()" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete record">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right">
                <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/PurchaseOrder') }}';" id="showDeactivated"> Show Active records</label>
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