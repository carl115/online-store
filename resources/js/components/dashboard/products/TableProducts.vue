<template>
	<div class="py-1">
		<div class="w-full xl:w-8/12 mt-12 mb-12 ml-[25%]">
			<div class="relative flex flex-col min-w-0 bg-white w-full mb-6 rounded">
				<div class="rounded-t mb-0 px-4 py-3 border-0">
					<div class="flex items-center justify-between">
						<div class="relative w-full max-w-full flex-grow flex-1">
							<h3 class="font-bold">Products</h3>
						</div>
						<div class="relative w-full max-w-full flex-grow flex-1 text-right">
							<button
								class="bg-green-500 text-white active:bg-green-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
								type="button"
								@click="createProduct"
							>
								Create Product
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
									Image
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Name
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Description
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Category
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Stock
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Price
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(product, index) in products" :key="index">
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									<img
										:src="`/storage/images/${product.image}`"
										v-if="!product.image.startsWith('http')"
									/>
									<img :src="product.image" v-else />
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ product.name }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4"
								>
									{{ product.description }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ product.category.name }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ product.stock }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ product.price }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									<button
										class="bg-blue-500 text-white active:bg-blue-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
										type="button"
										@click="updateProduct(product.id)"
									>
										Edit
									</button>
									<button
										class="bg-red-500 text-white active:bg-red-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
										type="button"
										@click="deleteProduct(product.id)"
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
		<product-form v-if="showProductForm"></product-form>
	</div>
</template>

<script>
	import 'datatables.net-dt'
	import ProductForm from './ProductForm.vue'

	export default {
		data() {
			return {
				is_create: null,
				products: [],
				productId: null,
				showProductForm: false
			}
		},
		components: {
			ProductForm
		},
		created() {
			this.getProducts()
		},
		methods: {
			mountTable() {
				$(document).ready(function () {
					$('#dataTables').DataTable()
				})
			},
			async getProducts() {
				const { data } = await axios.get('http://localhost:8000/api/products')

				this.products = data

				this.mountTable()
			},
			createProduct() {
				this.is_create = true
				this.showProductForm = true
			},
			updateProduct(id) {
				this.is_create = false
				this.showProductForm = true
				this.productId = id
			},
			async deleteProduct(id) {
				const result = await Swal.fire({
					title: 'Do you want to save the changes?',
					showCancelButton: true,
					confirmButtonText: 'Delete'
				})
				if (result.isConfirmed) {
					try {
						await axios.delete(`http://127.0.0.1:8000/api/products/delete/${id}`)

						this.getProducts()

						Swal.fire('Deleted!', 'Product deleted correctly', 'success')
					} catch (error) {
						Swal.fire('Error occurred!', '', 'error')
						console.error(error)
					}
				}
			}
		}
	}
</script>
