<template>
	<font-awesome-icon icon="fa-regular fa-gem" class="text-7xl" />
	<div class="text-slate-300 flex justify-between items-center">
		<a href="/" class="mr-3 hover:text-white">Home</a>
		<div class="block">
			<button @mouseover="show" @mouseout="show" class="mr-3 hover:text-white">
				Categories
				<font-awesome-icon icon="fa-solid fa-caret-down" />
			</button>
			<div
				class="bg-slate-900 p-5 flex flex-col absolute"
				@mouseover="show"
				@mouseout="show"
				v-show="showCategories"
			>
				<ul>
					<li v-for="(category, index) in categories" :key="index" class="my-4">
						<a
							:href="`http://127.0.0.1:8000/category/${category.id}/products`"
							class="hover:text-white"
							>{{ category.name }}</a
						>
					</li>
				</ul>
			</div>
		</div>
		<slot></slot>
	</div>
</template>

<script>
	import { library } from '@fortawesome/fontawesome-svg-core'
	import { faGem } from '@fortawesome/free-regular-svg-icons'
	import { faCaretDown } from '@fortawesome/free-solid-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

	library.add(faGem, faCaretDown)

	export default {
		data() {
			return {
				categories: [],
				showCategories: false
			}
		},
		components: {
			FontAwesomeIcon
		},
		created() {
			this.getCategories()
		},
		methods: {
			async getCategories() {
				const { data } = await axios.get('http://127.0.0.1:8000/api/categories')
				this.categories = data
			},
			show(e) {
				if (e.type === 'mouseover') {
					this.showCategories = true
				} else {
					this.showCategories = false
				}
			}
		}
	}
</script>
