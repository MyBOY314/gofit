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
    {
        path: '/register',
        name: 'register',
        component: () => import('@/components/RegistrationLayout.vue'),
    },
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
                path: "/peminjaman",
                name: "peminjaman.index",
                component: () =>
                    import('@/views/Peminjaman/indexPage.vue'),
            },
            {
                path: "/peminjaman/create",
                name: "peminjaman.create",
                component: () =>
                    import('@/views/Peminjaman/createPage.vue'),
            },
            {
                path: "/peminjaman/update",
                name: "peminjaman.update",
                component: () =>
                    import('@/views/Peminjaman/updatePage.vue'),
            },

            {
                path: "/penulis",
                name: "penulis.index",
                component: () =>
                    import('@/views//Penulis/indexPage.vue'),
            },
            {
                path: "/penulis/create",
                name: "penulis.create",
                component: () =>
                    import('@/views/Penulis/createPage.vue'),
            },
            {
                path: "/penulis/update",
                name: "penulis.update",
                component: () =>
                    import('@/views/Penulis/updatePage.vue'),
            },

            {
                path: "/buku",
                name: "buku.index",
                component: () =>
                    import('@/views//Buku/indexPage.vue'),
            },
            {
                path: "/buku/create",
                name: "buku.create",
                component: () =>
                    import('@/views/Buku/createPage.vue'),
            },
            {
                path: "/buku/update",
                name: "buku.update",
                component: () =>
                    import('@/views/Buku/updatePage.vue'),
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


            //New Beginnings
            {
                path: "/instruktur",
                name: "instruktur.index",
                component: () =>
                    import('@/views/Instruktur/indexPage.vue'),
            },
            {
                path: "/instruktur/create",
                name: "instruktur.create",
                component: () =>
                    import('@/views/Instruktur/createPage.vue'),
            },
            {
                path: "/instruktur/update",
                name: "instruktur.update",
                component: () =>
                    import('@/views/Instruktur/updatePage.vue'),
            },

            //Member
            {
                path: "/member",
                name: "member.index",
                component: () =>
                    import('@/views/Member/indexPage.vue'),
            },
            {
                path: "/member/create",
                name: "member.create",
                component: () =>
                    import('@/views/Member/createPage.vue'),
            },
            {
                path: "/member/update",
                name: "member.update",
                component: () =>
                    import('@/views/Member/updatePage.vue'),
            },

            {
                path: "/member/card",
                name: "member.card",
                component: () =>
                    import('@/views/Member/memberCardPage.vue'),
            },
            {
                path: "/member/aktivasi",
                name: "member.aktivasi",
                component: () =>
                    import('@/views/Member/aktivasiPage.vue'),
            },

            //Jadwal Umum
            {
                path: "/jadwalUmum",
                name: "jadwalUmum.index",
                component: () =>
                    import('@/views/JadwalUmum/indexPage.vue'),
            },
            {
                path: "/jadwalUmum/create",
                name: "jadwalUmum.create",
                component: () =>
                    import('@/views/JadwalUmum/createPage.vue'),
            },
            {
                path: "/jadwalUmum/update",
                name: "jadwalUmum.update",
                component: () =>
                    import('@/views/JadwalUmum/updatePage.vue'),
            },

             //Jadwal Harian
             {
                path: "/jadwalHarian",
                name: "jadwalHarian.index",
                component: () =>
                    import('@/views/JadwalHarian/indexPage.vue'),
            },

            {
                path: "/jadwalHarian",
                name: "jadwalHarian.create",
                component: () =>
                    import('@/views/JadwalHarian/createPage.vue'),
            },

            {
                path: "/jadwalHarian",
                name: "jadwalHarian.update",
                component: () =>
                    import('@/views/JadwalHarian/updatePage.vue'),
            },

            //Deposit Reguler
            {
                path: "/depositReguler",
                name: "depositReguler.index",
                component: () =>
                    import('@/views/DepositReguler/indexPage.vue'),
            },

            {
                path: "/depositReguler",
                name: "depositReguler.create",
                component: () =>
                    import('@/views/DepositReguler/createPage.vue'),
            },

            {
                path: "/depositReguler",
                name: "depositReguler.update",
                component: () =>
                    import('@/views/DepositReguler/updatePage.vue'),
            },

            {
                path: "/depositReguler",
                name: "depositReguler.struk",
                component: () =>
                    import('@/views/DepositReguler/strukPage.vue'),
            },

             //Deposit Kelas
             {
                path: "/depositKelas",
                name: "depositKelas.index",
                component: () =>
                    import('@/views/DepositKelas/indexPage.vue'),
            },

            {
                path: "/depositKelas",
                name: "depositKelas.create",
                component: () =>
                    import('@/views/DepositKelas/createPage.vue'),
            },

            {
                path: "/depositKelas",
                name: "depositKelas.update",
                component: () =>
                    import('@/views/DepositKelas/updatePage.vue'),
            },

            {
                path: "/depositKelas",
                name: "depositKelas.struk",
                component: () =>
                    import('@/views/DepositKelas/strukPage.vue'),
            },

            //Izin Instruktur
            {
                path: "/izinInstruktur",
                name: "izinInstruktur.index",
                component: () =>
                    import('@/views/IzinInstruktur/indexPage.vue'),
            },

            //Presensi
            {
                path: "/presensiGym",
                name: "presensiGym.index",
                component: () =>
                    import('@/views/PresensiGym/indexPage.vue'),
            },
            {
                path: "/presensiGym",
                name: "presensiGym.create",
                component: () =>
                    import('@/views/PresensiGym/createPage.vue'),
            },
            {
                path: "/presensiGym",
                name: "presensiGym.update",
                component: () =>
                    import('@/views/PresensiGym/updatePage.vue'),
            },

            {
                path: "/presensiGym",
                name: "presensiGym.struk",
                component: () =>
                    import('@/views/PresensiGym/strukPage.vue'),
            },

            {
                path: "/depositReguler",
                name: "depositReguler.struk",
                component: () =>
                    import('@/views/DepositReguler/strukPage.vue'),
            },

            //Laporan
            {
                path: "/laporanPendapatan",
                name: "laporan.pendapatan",
                component: () =>
                    import('@/views/Laporan/laporanPendapatanPage.vue'),
            },

            {
                path: "/laporanGym",
                name: "laporan.gym",
                component: () =>
                    import('@/views/Laporan/laporanGymPage.vue'),
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