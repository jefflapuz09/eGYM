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
            <h3 class="box-title">New Product</h3>
            <div class="box-tools pull-right">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/Product/Store') }}" method="post">
                {{csrf_field()}}
                <div class="col-sm-6">
                    <div class="" style="padding:10px; background:#252525; color:white; margin-bottom:20px;">
                        Product Information
                    </div>
                    <div class="form-group">
                        <label>Product <span style="color:red;">*</span></label>
                        <input type='text' name='name' class="form-control">
                    </div>
                    <div class='form-group'>
                        <label>Product Type <span style="color:red;">*</span></label>
                        <select id='type' name='typeId' class='form-control'>
                            @foreach($type as $types)
                                <option value='{{$types->id}}'>{{$types->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='form-group'>
                        <label>Product Brand <span style="color:red;">*</span></label>
                        <select id='brand' name='brandId' class='form-control'>
                            @foreach($brand as $brands)
                                <option value='{{$brands->id}}'>{{$brands->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='form-group'>
                        <div class='row'>
                            <div class='col-sm-6'>
                                <label>Product Variant <span style="color:red;">*</span></label>
                                <select id='variant' name='variantId' class='form-control'>
                                    @foreach($variant as $variants)
                                        <option value='{{$variants->id}}'>{{$variants->size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class='col-sm-6'>
                                <label>Price <span style="color:red;">*</span></label>
                                <input type='text' name='price' class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Reorder Level <span style="color:red;">*</span></label>
                        <input type='text' name='reorder' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description <span style="color:red"></span></label>
                        <textarea name="" id="" class="form-control" rows="5" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <button class="btn btn-primary">Submit</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>


@endsection

@section('script')
<script>
    $('#type').on('change',function(){
           var id = this.value;
            $.ajax({
                type: "GET",
                url: '/Product/Type/'+id,
                dataType: "JSON",
                success:function(data){
                    
                    $('#brand').empty();
                    $('#variant').empty();
                    $.each(data.brands,function(key, value)
                    { 
                        $("#brand").append('<option value=' + value.brand.id + '>' + value.brand.name + '</option>');
                    });
                    $.each(data.variant,function(key, value)
                    { 
                        $("#variant").append('<option value=' + value.variant.id + '>' + value.variant.size + '</option>');
                    });
                }
            });
       });
</script>
</script>
@stop
