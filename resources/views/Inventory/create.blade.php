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
            <h3 class="box-title">Receive Delivery</h3>
            <div class="box-tools pull-right">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/Stock/Receive/Store') }}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Date of Purchase<span style="color:red;">*</span></label>
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
                            <select id="supp" name="supplierId" class="form-control" required>
                                @foreach($supplier as $suppliers)
                                    <option value="{{$suppliers->id}}">{{$suppliers->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Product<span style="color:red;">*</span></label>
                        <select id="products" name="productId" class="form-control">
                            <option value="0"></option>
                            @foreach($product as $products)
                                <option value="{{$products->id}}">{{$products->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table id="productList" class="table table-striped table-bordered responsive">
                        <thead>
                            <tr>
                                <th width="5%" class="text-right">Quantity Received</th>
                                <th>Product</th>
                                <th width="5%">Action</th>
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

$(document).on('change', '#products', function(){
    $('#products option[value="'+this.value+'"]').attr('disabled',true);
    $.ajax({
        type: "GET",
        url: "/Stock/Item/"+this.value,
        dataType: "JSON",
        success:function(data){
            console.log(data);
            row = pList.row.add([
                '<input type="hidden" name="product[]" value="'+data.id+'"><input type="text" data-price="0" class="form-control qty text-right" id="qty" name="qty[]" required>',
                "<input type='text' class='form-control' disabled value='"+data.name+"'>",
                '<button id="'+data.id+'" type="button" class="btn btn-danger btn-sm pull-right pullProduct" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-remove"></i></button>'
            ]).draw().node();
            $('.qty').inputmask({ 
                alias: "integer",
                prefix: '',
                allowMinus: false,
                min: 1,
            });
            $(".price").inputmask({ 
                alias: "currency",
                prefix: '',
                allowMinus: false,
                autoGroup: true,
                min: 0,
                max: 1000000
            });
            $('.stack').inputmask({ 
                alias: "currency",
                prefix: '',
                allowMinus: false,
                min: 0,
            });
        }
    });
    $('#products').val('');
});

$(document).on('click','.pullProduct', function(){
    $('#products option[value="'+this.id+'"]').attr('disabled',false);
    var row = rowFinder(this);
    $('#products').val('');
    pList.row(row).remove().draw();
});

function rowFinder(row){
    if($(row).closest('table').hasClass("collapsed")) {
        var child = $(row).parents("tr.child");
        row = $(child).prevAll(".parent");
    } else {
        row = $(row).parents('tr');
    }
    return row;
}
</script>
@stop
