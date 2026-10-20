<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

interface Exercise {
    id: number;
    name: string;
    muscle_group: string;
    sets: number;
    reps: number;
    weight: string | number;
}

interface WorkoutProgram {
    id: number;
    name: string;
    description: string | null;
    exercises: Exercise[];
}

defineProps<{
    program: WorkoutProgram;
}>();

function deleteExercise(programId: number, exerciseId: number) {
    if (!confirm('Yakin ingin menghapus latihan ini?')) {
        return;
    }

    router.delete(
        `/workout-programs/${programId}/exercises/${exerciseId}`,
    );
}
</script>

<template>
    <Head :title="program.name" />

    <div class="min-h-full space-y-6 p-4 sm:p-6 lg:p-8">
        <header
            class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center"
        >
            <div>
                <Link
                    href="/workout-programs"
                    class="text-sm text-lime-400 hover:text-lime-300"
                >
                    ← Kembali ke My Programs
                </Link>

                <p
                    class="mt-5 text-xs font-bold tracking-[0.2em] text-lime-400 uppercase"
                >
                    Training Workspace
                </p>

                <h1 class="mt-3 text-3xl font-black text-white">
                    {{ program.name }}
                </h1>

                <p class="mt-2 text-sm text-gray-400">
                    {{ program.description || 'Tidak ada deskripsi program.' }}
                </p>
            </div>

            <Link
                :href="`/workout-programs/${program.id}/exercises/create`"
                class="inline-flex items-center justify-center gap-2 self-start rounded-full bg-lime-300 px-5 py-3 text-sm font-bold text-black transition hover:bg-lime-200"
            >
                <span class="text-lg">+</span>
                Tambah Latihan
            </Link>
        </header>

        <section class="grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-white/10 bg-[#111611] p-5">
                <p class="text-sm text-gray-400">Total Latihan</p>
                <p class="mt-2 text-3xl font-black text-lime-300">
                    {{ program.exercises.length }}
                </p>
            </div>

            <div class="rounded-2xl border border-white/10 bg-[#111611] p-5">
                <p class="text-sm text-gray-400">Total Set</p>
                <p class="mt-2 text-3xl font-black text-lime-300">
                    {{
                        program.exercises.reduce(
                            (total, exercise) => total + Number(exercise.sets),
                            0,
                        )
                    }}
                </p>
            </div>

            <div class="rounded-2xl border border-white/10 bg-[#111611] p-5">
                <p class="text-sm text-gray-400">Kelompok Otot</p>
                <p class="mt-2 text-3xl font-black text-lime-300">
                    {{
                        new Set(
                            program.exercises.map(
                                (exercise) => exercise.muscle_group,
                            ),
                        ).size
                    }}
                </p>
            </div>
        </section>

        <section
            v-if="program.exercises.length > 0"
            class="space-y-4"
        >
            <h2 class="text-lg font-bold text-white">
                Daftar Latihan
            </h2>

            <article
                v-for="(exercise, index) in program.exercises"
                :key="exercise.id"
                class="rounded-2xl border border-white/10 bg-[#111611] p-5 sm:p-6"
            >
                <div
                    class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center"
                >
                    <div>
                        <p class="text-xs font-semibold text-lime-400">
                            LATIHAN {{ index + 1 }}
                        </p>

                        <h3 class="mt-2 text-xl font-bold text-white">
                            {{ exercise.name }}
                        </h3>

                        <span
                            class="mt-3 inline-flex rounded-full bg-lime-300/10 px-3 py-1 text-xs font-semibold text-lime-300"
                        >
                            {{ exercise.muscle_group }}
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-3 sm:min-w-[360px]">
                        <div class="rounded-xl bg-[#0b0d0c] p-3 text-center">
                            <p class="text-xs text-gray-500">Set</p>
                            <p class="mt-1 font-bold text-white">
                                {{ exercise.sets }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-[#0b0d0c] p-3 text-center">
                            <p class="text-xs text-gray-500">Repetisi</p>
                            <p class="mt-1 font-bold text-white">
                                {{ exercise.reps }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-[#0b0d0c] p-3 text-center">
                            <p class="text-xs text-gray-500">Beban</p>
                            <p class="mt-1 font-bold text-white">
                                {{ exercise.weight }} kg
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <Link
                            :href="`/workout-programs/${program.id}/exercises/${exercise.id}/edit`"
                            class="rounded-full bg-lime-300 px-4 py-2 text-sm font-bold text-black transition hover:bg-lime-200"
                        >
                            Edit
                        </Link>

                        <button
                            @click="deleteExercise(program.id, exercise.id)"
                            class="rounded-full bg-red-500 px-4 py-2 text-sm font-bold text-white transition hover:bg-red-400"
                        >
                            Hapus
                        </button>
                    </div>
                </div>
            </article>
        </section>

        <section
            v-else
            class="rounded-2xl border border-dashed border-white/15 bg-[#111611] px-6 py-14 text-center"
        >
            <div
                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-lime-300/10 text-3xl text-lime-300"
            >
                +
            </div>

            <h2 class="mt-5 text-lg font-bold text-white">
                Belum Ada Latihan
            </h2>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-400">
                Tambahkan latihan seperti Bench Press, Squat, atau Lat Pulldown
                ke dalam program ini.
            </p>

            <Link
                :href="`/workout-programs/${program.id}/exercises/create`"
                class="mt-6 inline-flex rounded-full bg-lime-300 px-6 py-3 text-sm font-bold text-black transition hover:bg-lime-200"
            >
                Tambah Latihan Pertama
            </Link>
        </section>
    </div>
</template>