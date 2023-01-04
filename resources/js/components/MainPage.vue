<template>
	<div>
		<slider />
		<product-cards />
		<footer-page />
	</div>
</template>

<script>
	import Slider from './Slider.vue'
	import ProductCards from './products/ProductCards.vue'
	import FooterPage from './FooterPage.vue'

	export default {
		components: {
			Slider,
			ProductCards,
			FooterPage
		}
	}
</script>
