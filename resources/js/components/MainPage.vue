<template>
	<div class="mt-32">
		<swiper
			:modules="modules"
			:slides-per-view="2"
			:space-between="20"
			navigation
			:pagination="{ clickable: true }"
		>
			<swiper-slide>
				<div class="slider-main__image">
					<img src="https://dummyimage.com/1400x300/404040/b5b5b5" />
				</div>
			</swiper-slide>
			<swiper-slide>
				<div class="slider-main__image">
					<img src="https://dummyimage.com/1400x300/404040/b5b5b5" />
				</div>
			</swiper-slide>
			<swiper-slide>
				<div class="slider-main__image">
					<img src="https://dummyimage.com/1400x300/404040/b5b5b5" />
				</div>
			</swiper-slide>
			<swiper-slide>
				<div class="slider-main__image">
					<img src="https://dummyimage.com/1400x300/404040/b5b5b5" />
				</div>
			</swiper-slide>
		</swiper>
		<product-cards />
		<footer-page />
	</div>
</template>

<script>
	import { Navigation, Pagination } from 'swiper'
	import { Swiper, SwiperSlide } from 'swiper/vue'
	import ProductCards from './products/ProductCards.vue'
	import FooterPage from './FooterPage.vue'

	export default {
		components: {
			Swiper,
			SwiperSlide,
			ProductCards,
			FooterPage
		},
		setup() {
			return {
				modules: [Navigation, Pagination]
			}
		}
	}
</script>
