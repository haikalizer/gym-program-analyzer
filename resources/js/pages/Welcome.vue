<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';

const features = [
    {
        number: '01',
        title: 'Program Tracking',
        description:
            'Catat program latihan, jenis exercise, jumlah set, repetisi, dan beban dalam satu tempat.',
        icon: '▤',
    },
    {
        number: '02',
        title: 'Muscle Balance',
        description:
            'Evaluasi distribusi set setiap kelompok otot untuk menemukan potensi ketidakseimbangan latihan.',
        icon: '◫',
    },
    {
        number: '03',
        title: 'AI Form Analysis',
        description:
            'Unggah foto posisi latihan untuk mendapatkan analisis teknik dasar berbantuan AI.',
        icon: '✳',
    },
];
</script>

<template>
    <Head title="Gym Program Analyzer" />

    <div
        class="min-h-screen overflow-hidden bg-[#0b0d0c] text-white selection:bg-lime-300 selection:text-black"
    >
        <!-- Navbar -->
        <header
            class="border-b border-white/10"
        >
            <nav
                class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-10"
            >
                <Link
                    href="/"
                    class="flex items-center gap-3"
                >
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-lime-300 text-xl font-black text-black"
                    >
                        G
                    </div>

                    <div>
                        <p class="text-sm font-black tracking-wide">
                            GYM<span class="text-lime-300">ANALYZER</span>
                        </p>
                        <p class="text-[10px] tracking-[0.2em] text-gray-500">
                            TRAIN SMARTER
                        </p>
                    </div>
                </Link>

                <div class="flex items-center gap-3">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="rounded-full px-4 py-2 text-sm text-gray-300 transition hover:text-lime-300"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="login()"
                            class="hidden rounded-full px-4 py-2 text-sm text-gray-300 transition hover:text-white sm:block"
                        >
                            Login
                        </Link>

                        <Link
                            :href="register()"
                            class="rounded-full bg-lime-300 px-5 py-2.5 text-sm font-bold text-black transition hover:bg-lime-200"
                        >
                            Get Started
                        </Link>
                    </template>
                </div>
            </nav>
        </header>

        <!-- Hero -->
        <main>
            <section
                class="relative mx-auto grid max-w-7xl items-center gap-14 px-6 py-20 lg:grid-cols-2 lg:px-10 lg:py-28"
            >
                <div
                    class="pointer-events-none absolute -left-40 top-10 h-96 w-96 rounded-full bg-lime-300/5 blur-3xl"
                ></div>

                <div class="relative z-10">
                    <div
                        class="mb-7 inline-flex items-center gap-2 rounded-full border border-lime-300/20 bg-lime-300/5 px-4 py-2 text-xs font-semibold tracking-wide text-lime-300"
                    >
                        <span
                            class="h-2 w-2 rounded-full bg-lime-300"
                        ></span>
                        YOUR PERSONAL TRAINING ANALYZER
                    </div>

                    <h1
                        class="max-w-2xl text-5xl leading-[1.08] font-black tracking-tight sm:text-6xl lg:text-7xl"
                    >
                        Don't Just
                        <span class="text-gray-500">Lift.</span>
                        <span class="mt-2 block text-lime-300">
                            Train Smarter.
                        </span>
                    </h1>

                    <p
                        class="mt-7 max-w-xl text-base leading-8 text-gray-400 sm:text-lg"
                    >
                        Analisis program gym, evaluasi distribusi latihan
                        otot, dan pelajari teknik gerakan dengan bantuan AI.
                        Jadikan setiap sesi latihan lebih terarah.
                    </p>

                    <div class="mt-9 flex flex-wrap gap-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="dashboard()"
                            class="rounded-full bg-lime-300 px-7 py-4 text-sm font-bold text-black transition hover:-translate-y-0.5 hover:bg-lime-200"
                        >
                            Buka Dashboard →
                        </Link>

                        <Link
                            v-else
                            :href="register()"
                            class="rounded-full bg-lime-300 px-7 py-4 text-sm font-bold text-black transition hover:-translate-y-0.5 hover:bg-lime-200"
                        >
                            Mulai Sekarang →
                        </Link>

                        <a
                            href="#features"
                            class="rounded-full border border-white/15 px-7 py-4 text-sm font-semibold text-white transition hover:border-lime-300/50 hover:text-lime-300"
                        >
                            Jelajahi Fitur
                        </a>
                    </div>

                    <div
                        class="mt-12 flex flex-wrap gap-x-8 gap-y-4 border-t border-white/10 pt-7"
                    >
                        <div>
                            <p class="text-sm font-bold text-white">
                                Workout Log
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Catat setiap sesi
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-bold text-white">
                                Muscle Analysis
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Evaluasi distribusi set
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-bold text-white">
                                AI Assistance
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Analisis foto latihan
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Hero visual -->
                <div class="relative">
                    <div
                        class="absolute inset-0 rounded-[2rem] bg-lime-300/10 blur-3xl"
                    ></div>

                    <div
                        class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-[#121613] p-5 shadow-2xl sm:p-7"
                    >
                        <div
                            class="flex items-center justify-between border-b border-white/10 pb-5"
                        >
                            <div>
                                <p
                                    class="text-xs font-semibold tracking-widest text-gray-500 uppercase"
                                >
                                    Training Overview
                                </p>
                                <h2 class="mt-2 text-xl font-bold">
                                    Weekly Performance
                                </h2>
                            </div>

                            <span
                                class="rounded-full border border-lime-300/20 bg-lime-300/10 px-3 py-1.5 text-xs text-lime-300"
                            >
                                DEMO
                            </span>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div
                                class="rounded-2xl border border-white/5 bg-white/[0.03] p-5"
                            >
                                <p class="text-sm text-gray-500">
                                    Training Volume
                                </p>
                                <p
                                    class="mt-3 text-3xl font-black text-white"
                                >
                                    18
                                    <span
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        sets
                                    </span>
                                </p>
                                <p class="mt-2 text-xs text-gray-500">
                                    Contoh data latihan
                                </p>
                            </div>

                            <div
                                class="rounded-2xl border border-white/5 bg-white/[0.03] p-5"
                            >
                                <p class="text-sm text-gray-500">
                                    Muscle Groups
                                </p>
                                <p
                                    class="mt-3 text-3xl font-black text-lime-300"
                                >
                                    6
                                </p>
                                <p class="mt-2 text-xs text-gray-500">
                                    Kelompok otot
                                </p>
                            </div>
                        </div>

                        <div
                            class="mt-5 rounded-2xl border border-white/5 bg-white/[0.03] p-5"
                        >
                            <div
                                class="mb-5 flex items-center justify-between"
                            >
                                <p class="text-sm font-semibold">
                                    Muscle Distribution
                                </p>
                                <span class="text-xs text-gray-500">
                                    Sample
                                </span>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <div
                                        class="mb-2 flex justify-between text-xs"
                                    >
                                        <span class="text-gray-400">
                                            Chest
                                        </span>
                                        <span class="text-white">8 sets</span>
                                    </div>
                                    <div
                                        class="h-2 overflow-hidden rounded-full bg-white/5"
                                    >
                                        <div
                                            class="h-full w-4/5 rounded-full bg-lime-300"
                                        ></div>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        class="mb-2 flex justify-between text-xs"
                                    >
                                        <span class="text-gray-400">
                                            Back
                                        </span>
                                        <span class="text-white">6 sets</span>
                                    </div>
                                    <div
                                        class="h-2 overflow-hidden rounded-full bg-white/5"
                                    >
                                        <div
                                            class="h-full w-3/5 rounded-full bg-lime-300/70"
                                        ></div>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        class="mb-2 flex justify-between text-xs"
                                    >
                                        <span class="text-gray-400">
                                            Legs
                                        </span>
                                        <span class="text-white">4 sets</span>
                                    </div>
                                    <div
                                        class="h-2 overflow-hidden rounded-full bg-white/5"
                                    >
                                        <div
                                            class="h-full w-2/5 rounded-full bg-lime-300/40"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p
                            class="mt-4 text-center text-[11px] leading-5 text-gray-600"
                        >
                            Ilustrasi data demonstrasi, bukan hasil analisis
                            pengguna yang sebenarnya.
                        </p>
                    </div>

                    <div
                        class="absolute -right-3 -bottom-5 hidden rounded-2xl border border-white/10 bg-[#1a201b] p-4 shadow-xl sm:block"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-lime-300/10 text-lg text-lime-300"
                            >
                                ✳
                            </div>
                            <div>
                                <p class="text-sm font-bold">AI Assistance</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    Photo-based analysis
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features -->
            <section
                id="features"
                class="border-t border-white/10 bg-[#101310] px-6 py-20 lg:px-10 lg:py-24"
            >
                <div class="mx-auto max-w-7xl">
                    <div
                        class="flex flex-col justify-between gap-5 md:flex-row md:items-end"
                    >
                        <div>
                            <p
                                class="text-xs font-bold tracking-[0.25em] text-lime-300 uppercase"
                            >
                                What You Get
                            </p>

                            <h2
                                class="mt-4 max-w-2xl text-3xl leading-tight font-black sm:text-4xl"
                            >
                                Satu platform untuk
                                <span class="text-gray-500">
                                    latihan yang lebih terarah.
                                </span>
                            </h2>
                        </div>

                        <p
                            class="max-w-md text-sm leading-7 text-gray-400"
                        >
                            Bukan sekadar mencatat latihan. Pahami bagaimana
                            programmu disusun dan evaluasi distribusi
                            latihan secara lebih terstruktur.
                        </p>
                    </div>

                    <div class="mt-12 grid gap-5 md:grid-cols-3">
                        <article
                            v-for="feature in features"
                            :key="feature.number"
                            class="group rounded-3xl border border-white/10 bg-[#151915] p-7 transition duration-300 hover:-translate-y-1 hover:border-lime-300/30"
                        >
                            <div
                                class="flex items-center justify-between"
                            >
                                <span
                                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-lime-300/10 text-2xl text-lime-300"
                                >
                                    {{ feature.icon }}
                                </span>

                                <span
                                    class="text-sm font-bold text-gray-600"
                                >
                                    {{ feature.number }}
                                </span>
                            </div>

                            <h3 class="mt-8 text-xl font-bold">
                                {{ feature.title }}
                            </h3>

                            <p
                                class="mt-3 text-sm leading-7 text-gray-400"
                            >
                                {{ feature.description }}
                            </p>

                            <div
                                class="mt-7 h-px w-full bg-white/10 transition group-hover:bg-lime-300/30"
                            ></div>

                            <p
                                class="mt-4 text-xs font-semibold tracking-wide text-lime-300"
                            >
                                GYM PROGRAM ANALYZER
                            </p>
                        </article>
                    </div>
                </div>
            </section>

            <!-- Premium -->
            <section
                id="premium"
                class="px-6 py-20 lg:px-10 lg:py-24"
            >
                <div
                    class="mx-auto grid max-w-7xl gap-10 rounded-[2rem] border border-lime-300/20 bg-gradient-to-br from-[#192019] to-[#101210] p-8 sm:p-12 lg:grid-cols-2 lg:items-center lg:p-16"
                >
                    <div>
                        <p
                            class="text-xs font-bold tracking-[0.25em] text-lime-300 uppercase"
                        >
                            Free & Premium
                        </p>

                        <h2
                            class="mt-5 text-3xl leading-tight font-black sm:text-5xl"
                        >
                            More insights.
                            <span class="block text-lime-300">
                                Better training.
                            </span>
                        </h2>

                        <p
                            class="mt-5 max-w-lg text-sm leading-7 text-gray-400"
                        >
                            Mulai dengan fitur dasar secara gratis. Upgrade
                            ke Premium untuk mendapatkan akses ke fitur
                            tambahan sesuai paket yang tersedia.
                        </p>
                    </div>

                    <div
                        class="rounded-3xl border border-white/10 bg-black/20 p-6 sm:p-8"
                    >
                        <div
                            class="flex items-center justify-between border-b border-white/10 pb-5"
                        >
                            <div>
                                <p class="text-lg font-bold">Premium</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Untuk analisis lebih mendalam
                                </p>
                            </div>

                            <span
                                class="rounded-full bg-lime-300 px-3 py-1 text-xs font-bold text-black"
                            >
                                UPGRADE
                            </span>
                        </div>

                        <ul class="mt-6 space-y-4 text-sm text-gray-300">
                            <li class="flex gap-3">
                                <span class="text-lime-300">✓</span>
                                Analisis program latihan
                            </li>
                            <li class="flex gap-3">
                                <span class="text-lime-300">✓</span>
                                Evaluasi distribusi kelompok otot
                            </li>
                            <li class="flex gap-3">
                                <span class="text-lime-300">✓</span>
                                Kuota analisis foto AI tambahan
                            </li>
                            <li class="flex gap-3">
                                <span class="text-lime-300">✓</span>
                                Riwayat dan fitur tambahan sesuai paket
                            </li>
                        </ul>

                        <Link
                            v-if="!$page.props.auth.user"
                            :href="register()"
                            class="mt-8 block rounded-full bg-lime-300 px-6 py-3.5 text-center text-sm font-bold text-black transition hover:bg-lime-200"
                        >
                            Buat Akun Gratis
                        </Link>

                        <Link
                            v-else
                            :href="dashboard()"
                            class="mt-8 block rounded-full bg-lime-300 px-6 py-3.5 text-center text-sm font-bold text-black transition hover:bg-lime-200"
                        >
                            Masuk ke Dashboard
                        </Link>

                        <p
                            class="mt-4 text-center text-xs leading-5 text-gray-500"
                        >
                            Harga dan mekanisme pembayaran akan ditambahkan
                            pada tahap implementasi Premium.
                        </p>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section
                class="px-6 pb-24 text-center lg:px-10"
            >
                <div class="mx-auto max-w-3xl">
                    <p
                        class="text-xs font-bold tracking-[0.25em] text-lime-300 uppercase"
                    >
                        Start Your Journey
                    </p>

                    <h2
                        class="mt-5 text-3xl leading-tight font-black sm:text-5xl"
                    >
                        Make every set count.
                    </h2>

                    <p
                        class="mx-auto mt-5 max-w-xl text-sm leading-7 text-gray-400"
                    >
                        Bangun program latihan yang lebih terstruktur dan
                        pahami distribusi latihanmu.
                    </p>

                    <Link
                        v-if="!$page.props.auth.user"
                        :href="register()"
                        class="mt-8 inline-block rounded-full bg-lime-300 px-8 py-4 text-sm font-bold text-black transition hover:-translate-y-0.5 hover:bg-lime-200"
                    >
                        Mulai Sekarang →
                    </Link>

                    <Link
                        v-else
                        :href="dashboard()"
                        class="mt-8 inline-block rounded-full bg-lime-300 px-8 py-4 text-sm font-bold text-black transition hover:-translate-y-0.5 hover:bg-lime-200"
                    >
                        Buka Dashboard →
                    </Link>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="border-t border-white/10 px-6 py-8 lg:px-10">
            <div
                class="mx-auto flex max-w-7xl flex-col justify-between gap-4 text-xs text-gray-500 sm:flex-row sm:items-center"
            >
                <p>
                    © 2026 Gym Program Analyzer. All rights reserved.
                </p>

                <p>
                    Train smarter. Track your progress.
                </p>
            </div>
        </footer>
    </div>
</template>