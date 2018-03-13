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
<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">New Product Type</h3>
            <div class="box-tools pull-right">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/ProductType/Store') }}" method="post">
                {{csrf_field()}}
                <div style="background:#252525; padding:10px; color:White; margin-bottom:10px;">
                    Product Type Information
                </div>
                <div class="form-group">
                    <label for="">Product Type Name <span style="color:red;">*</span></label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div style="background:#252525; padding:10px; color:White; margin-bottom:10px;">
                    Product Brand(/s)
                </div>
                <div id="brands">
                    <div class="form-group" id="brand">
                        <label for="">Product Brand Name<span style="color:red;">*</span></label>
                        <input type="text" name="brands[]" class="form-control" >
                    </div>
                </div>
                <button id="addBrand" type="button" class="btn btn-sm btn-primary pull-right" data-toggle="tooltip" data-placement="top" title="Add">
                    <i class="glyphicon glyphicon-plus"></i>
                </button>
                <div class="form-group">
                    <div class="">
                        <button class="btn btn-primary">Submit</a>
                    </div>
                </div>
            </form>
        </div>
</div>


@endsection

@section('script')
<script>
       $(document).on("click", "#addBrand", function (){
            var value = $("#brand").clone().prepend(
                '<button id="removeBrand" type="button" class="btn btn-flat btn-danger btn-xs pull-right" data-toggle="tooltip" data-placement="top" title="Remove">' +
                '<i class="glyphicon glyphicon-remove"></i>' +
                '</button>').appendTo('#brands');
            $(value).find("input").val("");
        });


        $('#brands').on('click','#removeBrand',function(){
            $(this).parent().remove();
        });
</script>
@stop