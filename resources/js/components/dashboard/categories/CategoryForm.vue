<template>
	<div
		class="mt-5 px-96 md:col-span-2 md:mt-0 fixed top-5 right-0 left-0 ease-linear transition-all duration-100 z-50"
	>
		<div class="border border-slate-300 shadow sm:overflow-hidden sm:rounded-md">
			<form @submit.prevent="handleSubmit">
				<div class="space-y-6 bg-white px-4 py-5 sm:p-6">
					<div class="col-span-6 sm:col-span-3">
						<label class="block text-sm font-medium text-gray-700">Category name</label>
						<input
							type="text"
							name="name"
							class="w-full mt-1 p-2 block rounded-md border border-gray-300 outline-slate-900 shadow-sm sm:text-sm"
							v-model="category.name"
						/>
					</div>
				</div>
				<div class="bg-white px-4 py-3 text-right flex justify-between sm:px-6">
					<button
						type="button"
						class="inline-flex justify-center rounded-md bg-red-500 py-2 px-4 text-sm font-medium text-white shadow-sm active:bg-red-700 ease-linear transition-all duration-150"
						@click="hiddeForm"
					>
						Cancel
					</button>
					<button
						type="submit"
						class="inline-flex justify-center rounded-md bg-green-500 py-2 px-4 text-sm font-medium text-white shadow-sm active:bg-green-700 ease-linear transition-all duration-150"
					>
						Save
					</button>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				category: {}
			}
		},
		created() {
			if (!this.$parent.is_create) {
				this.getCategory()
			}
		},
		methods: {
			async getCategory() {
				const { data } = await axios.get(
					`http://127.0.0.1:8000/api/categories/category/${this.$parent.categoryId}`
				)

				this.category = data
			},
			hiddeForm() {
				this.$parent.showCategoryForm = false
			},
			async handleSubmit() {
				try {
					if (this.$parent.is_create) {
						await axios.post(
							'http://127.0.0.1:8000/api/categories/create',
							this.category
						)

						this.$parent.showCategoryForm = false
						this.$parent.getCategories()
					} else {
						await axios.put(
							`http://127.0.0.1:8000/api/categories/update/${this.category.id}`,
							this.category
						)

						this.$parent.showCategoryForm = false
						this.$parent.getCategories()
					}

					Swal.fire('Saved!', 'Category saved correctly', 'success')
				} catch (error) {
					Swal.fire('Error occurred!', '', 'error')
					console.error(error)
				}
			}
		}
	}
</script>
