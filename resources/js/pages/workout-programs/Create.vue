<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: '',
});

function submit() {
    form.post('/workout-programs');
}
</script>

<template>
    <Head title="Create Workout Program" />

    <div class="min-h-full space-y-6 p-4 sm:p-6 lg:p-8">
        <div>
            <Link
                href="/workout-programs"
                class="text-sm text-lime-400 hover:text-lime-300"
            >
                ← Back to My Programs
            </Link>

            <h1 class="mt-4 text-3xl font-black text-white">
                Create Workout Program
            </h1>

            <p class="mt-2 text-sm text-gray-400">
                Buat program latihan untuk mengatur sesi gym-mu.
            </p>
        </div>

        <form
            @submit.prevent="submit"
            class="max-w-2xl space-y-6 rounded-2xl border border-white/10 bg-[#111611] p-6 sm:p-8"
        >
            <div>
                <label
                    for="name"
                    class="mb-2 block text-sm font-semibold text-white"
                >
                    Nama Program
                </label>

                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    maxlength="100"
                    required
                    placeholder="Contoh: Push Pull Legs"
                    class="w-full rounded-xl border border-white/10 bg-[#0b0d0c] px-4 py-3 text-white outline-none transition placeholder:text-gray-600 focus:border-lime-300"
                />

                <p
                    v-if="form.errors.name"
                    class="mt-2 text-sm text-red-400"
                >
                    {{ form.errors.name }}
                </p>
            </div>

            <div>
                <label
                    for="description"
                    class="mb-2 block text-sm font-semibold text-white"
                >
                    Deskripsi
                    <span class="font-normal text-gray-500">
                        (opsional)
                    </span>
                </label>

                <textarea
                    id="description"
                    v-model="form.description"
                    rows="4"
                    maxlength="1000"
                    placeholder="Contoh: Program latihan 4 hari dalam seminggu."
                    class="w-full resize-y rounded-xl border border-white/10 bg-[#0b0d0c] px-4 py-3 text-white outline-none transition placeholder:text-gray-600 focus:border-lime-300"
                ></textarea>

                <p
                    v-if="form.errors.description"
                    class="mt-2 text-sm text-red-400"
                >
                    {{ form.errors.description }}
                </p>
            </div>

            <div class="flex flex-wrap gap-3 border-t border-white/10 pt-5">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="rounded-full bg-lime-300 px-6 py-3 text-sm font-bold text-black transition hover:bg-lime-200 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    {{
                        form.processing
                            ? 'Menyimpan...'
                            : 'Simpan Program'
                    }}
                </button>

                <Link
                    href="/workout-programs"
                    class="rounded-full border border-white/15 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/30"
                >
                    Batal
                </Link>
            </div>
        </form>
    </div>
</template>