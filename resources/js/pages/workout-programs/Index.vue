<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

interface WorkoutProgram {
    id: number;
    name: string;
    description: string | null;
    exercises_count: number;
    created_at: string;
}

defineProps<{
    programs: WorkoutProgram[];
}>();
</script>

<template>
    <Head title="My Workout Programs" />

    <div class="min-h-full space-y-6 p-4 sm:p-6 lg:p-8">
        <header
            class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center"
        >
            <div>
                <p
                    class="text-xs font-bold tracking-[0.2em] text-lime-400 uppercase"
                >
                    Training Workspace
                </p>

                <h1 class="mt-3 text-3xl font-black text-white">
                    My Programs
                </h1>

                <p class="mt-2 text-sm text-gray-400">
                    Kelola semua program latihanmu.
                </p>
            </div>

            <Link
                href="/workout-programs/create"
                class="inline-flex items-center justify-center gap-2 self-start rounded-full bg-lime-300 px-5 py-3 text-sm font-bold text-black transition hover:bg-lime-200"
            >
                <span class="text-lg">+</span>
                Create Program
            </Link>
        </header>

        <div
            class="rounded-2xl border border-white/10 bg-[#111611] p-5"
        >
            <p class="text-sm text-gray-400">
                Total Workout Programs
            </p>

            <p class="mt-2 text-4xl font-black text-lime-300">
                {{ programs.length }}
            </p>
        </div>

        <section v-if="programs.length > 0" class="grid gap-4 md:grid-cols-2">
            <Link
                v-for="program in programs"
                :key="program.id"
                :href="`/workout-programs/${program.id}/exercises`"
                class="block rounded-2xl border border-white/10 bg-[#111611] p-6 transition hover:border-lime-300/30"

            >
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h2 class="text-xl font-bold text-white">
                            {{ program.name }}
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-gray-400">
                            {{
                                program.description ||
                                'Tidak ada deskripsi.'
                            }}
                        </p>
                    </div>

                    <span
                        class="rounded-lg bg-lime-300/10 px-3 py-1 text-xs font-bold text-lime-300"
                    >
                        #{{ program.id }}
                    </span>
                </div>

                <div
                    class="mt-6 flex items-center justify-between border-t border-white/10 pt-4 text-xs text-gray-500"
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
            class="rounded-2xl border border-dashed border-white/15 bg-[#111611] px-6 py-14 text-center"
        >
            <div
                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-lime-300/10 text-3xl text-lime-300"
            >
                +
            </div>

            <h2 class="mt-5 text-lg font-bold text-white">
                Belum ada program latihan
            </h2>

            <p
                class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-400"
            >
                Buat program pertamamu untuk mulai mencatat latihan gym.
            </p>

            <Link
                href="/workout-programs/create"
                class="mt-6 inline-flex rounded-full bg-lime-300 px-6 py-3 text-sm font-bold text-black transition hover:bg-lime-200"
            >
                Buat Program Pertama
            </Link>
        </section>
    </div>
</template>