<template>
	<div class="py-1">
		<div class="w-full xl:w-8/12 mt-12 mb-12 ml-[25%]">
			<div class="relative flex flex-col min-w-0 bg-white w-full mb-6 rounded">
				<div class="rounded-t mb-0 px-4 py-3 border-0">
					<div class="flex items-center justify-between">
						<div class="relative w-full max-w-full flex-grow flex-1">
							<h3 class="font-bold">Categories</h3>
						</div>
						<div class="relative w-full max-w-full flex-grow flex-1 text-right">
							<button
								class="bg-green-500 text-white active:bg-green-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
								type="button"
								@click="createCategory"
							>
								Create Category
							</button>
						</div>
					</div>
				</div>
				<div class="block w-full overflow-x-auto">
					<table
						id="dataTables"
						class="items-center bg-transparent w-full border-collapse"
					>
						<thead>
							<tr>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Category name
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(category, index) in categories" :key="index">
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ category.name }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									<button
										class="bg-blue-500 text-white active:bg-blue-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
										type="button"
										@click="updateCategory(category.id)"
									>
										Edit
									</button>
									<button
										class="bg-red-500 text-white active:bg-red-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
										type="button"
										@click="deleteCategory(category.id)"
									>
										Delete
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<category-form v-if="showCategoryForm"></category-form>
	</div>
</template>

<script>
	import CategoryForm from './CategoryForm.vue'

	export default {
		data() {
			return {
				is_create: null,
				categories: [],
				categoryId: null,
				showCategoryForm: false
			}
		},
		components: {
			CategoryForm
		},
		created() {
			this.getCategories()
		},
		methods: {
			mountTable() {
				$(document).ready(function () {
					$('#dataTables').DataTable()
				})
			},
			async getCategories() {
				const { data } = await axios.get('http://localhost:8000/api/categories')

				this.categories = data

				this.mountTable()
			},
			createCategory() {
				this.is_create = true
				this.showCategoryForm = true
			},
			updateCategory(id) {
				this.is_create = false
				this.showCategoryForm = true
				this.categoryId = id
			},
			async deleteCategory(id) {
				const result = await Swal.fire({
					title: 'Are you sure to delete the category?',
					showCancelButton: true,
					confirmButtonText: 'Delete'
				})
				if (result.isConfirmed) {
					try {
						await axios.delete(`http://127.0.0.1:8000/api/categories/delete/${id}`)

						this.getCategories()

						Swal.fire('Deleted!', 'Category deleted correctly', 'success')
					} catch (error) {
						Swal.fire('Error occurred!', '', 'error')
						console.error(error)
					}
				}
			}
		}
	}
</script>
