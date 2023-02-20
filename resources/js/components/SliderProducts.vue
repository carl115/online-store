<template>
	<swiper
		:modules="modules"
		:slides-per-view="3"
		:space-between="100"
		navigation
		:pagination="{ clickable: true }"
	>
		<swiper-slide v-for="(product, index) in products" :key="index">
			<a
				:href="`/product/${product.id}`"
				class="product-card bg-gray-600 p-5 rounded-md flex flex-col justify-around"
			>
				<img
					:src="`storage/images/${product.image}`"
					v-if="!product.image.startsWith('http')"
				/>
				<img :src="product.image" v-else />
				<h3 class="text-2xl">{{ product.name }}</h3>
				<p class="text-sm text-slate-400">
					{{ product.description }}
				</p>
				<span class="text-xl">$ {{ product.price }}</span>
			</a>
		</swiper-slide>
	</swiper>
</template>

<script>
	import { Navigation, Pagination } from 'swiper'
	import { Swiper, SwiperSlide } from 'swiper/vue'
	export default {
		props: ['data'],
		data() {
			return {
				products: []
			}
		},
		components: {
			Swiper,
			SwiperSlide
		},
		setup() {
			return {
				modules: [Navigation, Pagination]
			}
		},
		created() {
			this.getProducts()
		},
		methods: {
			getProducts() {
				this.products = this.data
			}
		}
	}
</script>

<style></style>
