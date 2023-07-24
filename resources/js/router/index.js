import { createRouter, createWebHistory } from 'vue-router'
import store from '@/store'
/* Start Guest Component */
import  Login from '@/auth/Login.vue'
import Register from '@/auth/Register.vue'
/* End Guest Component */

/* Start Authenticated Component */
import Dashboard from '@/App.vue'
import SubcategoryComponent from '@/main/CategoryProducts.vue'
import AllProducts from '@/main/Index.vue'
import WishlistsIndex from '@/wishlist/Wishlist.vue'
// Products components:
import ProductIndex from '@/products/Index.vue'
import ProductCreate from '@/products/Create.vue'
import ProductShow from '@/products/Show.vue'
import ProductEdit from '@/products/Edit.vue'
import MyOrders from '@/products/MyOrders.vue'
// Stores components:
import StoreIndex from '@/shops/Index.vue'
import StoreCreate from '@/shops/Create.vue'
import StoreShow from '@/shops/Show.vue'
import StoreEdit from '@/shops/Edit.vue'

// Checkout component:
import Checkout from '@/cart/Checkout.vue'
/* End Authenticated Component */

const router = createRouter({
    history: createWebHistory(),
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        }

        return { top: 0, left: 0 }
    },
    routes: [
        {
            path: '/',
            redirect: '/all-products'
        },
        {
            path: '/dashboard',
            redirect: '/all-products'
        },
        {
            name: "login",
            path: "/login",
            component: Login,
            meta: {
                middleware: "guest",
                title: `Login`
            }
        },
        {
            name: "register",
            path: "/register",
            component: Register,
            meta: {
                middleware: "guest",
                title: `Register`
            }
        },
        {
            name: "all-products",
            path: "/all-products",
            component: AllProducts,
            meta: {
                title: `All-On-My-Web`
            },
        },
        {
            name: 'subcategory.products',
            path: '/category/subcategory/:id/:slug',
            component: SubcategoryComponent,
        },
        {
            name: 'my-orders',
            path: '/my-orders',
            component: MyOrders,
            meta: {
                middleware: "auth"
            }
        },
        {
            name: 'stores.index',
            path: '/stores',
            component: StoreIndex,
        },
        {
            name: 'stores.create',
            path: '/stores/create',
            component: StoreCreate,
            meta: {
                middleware: "auth"
            }
        },
        {
            name: 'stores.show',
            path: '/stores/:id',
            component: StoreShow,
        },
        {
            name: 'stores.edit',
            path: '/stores/:id/edit',
            component: StoreEdit,
            meta: {
                middleware: "auth"
            }
        },
        {
            name: 'products.index',
            path: '/products',
            component: ProductIndex,
        },
        {
            name: 'products.create',
            path: '/products/create',
            component: ProductCreate,
            meta: {
                middleware: "auth"
            }
        },
        {
            name: 'products.show',
            path: '/products/:id',
            component: ProductShow,
        },
        {
            name: 'products.edit',
            path: '/products/:id/edit',
            component: ProductEdit,
            meta: {
                middleware: "auth"
            }
        },
        {
            name: 'wishlists.index',
            path: '/wishlists',
            component: WishlistsIndex,
        },
        {
            name: 'checkout.index',
            path: '/cart/checkout',
            component: Checkout,
        },
        // {login
        //     path: '/:catchAll(.*)',
        //     name: '404Name',
        //     component: () => import('../views/NotFound.vue')
        // }
    ]
})

// Route guards
router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    if (to.meta.middleware == "auth") {
        if (!store.state.auth.authenticated) {
            next({ name: "login" });
        } else {
            next();
        }
    } else if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "all-products" });
        } else {
            next();
        }
    } else {
        next();
    }
})

export default router
