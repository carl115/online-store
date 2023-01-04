<template>
	<div
		class="mt-5 px-96 md:col-span-2 md:mt-0 fixed top-5 right-0 left-0 ease-linear transition-all duration-100 z-50"
	>
		<div class="border border-slate-300 shadow sm:overflow-hidden sm:rounded-md">
			<form @submit.prevent="handleSubmit">
				<div class="space-y-6 bg-white px-4 py-5 sm:p-6">
					<div class="grid grid-cols-6 gap-6">
						<div class="col-span-6 sm:col-span-3">
							<label class="block text-sm font-medium text-gray-700"
								>Product name</label
							>
							<input
								type="text"
								name="name"
								class="w-full mt-1 p-2 block rounded-md border border-gray-300 outline-slate-900 shadow-sm sm:text-sm"
								v-model="product.name"
							/>
						</div>
						<div class="col-span-6 sm:col-span-3">
							<label class="block text-sm font-medium text-gray-700">Stock</label>
							<input
								type="number"
								name="stock"
								class="w-full mt-1 p-2 block rounded-md border border-gray-300 outline-slate-900 shadow-sm sm:text-sm"
								v-model="product.stock"
							/>
						</div>
						<div class="col-span-6 sm:col-span-3">
							<label class="block text-sm font-medium text-gray-700">Price</label>
							<input
								type="number"
								name="price"
								placeholder="$"
								class="w-full mt-1 p-2 block rounded-md border border-gray-300 outline-slate-900 shadow-sm sm:text-sm"
								v-model="product.price"
							/>
						</div>
						<div class="col-span-6 sm:col-span-3">
							<label class="block text-sm font-medium text-gray-700">Category</label>
							<select
								name="category"
								class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm outline-slate-900 sm:text-sm"
								v-model="product.category_id"
							>
								<option
									v-for="(category, index) in categories"
									:value="category.id"
									:key="index"
								>
									{{ category.name }}
								</option>
							</select>
						</div>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700">Description</label>
						<textarea
							class="w-full h-20 mt-1 p-2 block rounded-md border border-gray-300 outline-slate-900 shadow-sm sm:text-sm resize-none"
							v-model="product.description"
						></textarea>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700">Product image</label>
						<div
							class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6"
						>
							<div class="space-y-1 text-center">
								<svg
									class="mx-auto h-12 w-12 text-gray-400"
									stroke="currentColor"
									fill="none"
									viewBox="0 0 48 48"
									aria-hidden="true"
								>
									<path
										d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
								</svg>
								<div class="flex text-sm text-gray-600">
									<label
										class="relative cursor-pointer rounded-md bg-white font-medium text-slate-900 focus-within:outline-none hover:text-slate-500"
									>
										<span>Upload a file</span>
										<input
											@change="uploadImage"
											name="file-upload"
											type="file"
											accept="image/*"
											class="sr-only"
										/>
									</label>
									<p class="pl-1">or drag and drop</p>
								</div>
								<p class="text-xs text-gray-500">JPG, PNG up to 10MB</p>
							</div>
						</div>
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
				product: {},
				file: null,
				categories: []
			}
		},
		created() {
			this.getCategories()

			if (!this.$parent.is_create) {
				this.getProduct()
			}
		},
		methods: {
			async getProduct() {
				const { data } = await axios.get(
					`http://127.0.0.1:8000/api/products/product/${this.$parent.productId}`
				)

				this.product = data
			},
			async getCategories() {
				const { data } = await axios.get('http://127.0.0.1:8000/api/categories')

				this.categories = data
			},
			hiddeForm() {
				this.$parent.showProductForm = false
			},
			productData() {
				let formData = new FormData()

				if (this.file) {
					formData.append('image', this.file, this.file.name)
				}

				formData.append('category_id', this.product.category_id)
				formData.append('name', this.product.name)
				formData.append('stock', this.product.stock)
				formData.append('description', this.product.description)
				formData.append('price', this.product.price)

				return formData
			},
			uploadImage(e) {
				this.file = e.target.files[0]
			},
			async handleSubmit() {
				const product = this.productData()

				try {
					if (this.$parent.is_create) {
						await axios.post('http://127.0.0.1:8000/api/products/create', product)

						this.$parent.showProductForm = false
						this.$parent.getProducts()
					} else {
						await axios.post(
							`http://127.0.0.1:8000/api/products/update/${this.product.id}`,
							product
						)

						this.$parent.showProductForm = false
						this.$parent.getProducts()
					}

					Swal.fire('Saved!', 'Product saved correctly', 'success')
				} catch (error) {
					Swal.fire('Error occurred!', '', 'error')
					console.error(error)
				}
			}
		}
	}
</script>
