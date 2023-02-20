<template>
	<div class="px-28">
		<div class="bg-white py-6 px-16 mt-24 border border-white flex justify-between rounded-md">
			<img
				:src="`/storage/images/${product.image}`"
				class="border border-slate-300 rounded-sm"
				style="height: 500px"
				v-if="!product.image.startsWith('http')"
			/>
			<img
				:src="product.image"
				class="border border-slate-300 rounded-sm"
				style="height: 500px"
				v-else
			/>
			<div class="p-4 border border-slate-300 flex flex-col justify-around rounded-sm">
				<div class="font-bold text-2xl">
					<h2>{{ product.name }}</h2>
				</div>
				<div>
					<p class="font-bold">Description</p>
					<p>{{ product.description }}</p>
				</div>
				<div class="text-xl">
					<span>$ {{ product.price }}</span>
				</div>
				<div class="flex items-center">
					<div class="h-12 mr-4 grid grid-cols-[30px_55px_30px]">
						<button @click="reduceCount" class="bg-gray-400 rounded-l-md">
							<font-awesome-icon icon="fa-solid fa-angle-left" />
						</button>
						<input
							type="number"
							class="bg-slate-200 text-center focus:outline-none"
							v-model="count"
						/>
						<button @click="addCount" class="bg-gray-400 rounded-r-md">
							<font-awesome-icon icon="fa-solid fa-angle-right" />
						</button>
					</div>
					<span>Remaining units ({{ product.stock }})</span>
				</div>
				<div>
					<a href="" class="bg-black p-3 text-white rounded-md" @click="handleClick">
						Add cart
					</a>
				</div>
			</div>
		</div>
		<div class="py-10 px-20" v-if="related_products.length > 0">
			<p class="text-white mb-5">
				Related products
				<a
					:href="`http://127.0.0.1:8000/category/${product.category_id}/products`"
					class="p-0 text-blue-600 hover:border-b hover:border-blue-600"
				>
					Show more
				</a>
			</p>
			<slider-products :data="related_products"></slider-products>
		</div>
		<div class="py-10 px-20">
			<p class="text-white mb-5">
				More products
				<a href="" class="p-0 text-blue-600 hover:border-b hover:border-blue-600">
					Show more
				</a>
			</p>
			<!--
			<Splide
				:options="{
					perPage: 3,
					rewind: true
				}"
			>
				<SplideSlide>
					<a
						href=""
						class="bg-gray-600 h-full text-white px-5 py-3 mx-4 rounded-md flex flex-col justify-around hover:cursor-pointer"
					>
						<img src="https://dummyimage.com/300x300/fff/aaa" />
						<h3 class="text-2xl">Lorem, ipsum dolor.</h3>
						<p class="text-sm text-slate-300">Lorem, ipsum dolor.</p>
						<span class="text-xl">$ Lorem, ipsum dolor.</span>
					</a>
				</SplideSlide>
			</Splide>
			-->
		</div>
	</div>
</template>

<script>
	import { library } from '@fortawesome/fontawesome-svg-core'
	import { faAngleRight, faAngleLeft } from '@fortawesome/free-solid-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
	import SliderProducts from '../SliderProducts.vue'

	library.add(faAngleRight, faAngleLeft)

	export default {
		props: ['userData', 'data'],
		data() {
			return {
				user: {},
				product: {},
				related_products: [],
				count: 1,
				total: 0
			}
		},
		components: {
			FontAwesomeIcon,
			SliderProducts
		},
		created() {
			this.index()
			this.getUser()
		},
		methods: {
			async index() {
				this.product = JSON.parse(this.data)
				this.total = this.product.price

				const { data } = await axios.get(
					`http://127.0.0.1:8000/api/categories/categoryWithProducts/${this.product.category_id}`
				)
				this.related_products = data.products
			},
			getUser() {
				if (this.userData) {
					this.user = JSON.parse(this.userData)
				}
			},
			async handleClick() {
				if (this.userData) {
					const { data } = await axios.post(
						'http://127.0.0.1:8000/api/purchases/product',
						{
							product: this.product.id
						}
					)

					if (data.length > 0) {
						await axios.put(
							`http://127.0.0.1:8000/api/purchases/update/${data[0].id}`,
							{
								user_id: this.user.id,
								product_id: this.product.id,
								amount: this.count,
								total: this.total
							}
						)
					} else {
						await axios.post('http://127.0.0.1:8000/api/purchases/create', {
							user_id: this.user.id,
							product_id: this.product.id,
							amount: this.count,
							total: this.total
						})
					}
				} else {
					alert('Please login to fill the cart')
				}
			},
			reduceCount() {
				if (this.count === 1 || this.count < 1) {
					this.count = 1
				} else {
					this.count -= 1
				}

				this.total = this.product.price * this.count
			},
			addCount() {
				this.count += 1

				this.total = this.product.price * this.count
			}
		}
	}
</script>
