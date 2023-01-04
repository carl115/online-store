<template>
	<div class="w-full p-3 flex justify-between items-center">
		<div>
			<img
				class="h-28"
				:src="`/storage/images/${product_image}`"
				v-if="!product_image.startsWith('http')"
			/>
			<img class="h-28" :src="product_image" v-else />
		</div>
		<div>
			<h2 class="font-bold">{{ product.name }}</h2>
			<span>${{ product.price }}</span>
		</div>
		<div class="w-auto h-full">
			<button
				@click="addCount"
				class="bg-black w-7 text-white text-center text-lg rounded-full"
			>
				<font-awesome-icon icon="fa-solid fa-plus" />
			</button>
			<input
				class="w-12 h-16 mx-2 text-center text-lg focus:outline-none"
				type="number"
				:value="count"
			/>
			<button
				@click="reduceCount"
				class="bg-black w-7 text-white text-center text-lg rounded-full"
			>
				<font-awesome-icon icon="fa-solid fa-minus" />
			</button>
		</div>
		<slot></slot>
	</div>
</template>

<script>
	import { library } from '@fortawesome/fontawesome-svg-core'
	import { faPlus, faMinus, faXmark } from '@fortawesome/free-solid-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

	library.add(faPlus, faMinus, faXmark)

	export default {
		props: ['data'],
		data() {
			return {
				product: {},
				product_image: '',
				count: this.data.amount,
				total: this.data.total
			}
		},
		components: {
			FontAwesomeIcon
		},
		created() {
			this.getProduct()
		},
		methods: {
			async getProduct() {
				const { data } = await axios.get(
					`http://127.0.0.1:8000/api/products/product/${this.data.product_id}`
				)

				this.product = data
				this.product_image = data.image
			},
			async addCount() {
				this.$parent.loader = true
				this.count = this.count + 1
				this.total = this.product.price * this.count

				await axios.put(`http://127.0.0.1:8000/api/purchases/update/${this.data.id}`, {
					user_id: this.data.user_id,
					product_id: this.data.product_id,
					amount: this.count,
					total: this.total
				})

				this.$parent.getPurchases()
			},
			async reduceCount() {
				this.$parent.loader = true

				if (this.count == 1) {
					this.count = 1
				} else {
					this.count = this.count - 1
				}

				this.total = this.product.price * this.count

				await axios.put(`http://127.0.0.1:8000/api/purchases/update/${this.data.id}`, {
					user_id: this.data.user_id,
					product_id: this.data.product_id,
					amount: this.count,
					total: this.total
				})

				this.$parent.getPurchases()
			}
		}
	}
</script>
