<template>
	<div>
		<div class="h-24"></div>
		<Splide :options="{ type: 'loop', autoplay: true }">
			<SplideSlide>
				<img src="https://dummyimage.com/1400x300/404040/b5b5b5" />
			</SplideSlide>
			<SplideSlide>
				<img src="https://dummyimage.com/1400x300/404040/b5b5b5" />
			</SplideSlide>
			<SplideSlide>
				<img src="https://dummyimage.com/1400x300/404040/b5b5b5" />
			</SplideSlide>
			<SplideSlide>
				<img src="https://dummyimage.com/1400x300/404040/b5b5b5" />
			</SplideSlide>
		</Splide>
	</div>
</template>

<script>
	import '@splidejs/vue-splide/css'
	import { Splide, SplideSlide } from '@splidejs/vue-splide'

	export default {
		name: 'Slider',
		components: {
			Splide,
			SplideSlide
		}
	}
</script>
