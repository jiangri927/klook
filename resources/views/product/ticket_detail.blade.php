@foreach($tickets as $item)
<div class="book-section">
    <h5 style="margin-right:  auto">{{$item->title}}</h5>
   <div class="">
       <div class="" style="display: flex;">
           <h5 style="text-decoration: line-through;margin: 0 10px">RM {{$item->m_price}}</h5>
           <h4 style="color: var(--blue-color);margin: 0 10px;" id="ticket-o-price" data-price="{{ $item->o_price }}" data-ticket="{{$item->id}}">RM {{$item->o_price}} ({{$item->o_percent}}%)</h4>
       </div>
       <div class="" style="display: flex;">
           <h4 style="color: var(--red-color);margin: 0 10px;" id="ticket-o-price" data-price="{{ $item->o_price }}" data-ticket="{{$item->id}}">[ RM {{$item->abp_price}} + ABP {{$item->abp_amount}} ({{$item->abp_percent}}%) ]</h4>
       </div>
   </div>
    <div class="qty">
        <span class="minus bg-dark">-</span>
        <input type="order_number" class="count" name="qty" value="0">
        <span class="plus bg-dark">+</span>
    </div>
</div>
@endforeach
