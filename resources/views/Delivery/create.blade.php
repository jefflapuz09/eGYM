@extends('layouts.admin')

@section('style')
<link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
@stop

@section('content')
<script src="{{  asset('js/jquery.min.js')  }}"></script>
<script src="{{  asset('js/toastr.js')  }}"></script>
@if ($errors->any())
<script type="text/javascript">
    toastr.error(' <?php echo implode('', $errors->all(':message')) ?>', "There's something wrong!")
</script>             
@endif
@if(session('error'))
<script type="text/javascript">
    toastr.error(' <?php echo session('error'); ?>', "There's something wrong!")
</script>
@endif
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">New Delivery Order</h3>
            <div class="box-tools pull-right">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/DeliveryOrder/Store') }}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Date of Delivery<span style="color:red;">*</span></label>
                            <div class='input-group date' id='datetimepicker1'>
                            <input type='text' name="created_at" placeholder="YYYY-MM-DD" id="date"  value="{{ old('created_at') }}" class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Supplier<span style="color:red;">*</span></label>
                            <select id="supplierId" name="supplierId" class="form-control" required>
                                @foreach($supplier as $suppliers)
                                    <option value="{{$suppliers->id}}">{{$suppliers->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Product<span style="color:red;">*</span></label>
                        <select  id="purchaseId" name="purchaseId" class="form-control">
                            
                        </select>
                    </div>
                </div>
                <table id="productList" class="table table-striped table-bordered responsive">
                        <thead>
                            <tr>
                                <th width="5%" class="text-right">Quantity Ordered</th>
                                <th>Product</th>
                                <th class="text-right">Order Id(/s)</th>
                                <th class="text-right">Quantity Received</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                </table>
                <div class="form-group" style='margin-top:20px;'>
                    <div class="pull-right">
                        <button class="btn btn-primary">Submit</a>
                    </div>
                </div>
            </form>
        </div>
</div>


@endsection

@section('script')
<script>
    var pList = $('#productList').DataTable({
        'responsive': true,
        "searching": false,
        "paging": false,
        "info": false,
        "retrieve": true,
    });

    $('#supplierId').on('change',function(){
        $.ajax({
            type:'Get',
            url:'/DeliveryOrder/Purchase/'+this.value,
            dataType: "JSON",
            success:function(data){
                $('#purchaseId').empty();
                $.each(data,function(key, value)
                { 
                    $("#purchaseId").append('<option value=' + value.id + '>' + value.id + '</option>');
                });
            }
        });
    });

    $('#purchaseId').on('change',function(){
        $('#purchaseId option[value="'+this.value+'"]').attr('disabled',true);
        $.ajax({
            type:'Get',
            url:"/DeliveryOrder/Product/"+this.value,
            dataType: "JSON",
            success:function(data){
                //console.log(data);
                $.each(data,function(key,value){
                    row = pList.row.add([
                        "<input type='text' name='qtyOrder[]' class='form-control'  value='"+value.detail[0].quantity+"'>",
                        "<input type='hidden' name='productId[]' class='form-control'  value='"+value.detail[0].product.id+"'><input type='text' name='product[]' class='form-control'  value='"+value.detail[0].product.name+"'>",
                        "<input type='text' name='orderId[]' class='form-control'  value='"+value.id+"'>",
                        "<input type='text' name='qtyReceived[]' class='form-control'>"
                    ]).draw().node();
                });
            }
        });
        $('#purchaseId').val('');
    });
</script>
@stop
