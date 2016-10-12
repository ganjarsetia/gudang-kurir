<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Destination Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('destination', 'Destination:') !!}
    {!! Form::textarea('destination', null, ['class' => 'form-control']) !!}
</div>

@if(isset($order))

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['new' => 'New', 'in progress' => 'In Progress', 'received' => 'Received'], null, ['class' => 'form-control']) !!}
</div>

@else
    {!! Form::hidden('status', 'new') !!}
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orders.index') !!}" class="btn btn-default">Cancel</a>
</div>
