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
            <h3 class="box-title">New Product Brand</h3>
            <div class="box-tools pull-right">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/ProductBrand/Update/id='.$post->id) }}" method="post">
                {{csrf_field()}}
                <div style="background:#252525; padding:10px; color:White; margin-bottom:10px;">
                    Product Brand Information
                </div>
                <div class="form-group">
                    <label for="">Product Brand Name <span style="color:red;">*</span></label>
                <input type="text" name="name" id="" value="{{$post->name}}" class="form-control">
                </div>
                <div style="background:#252525; padding:10px; color:White; margin-bottom:10px;">
                    Product Type(/s)
                </div>
                <div class="form-group">
                    <select class="form-control select2" id="type" name="types[]" multiple="multiple">
                        @foreach($pType as $type)
                            <option value="{{$type->name}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
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
    $(document).ready(function(){
        var Type = 
        [
            @foreach($post->Type as $type)
                "{{$type->Type->name}}",
            @endforeach
        ];
        $("#type").val(Type);
        $(".select2").select2();
    });
</script>
@stop