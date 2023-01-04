import './bootstrap'
import { createApp } from 'vue'

import NavBar from './components/navBar/NavBar.vue'
import MainPage from './components/MainPage.vue'
import Product from './components/products/Product.vue'
import ProductsCategory from './components/categories/ProductsCategory.vue'
import LoginPage from './components/login/LoginPage.vue'
import SideBar from './components/sideBar/SideBar.vue'
import TableProducts from './components/dashboard/products/TableProducts.vue'
import TablePurchases from './components/dashboard/purchases/TablePurchases.vue'
import TableCategories from './components/dashboard/categories/TableCategories.vue'
import TableUsers from './components/dashboard/users/TableUsers.vue'
import Cart from './components/shoppingCart/Cart.vue'

const app = createApp({})

app.component('NavBar', NavBar)
	.component('MainPage', MainPage)
	.component('Product', Product)
	.component('ProductsCategory', ProductsCategory)
	.component('LoginPage', LoginPage)
	.component('SideBar', SideBar)
	.component('TableProducts', TableProducts)
	.component('TablePurchases', TablePurchases)
	.component('TableCategories', TableCategories)
	.component('TableUsers', TableUsers)
	.component('Cart', Cart)

app.mount('#app')
