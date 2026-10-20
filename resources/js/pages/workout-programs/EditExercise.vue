
<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

interface WorkoutProgram {
    id: number;
    name: string;
}

interface Exercise {
    id: number;
    name: string;
    muscle_group: string;
    sets: number;
    reps: number;
    weight: number | string;
}

const props = defineProps<{
    program: WorkoutProgram;
    exercise: Exercise;
}>();

const form = useForm({
    name: props.exercise.name,
    muscle_group: props.exercise.muscle_group,
    sets: props.exercise.sets,
    reps: props.exercise.reps,
    weight: Number(props.exercise.weight),
});

const muscleGroups = [
    { label: 'Chest (Dada)', value: 'Chest' },
    { label: 'Back (Punggung)', value: 'Back' },
    { label: 'Shoulders (Bahu)', value: 'Shoulders' },
    { label: 'Biceps', value: 'Biceps' },
    { label: 'Triceps', value: 'Triceps' },
    { label: 'Quadriceps (Paha Depan)', value: 'Quadriceps' },
    { label: 'Hamstrings (Paha Belakang)', value: 'Hamstrings' },
    { label: 'Glutes (Bokong)', value: 'Glutes' },
    { label: 'Calves (Betis)', value: 'Calves' },
    { label: 'Abs (Perut)', value: 'Abs' },
    { label: 'Forearms (Lengan Bawah)', value: 'Forearms' },
];

function submit() {
    form.put(
        `/workout-programs/${props.program.id}/exercises/${props.exercise.id}`,
    );
}
</script>

<template>
    <Head title="Edit Latihan" />

    <div class="min-h-full space-y-6 p-4 sm:p-6 lg:p-8">
        <header>
            <Link
                :href="`/workout-programs/${program.id}/exercises`"
                class="text-sm text-lime-400 hover:text-lime-300"
            >
                ← Kembali ke Program
            </Link>

            <p
                class="mt-5 text-xs font-bold tracking-[0.2em] text-lime-400 uppercase"
            >
                Training Workspace
            </p>

            <h1 class="mt-3 text-3xl font-black text-white">
                Edit Latihan
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                Program: {{ program.name }}
            </p>
        </header>

        <form
            @submit.prevent="submit"
            class="max-w-2xl space-y-6 rounded-2xl border border-white/10 bg-[#111611] p-6 sm:p-8"
        >
            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-white">
                    Nama Latihan
                </label>
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    maxlength="100"
                    required
                    class="w-full rounded-xl border border-white/10 bg-[#0b0d0c] px-4 py-3 text-white outline-none focus:border-lime-300"
                />
                <p v-if="form.errors.name" class="mt-2 text-sm text-red-400">
                    {{ form.errors.name }}
                </p>
            </div>

            <div>
                <label
                    for="muscle_group"
                    class="mb-2 block text-sm font-semibold text-white"
                >
                    Kelompok Otot
                </label>
                <select
                    id="muscle_group"
                    v-model="form.muscle_group"
                    required
                    class="w-full rounded-xl border border-white/10 bg-[#0b0d0c] px-4 py-3 text-white outline-none focus:border-lime-300"
                >
                    <option
                        v-for="group in muscleGroups"
                        :key="group.value"
                        :value="group.value"
                    >
                        {{ group.label }}
                    </option>
                </select>
                <p
                    v-if="form.errors.muscle_group"
                    class="mt-2 text-sm text-red-400"
                >
                    {{ form.errors.muscle_group }}
                </p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="sets" class="mb-2 block text-sm font-semibold text-white">
                        Jumlah Set
                    </label>
                    <input
                        id="sets"
                        v-model.number="form.sets"
                        type="number"
                        min="1"
                        max="100"
                        required
                        class="w-full rounded-xl border border-white/10 bg-[#0b0d0c] px-4 py-3 text-white outline-none focus:border-lime-300"
                    />
                    <p v-if="form.errors.sets" class="mt-2 text-sm text-red-400">
                        {{ form.errors.sets }}
                    </p>
                </div>

                <div>
                    <label for="reps" class="mb-2 block text-sm font-semibold text-white">
                        Repetisi per Set
                    </label>
                    <input
                        id="reps"
                        v-model.number="form.reps"
                        type="number"
                        min="1"
                        max="1000"
                        required
                        class="w-full rounded-xl border border-white/10 bg-[#0b0d0c] px-4 py-3 text-white outline-none focus:border-lime-300"
                    />
                    <p v-if="form.errors.reps" class="mt-2 text-sm text-red-400">
                        {{ form.errors.reps }}
                    </p>
                </div>
            </div>

            <div>
                <label for="weight" class="mb-2 block text-sm font-semibold text-white">
                    Beban (kg)
                </label>
                <input
                    id="weight"
                    v-model.number="form.weight"
                    type="number"
                    min="0"
                    max="99999.99"
                    step="0.01"
                    required
                    class="w-full rounded-xl border border-white/10 bg-[#0b0d0c] px-4 py-3 text-white outline-none focus:border-lime-300"
                />
                <p v-if="form.errors.weight" class="mt-2 text-sm text-red-400">
                    {{ form.errors.weight }}
                </p>
            </div>

            <div class="flex flex-wrap gap-3 border-t border-white/10 pt-5">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded-full bg-lime-300 px-6 py-3 text-sm font-bold text-black transition hover:bg-lime-200 disabled:opacity-50"
                >
                    {{ form.processing ? 'Menyimpan...' : 'Simpan Perubahan' }}
                </button>

                <Link
                    :href="`/workout-programs/${program.id}/exercises`"
                    class="rounded-full border border-white/15 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/30"
                >
                    Batal
                </Link>
            </div>
        </form>
    </div>
</template>
