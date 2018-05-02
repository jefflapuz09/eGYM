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
        <h3 class="box-title">Stocks Monitoring</h3>
        <div class="box-tools pull-right">
            <a href="{{ url('/Stock/Receive') }}" class="btn btn-xs btn-success">Receive Delivery</a>
        </div>
        </div>
        <div class="box-body">
            <table id="monitor" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Stock</th>
                        <th>Last Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($post as $posts)
                    <tr>
                        <td><input type="hidden" name="id" id="id" value="{{$posts->id}}">{{$posts->Product->name}}</td>
                        <td>{{$posts->stock}}</td>
                        <td>{{$posts->updated_at}}</td>
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


@endsection

@section('script')
<script>




</script>
@stop