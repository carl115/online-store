<template>
	<div>
		<div class="p-4 mt-24 mx-5">
			<h1 class="mb-10 text-2xl text-white">{{ category.name }}</h1>
			<div class="mb-10 grid grid-cols-3 gap-y-10 rounded-md">
				<a
					class="bg-gray-600 text-white px-5 py-3 mx-4 rounded-md flex flex-col justify-around hover:cursor-pointer"
					v-for="(product, index) in category.products"
					:href="`/product/${product.id}`"
					:key="index"
				>
					<img
						:src="`/storage/images/${product.image}`"
						v-if="!product.image.startsWith('http')"
					/>
					<img :src="product.image" v-else />
					<h3 class="text-2xl">{{ product.name }}</h3>
					<p class="text-sm text-slate-300">{{ product.description }}</p>
					<span class="text-xl">$ {{ product.price }}</span>
				</a>
			</div>
		</div>
		<footer-page />
	</div>
</template>

<script>
	import NavBar from '../navBar/NavBar.vue'
	import FooterPage from '../FooterPage.vue'
	export default {
		props: ['data'],
		data() {
			return {
				category: {},
				categories: []
			}
		},
		components: {
			NavBar,
			FooterPage
		},
		created() {
			this.getProducts(), this.getCategories()
		},
		methods: {
			async getCategories() {
				const { data } = await axios.get('http://127.0.0.1:8000/api/categories')
				this.categories = data
			},
			getProducts() {
				this.category = JSON.parse(this.data)
			}
		}
	}
</script>
