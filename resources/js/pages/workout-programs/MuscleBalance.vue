
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

interface WorkoutProgram {
    id: number;
    name: string;
}

interface AnalysisItem {
    muscle_group: string;
    total_sets: number;
    total_exercises: number;
}

const props = defineProps<{
    programs: WorkoutProgram[];
    selectedProgram?: WorkoutProgram;
    analysis?: AnalysisItem[];
}>();

const totalSets = computed(() =>
    props.analysis?.reduce((total, item) => total + item.total_sets, 0) ?? 0
);

const totalExercises = computed(() =>
    props.analysis?.reduce((total, item) => total + item.total_exercises, 0) ?? 0
);

const totalMuscles = computed(() => props.analysis?.length ?? 0);

function getPercentage(sets: number): number {
    if (totalSets.value === 0) return 0;

    return Math.round((sets / totalSets.value) * 100);
}

const averageSets = computed(() => {
    if (totalMuscles.value === 0) return 0;

    return totalSets.value / totalMuscles.value;
});

function getEvaluation(sets: number) {
    if (averageSets.value === 0) {
        return {
            label: 'No Data',
            description: 'Belum ada data latihan.',
            color: 'text-gray-400',
            background: 'bg-white/5',
        };
    }

    const difference = sets / averageSets.value;

    if (difference > 1.1) {
        return {
            label: 'Above Average',
            description: 'Volume relatif di atas rata-rata kelompok otot lainnya.',
            color: 'text-lime-300',
            background: 'bg-lime-300/10',
        };
    }

    if (difference < 0.9) {
        return {
            label: 'Below Average',
            description: 'Volume relatif di bawah rata-rata kelompok otot lainnya.',
            color: 'text-orange-300',
            background: 'bg-orange-300/10',
        };
    }

    return {
        label: 'Near Average',
        description: 'Volume relatif mendekati rata-rata.',
        color: 'text-blue-300',
        background: 'bg-blue-300/10',
    };
}


const overallAnalysis = computed(() => {
    if (!props.analysis || props.analysis.length === 0) {
        return {
            label: 'Insufficient Data',
            title: 'Belum ada data latihan',
            description: 'Tambahkan exercise terlebih dahulu untuk mendapatkan hasil analisis.',
        };
    }

    const highest = [...props.analysis].sort(
        (a, b) => b.total_sets - a.total_sets
    )[0];

    const lowest = [...props.analysis].sort(
        (a, b) => a.total_sets - b.total_sets
    )[0];

    const hasAbove = props.analysis.some(
        item => getEvaluation(item.total_sets).label === 'Above Average'
    );

    const hasBelow = props.analysis.some(
        item => getEvaluation(item.total_sets).label === 'Below Average'
    );

    return {
        label: hasAbove && hasBelow
            ? 'Relatively Uneven Distribution'
            : 'Relatively Even Distribution',

        title: 'Evaluasi Distribusi Volume Latihan',

        description:
            `${highest.muscle_group} memiliki volume tertinggi dengan ${highest.total_sets} set. ` +
            `${lowest.muscle_group} memiliki volume terendah dengan ${lowest.total_sets} set. ` +
            'Evaluasi ini membandingkan distribusi set antar kelompok otot dalam program yang dipilih.',
    };
});


</script>

<template>
    <Head title="Muscle Balance Analysis" />

    <div class="min-h-full space-y-6 p-4 sm:p-6 lg:p-8">
        <header>
            <p class="text-xs font-bold tracking-[0.2em] text-lime-400 uppercase">
                Training Analytics
            </p>

            <h1 class="mt-3 text-3xl font-black text-white">
                Muscle Balance Analysis
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                Analisis distribusi volume latihan berdasarkan kelompok otot.
            </p>
        </header>

        <!-- Pilih Program -->
        <section class="rounded-2xl border border-white/10 bg-[#111611] p-6">
            <h2 class="text-lg font-bold text-white">
                Pilih Program Latihan
            </h2>

            <p class="mt-2 text-sm text-gray-400">
                Pilih program yang ingin kamu analisis.
            </p>

            <div v-if="programs.length > 0" class="mt-5 space-y-3">
                <Link
                    v-for="program in programs"
                    :key="program.id"
                    :href="`/muscle-balance/${program.id}`"
                    class="flex items-center justify-between rounded-xl border border-white/10 bg-white/5 p-4 transition hover:border-lime-300/40"
                    :class="selectedProgram?.id === program.id ? 'border-lime-300/50 bg-lime-300/5' : ''"
                >
                    <div>
                        <h3 class="font-bold text-white">
                            {{ program.name }}
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            {{ selectedProgram?.id === program.id ? 'Program sedang dianalisis' : 'Klik untuk menganalisis' }}
                        </p>
                    </div>

                    <span class="text-lime-300">→</span>
                </Link>
            </div>

            <p v-else class="mt-5 text-sm text-gray-400">
                Belum ada program latihan. Buat program terlebih dahulu.
            </p>
        </section>

        <!-- Hasil Analisis -->
        <section
            v-if="selectedProgram && analysis"
            class="space-y-6"
        >
            <div>
                <p class="text-xs font-bold tracking-widest text-lime-400 uppercase">
                    Analysis Result
                </p>

                <h2 class="mt-2 text-2xl font-black text-white">
                    {{ selectedProgram.name }}
                </h2>
            </div>

            <!-- Summary Cards -->
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-white/10 bg-[#111611] p-5">
                    <p class="text-sm text-gray-400">Total Sets</p>
                    <p class="mt-3 text-3xl font-black text-lime-300">
                        {{ totalSets }}
                    </p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-[#111611] p-5">
                    <p class="text-sm text-gray-400">Total Exercises</p>
                    <p class="mt-3 text-3xl font-black text-white">
                        {{ totalExercises }}
                    </p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-[#111611] p-5">
                    <p class="text-sm text-gray-400">Muscle Groups</p>
                    <p class="mt-3 text-3xl font-black text-white">
                        {{ totalMuscles }}
                    </p>
                </div>
            </div>

            <!-- Muscle Distribution -->
            <div class="rounded-2xl border border-white/10 bg-[#111611] p-6">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold text-white">
                            Muscle Distribution
                        </h3>

                        <p class="mt-1 text-sm text-gray-400">
                            Distribusi total set berdasarkan kelompok otot.
                        </p>
                    </div>

                    <span class="rounded-lg bg-lime-300/10 px-3 py-2 text-xs font-bold text-lime-300">
                        {{ totalSets }} Total Sets
                    </span>
                </div>

                <div v-if="analysis.length > 0" class="mt-6 space-y-6">
                    <div
                        v-for="item in analysis"
                        :key="item.muscle_group"
                    >
                        <div class="mb-2 flex items-center justify-between gap-3">
                            <span class="font-semibold text-white">
                                {{ item.muscle_group }}
                            </span>

                            <div class="text-right">
                                <span class="font-bold text-lime-300">
                                    {{ item.total_sets }} sets
                                </span>

                                <span class="ml-2 text-xs text-gray-500">
                                    ({{ getPercentage(item.total_sets) }}%)
                                </span>
                            </div>
                        </div>

                        <div class="h-3 overflow-hidden rounded-full bg-white/10">
                            <div
                                class="h-full rounded-full bg-lime-300 transition-all duration-500"
                                :style="{ width: `${getPercentage(item.total_sets)}%` }"
                            ></div>
                        </div>

                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <span class="text-xs text-gray-500">
                                {{ item.total_exercises }} exercises
                            </span>

                            <span
                                :class="[
                                    'rounded-full px-3 py-1 text-xs font-semibold',
                                    getEvaluation(item.total_sets).color,
                                    getEvaluation(item.total_sets).background,
                                ]"
                            >
                                {{ getEvaluation(item.total_sets).label }}
                            </span>
                        </div>

                        <p class="mt-2 text-xs text-gray-500">
                            {{ getEvaluation(item.total_sets).description }}
                        </p>
                    </div>
                </div>

                <p v-else class="mt-5 text-sm text-gray-400">
                    Belum ada exercise dalam program ini.
                </p>
            </div>

            <!-- Overall Analysis -->
            <div class="rounded-2xl border border-lime-300/20 bg-[#111611] p-6">
                <p class="text-xs font-bold tracking-widest text-lime-400 uppercase">
                    Overall Analysis
                </p>

                <h3 class="mt-3 text-xl font-bold text-white">
                    {{ overallAnalysis.title }}
                </h3>

                <div class="mt-4 inline-flex rounded-full bg-lime-300/10 px-3 py-2 text-xs font-bold text-lime-300">
                    {{ overallAnalysis.label }}
                </div>

                <p class="mt-4 text-sm leading-7 text-gray-400">
                    {{ overallAnalysis.description }}
                </p>

                <p class="mt-4 border-t border-white/10 pt-4 text-xs leading-6 text-gray-500">
                    Catatan: Hasil ini merupakan evaluasi distribusi relatif berdasarkan
                    jumlah set, bukan penilaian medis atau standar volume latihan ideal.
                </p>
            </div>

        </section>

        <Link
            href="/dashboard"
            class="inline-flex text-sm font-semibold text-lime-300 hover:text-lime-200"
        >
            ← Kembali ke Dashboard
        </Link>
    </div>
</template>
