<template>
	<div class="py-10 px-20">
		<div class="w-full mb-24 flex justify-center">
			<div
				class="bg-gray-600 w-1/2 p-2 px-3 text-slate-300 border border-slate-300 rounded-md flex items-center"
			>
				<font-awesome-icon icon="fa-solid fa-magnifying-glass" class="mr-3 text-xl" />
				<input
					type="text"
					class="bg-gray-600 w-full px-2 py-1 focus:outline-none"
					placeholder="Search product"
					v-model="searchValue"
					@keyup="handleKeyUp"
				/>
			</div>
		</div>
		<div v-if="searchValue.length === 0">
			<div v-for="(category, index) in categories" class="my-4" :key="index">
				<p class="text-white">
					Show all products
					<a
						:href="`http://127.0.0.1:8000/category/${category.id}/products`"
						class="p-0 text-blue-600 hover:border-b hover:border-blue-600"
						>{{ category.name }}</a
					>
				</p>
				<Splide
					:options="{
						perPage: 3,
						rewind: true
					}"
				>
					<SplideSlide v-for="(product, index) in category.products" :key="index">
						<a
							:href="`/product/${product.id}`"
							class="bg-gray-600 h-full text-white px-5 py-3 mx-4 rounded-md flex flex-col justify-around hover:cursor-pointer"
						>
							<img
								:src="`storage/images/${product.image}`"
								v-if="!product.image.startsWith('http')"
							/>
							<img :src="product.image" v-else />

							<h3 class="text-2xl">{{ product.name }}</h3>
							<p class="text-sm text-slate-300">{{ product.description }}</p>
							<span class="text-xl">$ {{ product.price }}</span>
						</a>
					</SplideSlide>
				</Splide>
			</div>
		</div>
		<div class="py-10 px-20 grid grid-cols-3 gap-y-10" v-else>
			<a
				v-for="(product, index) in products"
				:href="`/product/${product.id}`"
				class="bg-gray-600 h-full text-white px-5 py-3 mx-4 rounded-md flex flex-col justify-around hover:cursor-pointer"
				:key="index"
			>
				<img :src="product.image" />
				<h3 class="text-2xl">{{ product.name }}</h3>
				<p class="text-sm text-slate-300">{{ product.description }}</p>
				<span class="text-xl">$ {{ product.price }}</span>
			</a>
		</div>
	</div>
</template>

<script>
	import '@splidejs/splide/css/sea-green'
	import { Splide, SplideSlide } from '@splidejs/vue-splide'
	import Slider from '../Slider.vue'
	import { library } from '@fortawesome/fontawesome-svg-core'
	import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

	library.add(faMagnifyingGlass)

	export default {
		data() {
			return {
				categories: [],
				products: [],
				searchValue: ''
			}
		},
		components: {
			FontAwesomeIcon,
			Slider,
			Splide,
			SplideSlide
		},
		created() {
			this.getProducts()
		},
		methods: {
			async getProducts() {
				const { data } = await axios.get(
					'http://127.0.0.1:8000/api/categories/categoriesWithProducts'
				)
				this.categories = data
			},
			handleKeyUp() {
				$.ajax({
					url: 'http://127.0.0.1:8000/api/products',
					method: 'POST',
					data: { search: this.searchValue }
				}).then(res => (this.products = res))
			}
		}
	}
</script>
