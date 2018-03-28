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
        <h3 class="box-title">Delivery Order</h3>
        <div class="box-tools pull-right">
            <a href="{{ url('/DeliveryOrder/Create') }}" class="btn btn-xs btn-success">New Record</a>
        </div>
        </div>
        <div class="box-body">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Delivery Id</th>
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
                            @if(!$posts->isFinalize)
                                <button onclick="finalizeModal('{{$posts->id}}')" id="finalBtn" ype="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Finalize record">
                                        <i class="glyphicon glyphicon-ok"></i>
                                </button>
                                <a href="{{ url('/PurchaseOrder/Edit/id='.$posts->id) }}" onclick="return updateForm()" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update record">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url('/PurchaseOrder/Deactivate/id='.$posts->id) }}"  onclick="return deleteForm()" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Deactivate record">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            @elseif($posts->isFinalize)
                                <a href="{{url('/PurchaseOrder/pdf/'.$posts->id)}}" target="_blank" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Generate PDF">
                                    <i class="glyphicon glyphicon-file"></i>
                                </a>
                                @if(!$posts->isDelivered)
                                    <a href="{{ url('/PurchaseOrder/Edit/id='.$posts->id) }}" onclick="return updateForm()" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update record">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ url('/PurchaseOrder/Deactivate/id='.$posts->id) }}"  onclick="return deleteForm()" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Deactivate record">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                @endif
                            @else
                            <a href="{{url('/PurchaseOrder/pdf/'.$posts->id)}}" target="_blank" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Generate PDF">
                                <i class="glyphicon glyphicon-file"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group pull-right">
                <label class="checkbox-inline"><input type="checkbox"  onclick="document.location='{{ url('/PurchaseOrder/Soft') }}';" id="showDeactivated"> Show deactivated records</label>
            </div>
        </div>
    </div>
</div>

<div id="finalizeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Finalize</h4>
                </div>
                <div class="modal-body">
                    <div style="text-align:center">Are you sure you want to finalize this record?</div>
                    <br>
                    <div class="dataTable_wrapper">
                    <form id='finalForm' method="post">
                        {{csrf_field()}}
                        <table id="productList" class="table table-striped table-bordered responsive">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modalClose" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="finalize" type="submit" class="btn btn-success">Finalize</button>
                </div>
            </form>
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