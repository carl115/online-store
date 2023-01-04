<template>
	<div class="mt-24">
		<div class="bg-white mx-24 mb-32">
			<div class="h-96 flex items-center justify-center" v-if="purchases.length <= 0">
				<a class="bg-black p-4 text-white rounded-md" href="/">Go to store</a>
			</div>
			<div class="divide-y divide-black" v-else>
				<div class="h-96 py-4 px-20 border border-white overflow-y-auto">
					<purchase-card
						v-for="(purchase, index) in purchases"
						:data="purchase"
						:key="index"
					>
						<button @click="deletePurchase(purchase.id)">
							<font-awesome-icon icon="fa-solid fa-xmark" />
						</button>
					</purchase-card>
				</div>
				<div className="w-full px-5 text-xl flex justify-between items-center">
					<p><strong>Total: </strong>${{ totalCart }}</p>
					<button
						className="bg-black py-2 px-4 border-t border-black text-white rounded-sm"
						@click="sale"
					>
						Sale
					</button>
				</div>
			</div>
		</div>
		<footer-page></footer-page>
	</div>
</template>

<script>
	import { library } from '@fortawesome/fontawesome-svg-core'
	import { faXmark } from '@fortawesome/free-solid-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
	import PurchaseCard from './PurchaseCard.vue'
	import FooterPage from '../FooterPage.vue'

	library.add(faXmark)

	export default {
		props: ['userData'],
		data() {
			return {
				user: {},
				product: {},
				purchases: [],
				totalCart: 0
			}
		},
		components: {
			PurchaseCard,
			FooterPage,
			FontAwesomeIcon
		},
		created() {
			this.getUser()
			this.getPurchases()
		},
		methods: {
			getUser() {
				this.user = JSON.parse(this.userData)
			},
			async getPurchases() {
				if (this.user) {
					const { data } = await axios.get(
						`http://127.0.0.1:8000/api/users/userPurchases/${this.user.id}`
					)

					this.purchases = data.purchases
					this.setTotalCart()
				}
			},
			async deletePurchase(id) {
				await axios.delete(`http://127.0.0.1:8000/api/purchases/delete/${id}`)

				this.getPurchases()
			},
			setTotalCart() {
				this.totalCart = 0

				for (const purchase of this.purchases) {
					this.totalCart += purchase.total
				}
			},
			async sale() {
				for (const purchase of this.purchases) {
					const { data } = await axios.get(
						`http://127.0.0.1:8000/api/products/product/${purchase.product_id}`
					)
					this.product = data

					await axios.post(
						`http://127.0.0.1:8000/api/products/update/${this.product.id}`,
						{
							stock: this.product.stock - purchase.amount
						}
					)

					await axios.delete(`http://127.0.0.1:8000/api/purchases/delete/${purchase.id}`)

					this.getPurchases()
				}
			}
		}
	}
</script>
