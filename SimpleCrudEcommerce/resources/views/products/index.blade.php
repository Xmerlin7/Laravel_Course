<div style="display: flex; flex-wrap: wrap; gap: 20px;">
    @foreach($products as $product)
        <x-product-card :name="$product['name']" :price="$product['price']" />
    @endforeach
</div>