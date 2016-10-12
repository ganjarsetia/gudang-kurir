{{-- @if(auth()->user()->role == 'gudang')
<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('orders.index') !!}"><i class="fa fa-edit"></i><span>orders</span></a>
</li>
@endif --}}

{{-- @if(auth()->user()->role == 'kurir')
<li class="{{ Request::is('list-new-order*') ? 'active' : '' }}">
    <a href="{!! route('list_new') !!}"><i class="fa fa-edit"></i><span>New Order</span></a>
</li>
@endif --}}
