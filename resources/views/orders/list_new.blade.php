@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order
        </h1>
    </section>
    <div class="content">
        @include('flash::message')
        <div class="box box-info">
            <div class="box-header text-center">
                <h3 class="box-title">{{ $order ? 'New Order, would you pick?' : 'Your current job' }}</h3>
            </div>
            <div class="box-body text-center">

                @if($order)
                <strong>Name: {!! $order->name !!}</strong>
                <br>
                Description: {!! $order->description !!}
                <br>
                Destination: {!! $order->destination !!}
                <br>
                <br>
                {!! Form::open(['route' => 'pick_order']) !!}
                {!! Form::hidden('order_id', $order->id) !!}
                {!! Form::submit('Pick Order!', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}
                
                @endif
                
                @if($current_order)

                <strong>Name: {!! $current_order->name !!}</strong>
                <br>
                Description: {!! $current_order->description !!}
                <br>
                Destination: {!! $current_order->destination !!}
                <br>
                <br>
                {{-- method lain menggunakan PUT & ID langsung --}}
                {!! Form::open(['route' => ['finish_order', $current_order->id], 'method' => 'put']) !!}
                {!! Form::submit('Finish', ['class' => 'btn btn-primary btn-lg']) !!}
                <input type="submit" name="Cancel" value="Cancel" class="btn btn-danger btn-lg">
                {!! Form::close() !!}
                
                @endif

                {{ (!$order && !$current_order) ? 'No data' : '' }}
            </div>

        </div>
        <!-- /.box-body -->
    </div>
       
                
    
@endsection
