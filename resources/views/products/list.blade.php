<div class="row isotope-grid">
    @foreach($products as $key => $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ $product->thumb }}" alt="{{ $product->name }}">
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"
                           class="stext-101 cl9 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{ $product->name }}
                        </a>

                        <span class="stext-105 cl11">
							{!!  \App\Helpers\Helper::price($product->price, $product->price_sale)  !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- <div class="flex-c-m flex-w w-full p-t-45" id="btn-load-more-product">
    <input type="hidden" value="1" id="pageProduct">
    <a href="#" onclick="loadMoreProducts()" 
       class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
        Xem Thêm Sản Phẩm
    </a>
</div> -->