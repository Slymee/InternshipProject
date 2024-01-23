@foreach ($products as $product)
    {{ $product->user_id }} <br>
    {{ $product->product_title }}<br>
    {{ $product->product_description }} <br>
    {{ $product->product_price }} <br>
    {{ $product->product_tag }} <br>
    {{ $product->image_path }}  <br>
    <img src="{{ asset('storage/'.$product->image_path) }}" alt="no image" style="height: 50px;width:100px;">
    <br><br>
@endforeach

