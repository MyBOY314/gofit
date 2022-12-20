//import vue router
import { createRouter, createWebHistory } from 'vue-router'
//define a routes
const routes = [
    {
        path: '/',
        name: 'opening',
        component: () => import('@/components/OpeningPage.vue'),
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('@/components/LoginLayout.vue'),
    },
    // {
    //     path: '/register',
    //     name: 'register',
    //     component: () => import('@/components/RegisterPage.vue'),
    // },
    {
        path: '/beranda',
        name: 'beranda',
        component: () => import('@/components/DashboardLayout.vue'),
        children: [
            {
                path: "/pengguna",
                name: "pengguna.index",
                component: () =>
                    import('@/views/Pengguna/indexPage.vue'),
            },
            {
                path: "/pengguna/create",
                name: "pengguna.create",
                component: () =>
                    import('@/views/Pengguna/createPage.vue'),
            },
            {
                path: "/pengguna/update",
                name: "pengguna.update",
                component: () =>
                    import('@/views/Pengguna/updatePage.vue'),
            },

            {
                path: "/pegawai",
                name: "pegawai.index",
                component: () =>
                    import('@/views/Pegawai/indexPage.vue'),
            },
            {
                path: "/pegawai/create",
                name: "pegawai.create",
                component: () =>
                    import('@/views/Pegawai/createPage.vue'),
            },
            {
                path: "/pegawai/update",
                name: "pegawai.update",
                component: () =>
                    import('@/views/Pegawai/updatePage.vue'),
            },
            {
                path: "/proyek",
                name: "proyek.index",
                component: () =>
                    import('@/views//Proyek/indexPage.vue'),
            },
            {
                path: "/proyek/create",
                name: "proyek.create",
                component: () =>
                    import('@/views/Proyek/createPage.vue'),
            },
            {
                path: "/proyek/update",
                name: "proyek.update",
                component: () =>
                    import('@/views//Proyek/updatePage.vue'),
            },
        ],
    },
]
//create router
const router = createRouter({
    history: createWebHistory(),
    routes // config routes
})
export default router;