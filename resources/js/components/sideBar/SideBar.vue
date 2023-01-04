<template>
	<div class="h-screen flex flex-row fixed z-20">
		<div
			class="bg-slate-900 h-screen md:block shadow-xl px-3 w-30 md:w-60 lg:w-60 overflow-x-hidden transition-transform duration-300 ease-in-out"
		>
			<div class="space-y-6 md:space-y-10 mt-10">
				<h1 class="text-white font-bold text-xl text-center">Dashboard</h1>
				<div class="space-y-3">
					<div class="w-full">
						<h2 class="font-medium text-xs md:text-sm text-center text-slate-500">
							{{ userName }}
						</h2>
						<p class="text-xs text-slate-300 text-center">Administrator</p>
						<div class="w-full mt-4 flex justify-center">
							<a
								class="font-medium text-xs md:text-sm text-center text-slate-500 hover:text-white"
								:href="actionLogout"
							>
								Logout
							</a>
						</div>
					</div>
				</div>
				<div class="flex flex-col space-y-2">
					<a
						:href="linkProducts"
						class="text-sm text-gray-700 py-2 px-2 flex align-center hover:bg-slate-500 hover:text-white rounded-md transition duration-150 ease-in-out"
					>
						<font-awesome-icon class="mr-3 text-lg" icon="fa-solid fa-boxes-stacked" />
						<span>Products</span>
					</a>
					<a
						:href="linkPurchases"
						class="text-sm text-gray-700 py-2 px-2 flex align-center hover:bg-slate-500 hover:text-white rounded-md transition duration-150 ease-in-out"
					>
						<font-awesome-icon class="mr-3 text-lg" icon="fa-solid fa-sack-dollar" />
						<span>Purchases</span>
					</a>
					<a
						:href="linkCategories"
						class="text-sm text-gray-700 py-2 px-2 flex align-center hover:bg-slate-500 hover:text-white rounded-md transition duration-150 ease-in-out"
					>
						<font-awesome-icon class="mr-3 text-lg" icon="fa-solid fa-layer-group" />
						<span>Categories</span>
					</a>
					<a
						:href="linkUsers"
						class="text-sm text-gray-700 py-2 px-2 flex align-center hover:bg-slate-500 hover:text-white rounded-md transition duration-150 ease-in-out"
					>
						<font-awesome-icon class="mr-3 text-lg" icon="fa-solid fa-user" />
						<span>Users</span>
					</a>
					<hr />
					<a
						href="/"
						class="my-3 text-sm text-gray-700 py-2 px-2 flex align-center hover:bg-slate-500 hover:text-white rounded-md transition duration-150 ease-in-out"
					>
						<font-awesome-icon
							class="mr-3 text-lg rotate-180"
							icon="fa-solid fa-right-from-bracket"
						/>
						<span>Go to store</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { library } from '@fortawesome/fontawesome-svg-core'
	import {
		faBoxesStacked,
		faRightFromBracket,
		faSackDollar,
		faLayerGroup,
		faUser
	} from '@fortawesome/free-solid-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

	library.add(faBoxesStacked, faRightFromBracket, faSackDollar, faLayerGroup, faUser)

	export default {
		props: [
			'actionLogout',
			'userName',
			'linkProducts',
			'linkPurchases',
			'linkCategories',
			'linkUsers'
		],
		data() {
			return {
				show: false
			}
		},
		components: {
			FontAwesomeIcon
		},
		computed: {
			showProfileOptions() {
				return !this.show ? 'hidden' : ''
			}
		},
		methods: {
			handleSubmit() {},
			showOptions() {
				this.show = true
			},
			hiddeOptions() {
				this.show = false
			}
		}
	}
</script>
