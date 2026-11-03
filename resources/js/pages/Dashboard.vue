<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

interface WorkoutProgram {
    id: number;
    name: string;
    description: string | null;
    exercises_count: number;
    created_at: string;
}

const props = defineProps<{
    programs: WorkoutProgram[];
    stats: {
        totalPrograms: number;
        totalExercises: number;
        weeklySets: number;
    };
}>();

const stats = [
    {
        label: 'Total Programs',
        value: props.stats.totalPrograms,
        description: 'Program latihan tersimpan',
        icon: '▤',
        href: '/workout-programs',
    },
    {
        label: 'Total Exercises',
        value: props.stats.totalExercises,
        description: 'Exercise tercatat',
        icon: '↗',
        href: '/workout-programs',
    },
    {
        label: 'Weekly Sets',
        value: props.stats.weeklySets,
        description: 'Set latihan minggu ini',
        icon: '◫',
        href: '/workout-programs',
    },
];

const quickActions = [
    {
        number: '01',
        title: 'Create Workout Program',
        description:
            'Buat program latihan baru dan tentukan jadwal latihanmu.',
        icon: '+',
        status: 'Available now',
    },
    {
        number: '02',
        title: 'Analyze Muscle Balance',
        description:
            'Evaluasi distribusi jumlah set pada setiap kelompok otot.',
        icon: '◫',
        status: 'Coming next',
    },
    {
        number: '03',
        title: 'AI Exercise Analysis',
        description:
            'Unggah foto latihan untuk mendapatkan analisis teknik dasar.',
        icon: '✳',
        status: 'Coming next',
    },
];
</script>

<template>
    <Head title="Dashboard | Gym Program Analyzer" />

    <div class="min-h-full space-y-8 p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <section
            class="relative overflow-hidden rounded-3xl border border-white/10 bg-[#111611] p-6 sm:p-8"
        >
            <div
                class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full bg-lime-300/10 blur-3xl"
            ></div>

            <div class="relative z-10">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-lime-300/20 bg-lime-300/5 px-3 py-1.5 text-xs font-semibold text-lime-300"
                >
                    <span class="h-2 w-2 rounded-full bg-lime-300"></span>
                    YOUR TRAINING WORKSPACE
                </div>

                <h1
                    class="mt-5 text-3xl font-black tracking-tight text-white sm:text-4xl"
                >
                    Welcome to your
                    <span class="text-lime-300">training space.</span>
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-7 text-gray-400">
                    Kelola program gym, pantau distribusi latihan, dan
                    evaluasi keseimbangan kelompok otot dari satu dashboard.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a
                        href="#quick-actions"
                        class="inline-flex items-center gap-2 rounded-full bg-lime-300 px-5 py-3 text-sm font-bold text-black transition hover:bg-lime-200"
                    >
                        Explore Features
                        <span>→</span>
                    </a>

                    <Link
                        href="/workout-programs"
                        class="inline-flex items-center rounded-full border border-white/15 px-5 py-3 text-sm font-semibold text-white transition hover:border-lime-300/40"
                    >
                         My Programs
                    </Link>
                </div>
            </div>
        </section>

        <!-- Statistics -->
        <section>
            <div class="mb-4">
                <h2 class="text-lg font-bold text-white">
                    Training Overview
                </h2>
                <p class="mt-1 text-sm text-gray-400">
                    Ringkasan aktivitas latihanmu.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <Link
                    v-for="stat in stats"
                    :key="stat.label"
                    :href="stat.href"
                    class="block rounded-2xl border border-white/10 bg-[#111611] p-5 transition hover:border-lime-300/40 hover:bg-[#182018]"
                >
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-gray-400">
                                {{ stat.label }}
                            </p>

                            <p
                                class="mt-4 text-4xl font-black tracking-tight text-white"
                            >
                                {{ stat.value }}
                            </p>
                        </div>

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-lime-300/10 text-xl text-lime-300"
                        >
                            {{ stat.icon }}
                        </div>
                    </div>

                    <p class="mt-4 text-xs text-gray-500">
                        {{ stat.description }}
                    </p>
                </Link>
            </div>
        </section>

        <!-- Quick Actions -->
        <section id="quick-actions">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-white">
                    Explore Features
                </h2>
                <p class="mt-1 text-sm text-gray-400">
                    Fitur utama Gym Program Analyzer.
                </p>
            </div>

            
            <div class="grid gap-4 lg:grid-cols-3">
                <Link
                    href="/workout-programs/create"
                    class="group rounded-2xl border border-white/10 bg-[#111611] p-5 transition hover:border-lime-300/30"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-lime-300/10 text-2xl font-bold text-lime-300">
                            +
                        </div>
                        <span class="text-xs font-semibold text-gray-600">01</span>
                    </div>

                    <h3 class="mt-5 text-base font-bold text-white">
                        Create Workout Program
                    </h3>

                    <p class="mt-2 min-h-12 text-sm leading-6 text-gray-400">
                        Buat program latihan baru dan tentukan jadwal latihanmu.
                    </p>

                    <div class="mt-5 border-t border-white/10 pt-4 text-xs font-semibold text-lime-300">
                        Available now →
                    </div>
                </Link>

                
                <Link
                    href="/muscle-balance"
                    class="group rounded-2xl border border-white/10 bg-[#111611] p-5 transition hover:border-lime-300/30"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-lime-300/10 text-2xl font-bold text-lime-300">
                            ◫
                        </div>

                        <span class="text-xs font-semibold text-gray-600">02</span>
                    </div>

                    <h3 class="mt-5 text-base font-bold text-white">
                        Analyze Muscle Balance
                    </h3>

                    <p class="mt-2 min-h-12 text-sm leading-6 text-gray-400">
                        Evaluasi distribusi jumlah set pada setiap kelompok otot.
                    </p>

                    <div class="mt-5 border-t border-white/10 pt-4 text-xs font-semibold text-lime-300">
                        Available now →
                    </div>
                </Link>


                <article class="rounded-2xl border border-white/10 bg-[#111611] p-5 opacity-70">
                    <div class="flex items-center justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-lime-300/10 text-2xl font-bold text-lime-300">
                            ✳
                        </div>
                        <span class="text-xs font-semibold text-gray-600">03</span>
                    </div>

                    <h3 class="mt-5 text-base font-bold text-white">
                        AI Exercise Analysis
                    </h3>

                    <p class="mt-2 min-h-12 text-sm leading-6 text-gray-400">
                        Unggah foto latihan untuk mendapatkan analisis teknik dasar.
                    </p>

                    <div class="mt-5 border-t border-white/10 pt-4 text-xs font-semibold text-lime-300">
                        Coming next
                    </div>
                </article>
            </div>

        </section>

        <!-- Programs -->
       <!-- Programs -->
        <section id="your-programs">
            <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h2 class="text-lg font-bold text-white">
                        My Programs
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Program latihan yang kamu buat.
                    </p>
                </div>

                <span
                    class="rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs text-gray-400"
                >
                    {{ programs.length }} programs
                </span>
            </div>

            <section
                v-if="programs.length > 0"
                class="grid gap-4 lg:grid-cols-2"
            >
                <Link
                    v-for="program in programs"
                    :key="program.id"
                    :href="`/workout-programs/${program.id}/exercises`"
                    class="block rounded-2xl border border-white/10 bg-[#111611] p-6 transition hover:border-lime-300/40 hover:bg-[#182018]"
                >
                    <h3 class="text-lg font-bold text-white">
                        {{ program.name }}
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-400">
                        {{ program.description || 'Tidak ada deskripsi.' }}
                    </p>

                    <div
                        class="mt-5 flex items-center justify-between border-t border-white/10 pt-4 text-xs text-gray-500"
                    >
                        <span>
                            {{ program.exercises_count }} exercises
                        </span>

                        <span>
                            {{
                                new Date(program.created_at).toLocaleDateString(
                                    'id-ID',
                                    {
                                        day: 'numeric',
                                        month: 'short',
                                        year: 'numeric',
                                    },
                                )
                            }}
                        </span>
                    </div>
                </Link>
            </section>

            <section
                v-else
                class="rounded-2xl border border-dashed border-white/15 bg-[#111611] px-6 py-12 text-center"
            >
                <h3 class="text-lg font-bold text-white">
                    Belum ada program latihan
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-400">
                    Buat program pertamamu untuk mulai mencatat latihan gym.
                </p>

                <Link
                    href="/workout-programs/create"
                    class="mt-5 inline-flex rounded-full bg-lime-300 px-5 py-3 text-sm font-bold text-black transition hover:bg-lime-200"
                >
                    + Create Program
                </Link>
            </section>

            <div v-if="programs.length > 0" class="mt-5">
                <Link
                    href="/workout-programs"
                    class="text-sm font-semibold text-lime-300 hover:text-lime-200"
                >
                    Lihat semua program →
                </Link>
            </div>
        </section>

        <!-- Premium -->
        <section
            class="rounded-3xl border border-lime-300/20 bg-gradient-to-r from-[#182018] to-[#111611] p-6 sm:p-8"
        >
            <div
                class="flex flex-col justify-between gap-6 md:flex-row md:items-center"
            >
                <div class="max-w-xl">
                    <span
                        class="rounded-full bg-lime-300 px-3 py-1 text-xs font-black text-black"
                    >
                        PREMIUM
                    </span>

                    <h2 class="mt-4 text-2xl font-black text-white">
                        Get more from your training.
                    </h2>

                    <p class="mt-3 text-sm leading-7 text-gray-400">
                        Paket Premium direncanakan untuk memberikan kuota
                        analisis AI lebih besar, riwayat lebih lengkap, dan
                        evaluasi program yang lebih mendalam.
                    </p>
                </div>

                <div class="shrink-0">
                    <span
                        class="inline-flex rounded-full border border-white/15 px-5 py-3 text-sm font-semibold text-gray-400"
                    >
                        Premium — Coming Next
                    </span>
                </div>
            </div>
        </section>

        <footer
            class="border-t border-white/10 pt-5 text-center text-xs text-gray-500"
        >
            Gym Program Analyzer · Train smarter, track your progress.
        </footer>
    </div>
</template>