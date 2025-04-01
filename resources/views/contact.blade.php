@extends('main')

@section('content')
<!-- Slider -->
<section class="section-slide" style="height: 250px; position: relative;">
	<div class="wrap-slick1">
		<div class="item-slick1" style="background-image: url({{ $sliders[0]->thumb }}); height: 300px; 
			background-position: center; background-size: cover; filter: brightness(0.7);">
		</div>
	</div>
	<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; text-align: center;">
		<h2 style="font-family: 'Times New Roman', serif; font-size: 36px; font-weight: 500; color: white; 
				   letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
			LIÊN HỆ
		</h2>
	</div>
</section>

<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 p-lr-30 m-lr-auto">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="txt-center p-b-30" style="font-size: 24px; font-weight: 500; color: #333;">
						Gửi tin nhắn cho chúng tôi
					</h4>

					<form method="POST" action="{{ route('contact.send') }}">
						@csrf
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="text" name="name" 
								placeholder="Họ và tên của bạn" required style="font-size: 15px;">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="email" name="email" 
									placeholder="Email của bạn" required style="font-size: 15px;">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="text" name="phone" 
									placeholder="Số điện thoại" required style="font-size: 15px;">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-20 p-tb-25" name="content" 
									placeholder="Tôi có thể giúp gì cho bạn?" required style="font-size: 15px;"></textarea>
						</div>

						<button class="flex-c-m cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer w-100" 
							style="font-size: 16px; font-weight: 400;">
							Gửi tin nhắn
						</button>
					</form>
				</div>
			</div>

			<div class="col-lg-6 p-lr-30 m-lr-auto">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="txt-center p-b-30" style="font-size: 24px; font-weight: 500; color: #333;">
						Thông tin liên hệ
					</h4>

					<div class="flex-w w-full p-b-20">
						<span class="fs-18 cl5 p-r-18">
							<i class="zmdi zmdi-pin"></i>
						</span>
						<div class="size-212">
							<span style="font-size: 17px; font-weight: 500; color: #333;">Địa chỉ</span>
							<p style="font-size: 15px; color: #666; margin-top: 5px;">TP.HCM</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-20">
						<span class="fs-18 cl5 p-r-18">
							<i class="zmdi zmdi-phone"></i>
						</span>
						<div class="size-212">
							<span style="font-size: 17px; font-weight: 500; color: #333;">Hotline</span>
							<p style="font-size: 15px; color: #666; margin-top: 5px;">0793 *** ***</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-20">
						<span class="fs-18 cl5 p-r-18">
							<i class="zmdi zmdi-email"></i>
						</span>
						<div class="size-212">
							<span style="font-size: 17px; font-weight: 500; color: #333;">Email</span>
							<p style="font-size: 15px; color: #666; margin-top: 5px;">riotgame05122003@gmail.com</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 p-r-18">
							<i class="zmdi zmdi-time"></i>
						</span>
						<div class="size-212">
							<span style="font-size: 17px; font-weight: 500; color: #333;">Giờ làm việc</span>
							<p style="font-size: 15px; color: #666; margin-top: 5px;">
								Thứ 2 - Chủ nhật: 09:00 - 21:00
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('admin.alert')
@endsection