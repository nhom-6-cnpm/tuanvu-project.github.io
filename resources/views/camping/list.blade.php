<div class="row">
    @foreach($campings as $key => $camping)
        <div class="col-md-6 mb-4">
            <div class="camping-card">
                <div class="camping-image">
                    <img src="{{ $camping->thumb }}" alt="{{ $camping->name }}">
                </div>

                <div class="camping-content">
                    <h3 class="camping-title">{{ $camping->name }}</h3>
                    
                    <div class="camping-description">
                        {{ $camping->description }}
                    </div>

                    <div class="camping-info">
                        <div class="camping-price">
                            <span class="price">{{ number_format($camping->price) }}đ</span>
                            <span class="unit">/người</span>
                        </div>

                        <div class="camping-address">
                            <i class="fa fa-map-marker"></i>
                            {{ $camping->address }}
                        </div>
                    </div>

                    <div class="camping-features">
                        <div class="feature-item">
                            <i class="fa fa-check"></i>
                            Bữa sáng, trà, cà phê và 1 bữa tiệc BBQ tiêu chuẩn
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-check"></i>
                            Có sẵn các tiện ích cắm trại
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-check"></i>
                            Có khu vực vệ sinh
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-check"></i>
                            Đội ngũ hỗ trợ khi cần thiết
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-check"></i>
                            Tắm hồ, có trang bị sẵn áo phao
                        </div>
                    </div>

                    <div class="camping-actions">
                        <a href="/camping/{{ $camping->id }}-{{ Str::slug($camping->name, '-') }}.html" 
                           class="btn-detail">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="text-center mt-4" id="btn-load-more-camping">
    <input type="hidden" value="1" id="pageCamping">
    <button onclick="loadMoreCamping()" class="btn-load-more">
        Xem Thêm Dịch Vụ
    </button>
</div> 