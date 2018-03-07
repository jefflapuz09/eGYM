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
            <h3 class="box-title">New Supplier</h3>
            <div class="box-tools pull-right">
                <p class="pull-right"><b>Note</b>: Fields with <span style="color:red;">*</span> are needed to filled out.</p>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ url('/Supplier/Store') }}" method="post">
                        <div class="" style="padding:10px; background:#252525; color:white; margin-bottom:20px;">
                            Supplier Information
                        </div>
                        <div class="form-group">
                            <label for="">Supplier Name <span style="color:red;">*</span></label>
                            <input type="text" name="name" class="form-control" id="">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="">Street <span style="color:red"></span></label>
                                <input type="text" name="street" class="form-control" id="">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Brgy <span style="color:red"></span></label>
                                <input type="text" name="brgy" class="form-control" id="">
                            </div>
                            <div class="col-sm-4">
                                <label for="">City <span style="color:red">*</span></label>
                                <input type="text" name="city" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Contact Number <span style="color:red">*</span></label>
                            <input type="text" name="contactNumber" class="form-control" id="">
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
                {{csrf_field()}}
            </form>
        </div>
</div>


@endsection

@section('script')
<script>
       
</script>
@stop