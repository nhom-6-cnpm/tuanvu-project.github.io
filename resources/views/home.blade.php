@extends('main')

@section('content')

	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				@foreach ($sliders as $slider)

				<div class="item-slick1" style="background-image: url( {{ $slider->thumb }} );">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									<!-- Camping -->
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 ltext-102 txt-center cl0 p-t-22 p-b-40 respon1">
									{{ $slider->name }}
								</h2>
							</div>
								
							{{-- <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="{{ $slider->url }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div> --}}
						</div>
					</div>
				</div>
									
				@endforeach
				
			</div>
		</div>
	</section>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-50">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5"></h3>
			</div>

			
		</div>
	</section>
@endsection