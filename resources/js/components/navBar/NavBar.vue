<template>
	<div
		class="w-full p-3 text-white flex justify-around items-center fixed top-0 z-40"
		v-if="styleMenu"
	>
		<content>
			<slot></slot>
			<button @click="openShoppingCart" class="relative text-white text-lg px-1">
				<font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-white text-lg" />
				<span
					v-if="purchases > 0"
					class="bg-red-600 w-2 h-2 rounded absolute right-0"
				></span>
			</button>
		</content>
	</div>
	<div
		class="bg-gray-800/[.7] w-full p-3 text-white border-b border-zinc-300 flex justify-around items-center backdrop-blur-[15px] fixed top-0 z-40"
		v-else
	>
		<content>
			<slot></slot>
			<button @click="openShoppingCart" class="relative text-white text-lg px-1">
				<font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-white text-lg" />
				<span
					v-if="purchases > 0"
					class="bg-red-600 w-2 h-2 rounded absolute right-0"
				></span>
			</button>
		</content>
	</div>
	<shopping-cart></shopping-cart>
</template>

<script>
	import { library } from '@fortawesome/fontawesome-svg-core'
	import { faShoppingCart } from '@fortawesome/free-solid-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
	import Content from './Content.vue'
	import ShoppingCart from '../shoppingCart/ShoppingCart.vue'

	library.add(faShoppingCart)

	export default {
		props: ['userData'],
		data() {
			return {
				user: {},
				purchases: 0,
				styleMenu: true,
				showCart: false
			}
		},
		components: {
			FontAwesomeIcon,
			Content,
			ShoppingCart
		},
		created() {
			this.index()
			this.getPurchases()
		},
		methods: {
			index() {
				window.addEventListener('scroll', () => {
					if (window.pageYOffset > 0) {
						this.styleMenu = false
					} else {
						this.styleMenu = true
					}
				})
			},
			async getPurchases() {
				if (this.userData) {
					this.user = JSON.parse(this.userData)

					const { data } = await axios.get(
						`http://127.0.0.1:8000/api/users/userPurchases/${this.user.id}`
					)

					this.purchases = data.purchases.length
				}
			},
			openShoppingCart() {
				this.showCart = true
			}
		}
	}
</script>
