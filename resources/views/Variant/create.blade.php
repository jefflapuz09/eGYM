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
            <h3 class="box-title">Unit of Measurement</h3>
            <div class="box-tools pull-right">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/ProductVariant/Store') }}" method="post">
                        <div class="" style="padding:10px; background:#252525; color:white; margin-bottom:20px;">
                            Unit of Measurement Information
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Category<span style="color:red;">*</span></label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="Mass">Mass</option>
                                        <option value="Length">Length</option>
                                        <option value="Volume">Volume</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="col-sm-6">
                                <label for="">Belong to Product Type<span style="color:red;">*</span></label>
                                <select class="form-control" name="type">
                                    @foreach($type as $types)
                                        <option value="{{$types->id}}">{{$types->name}}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Size<span style="color:red;">*</span></label>
                                <input type="text" name="size" id="" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-top:25px;">
                                    <select class="form-control" id="unit" name="unit">
                                        @foreach($post as $posts)
                                            <option value="{{$posts->name}}">{{$posts->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <button class="btn btn-primary">Submit</a>
                            </div>
                        </div>
                </div>
                {{csrf_field()}}
            </form>
        </div>
</div>


@endsection

@section('script')
<script>
       $('#category').on('change',function(){
           var id = this.value;
            $.ajax({
                type: "GET",
                url: '/ProductVariant/Category/'+id,
                dataType: "JSON",
                success:function(data){
                    $('#unit').empty();
                    $.each(data,function(key, value)
                    { 
                        $("#unit").append('<option value=' + value.name + '>' + value.name + '</option>');
                    });
                }
            });
       });
</script>
@stop