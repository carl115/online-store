<template>
	<div
		:className="`bg-white px-6 h-screen border border-slate-300 flex flex-col justify-evenly transition-all duration-150 ease-in-out fixed top-0 ${showShoppingCart} z-50`"
		style="width: 550px"
	>
		<div class="text-end">
			<button @click="closeShoppingCart" className="text-3xl">
				<font-awesome-icon icon="fa-solid fa-xmark" />
			</button>
		</div>
		<div className="h-96 overflow-y-auto">
			<div v-if="loader" class="h-full flex items-center justify-center">
				<font-awesome-icon class="text-4xl animate-spin" icon="fa-solid fa-spinner" />
			</div>
			<div v-else>
				<div v-if="purchases.length > 0">
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
			</div>
			<div
				v-if="purchases.length == 0"
				class="h-full flex items-center justify-center text-xl font-bold"
			>
				There aren't products in the shopping cart
			</div>
		</div>
		<div
			className="w-full text-xl flex justify-between opacity-25 items-center cursor-not-allowed"
			v-if="purchases.length == 0"
		>
			<p><strong>Total: </strong>${{ totalCart }}</p>
			<span className="bg-black py-2 px-4 text-white rounded-sm"> Finish sale </span>
		</div>
		<div className="w-full text-xl flex justify-between items-center" v-else>
			<p><strong>Total: </strong>${{ totalCart }}</p>
			<a href="/cart" className="bg-black py-2 px-4 text-white rounded-sm">Finish sale</a>
		</div>
	</div>
</template>

<script>
	import { library } from '@fortawesome/fontawesome-svg-core'
	import { faXmark, faSpinner } from '@fortawesome/free-solid-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
	import PurchaseCard from './PurchaseCard.vue'

	library.add(faXmark, faSpinner)

	export default {
		data() {
			return {
				loader: true,
				user: {},
				purchases: [],
				totalCart: 0
			}
		},
		components: {
			FontAwesomeIcon,
			PurchaseCard
		},
		computed: {
			showShoppingCart() {
				return !this.$parent.showCart ? 'right-[-550px]' : 'right-0'
			}
		},
		created() {
			this.getUser()
			this.getPurchases()
		},
		methods: {
			async getPurchases() {
				if (this.$parent.userData) {
					const { data } = await axios.get(
						`http://127.0.0.1:8000/api/users/userPurchases/${this.user.id}`
					)

					this.purchases = data.purchases
					this.setTotalCart()
				}

				if (this.purchases.length <= 0) {
					this.$parent.purchases = 0
				}

				this.loader = false
			},
			getUser() {
				if (this.$parent.userData) {
					this.user = JSON.parse(this.$parent.userData)
				}
			},
			async deletePurchase(id) {
				this.loader = true

				await axios.delete(`http://127.0.0.1:8000/api/purchases/delete/${id}`)

				this.getPurchases()
			},
			setTotalCart() {
				this.totalCart = 0

				for (const purchase of this.purchases) {
					this.totalCart += purchase.total
				}
			},
			closeShoppingCart() {
				this.$parent.showCart = false
			}
		}
	}
</script>
