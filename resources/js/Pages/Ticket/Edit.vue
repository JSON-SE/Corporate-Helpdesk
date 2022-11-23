<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    categories: Object,
    res: Object,
});

const form = useForm({
    category_id: props.res.category_id,
    title: props.res.title,
    content: props.res.content,
    terms: false,
});

const submit = () => {
    form.put(route("ticket.update", props.res.id));
};

function back() {
    window.history.back();
}
</script>

<template>
    <Head title="Edit Ticket" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Tickets
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form
                            class="space-y-8 divide-y divide-gray-200"
                            @submit.prevent="submit"
                        >
                            <div class="space-y-8 divide-y divide-gray-200">
                                <div>
                                    <div>
                                        <h3
                                            class="text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Update Ticket
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Update any corrections below.
                                        </p>
                                    </div>

                                    <div class="mt-6">
                                        <label
                                            for="category"
                                            class="block text-sm font-medium text-gray-700"
                                            >Select category</label
                                        >
                                        <div class="mt-1">
                                            <select
                                                v-model="form.category_id"
                                                id="category_id"
                                                autocomplete="category_id"
                                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                            >
                                                <option
                                                    v-for="category in categories"
                                                    :key="category.id"
                                                    :value="category.id"
                                                >
                                                    {{ category.category }}
                                                </option>
                                            </select>
                                            <inputerror
                                                class="mt-2"
                                                :message="
                                                    form.errors.category_id
                                                "
                                            />
                                        </div>
                                    </div>

                                    <div class="mt-6 sm:col-span-3">
                                        <label
                                            for="first-name"
                                            class="block text-sm font-medium text-gray-700"
                                            >Subject</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                type="text"
                                                id="title"
                                                v-model="form.title"
                                                placeholder="What seems to be the problem?"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            />
                                        </div>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.title"
                                        />
                                    </div>

                                    <div
                                        class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                                    >
                                        <div class="sm:col-span-6">
                                            <label
                                                for="content"
                                                class="block text-sm font-medium text-gray-700"
                                                >Tell us more.
                                                <small>(Optional)</small></label
                                            >
                                            <div class="mt-1">
                                                <textarea
                                                    id="content"
                                                    v-model="form.content"
                                                    rows="3"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                />
                                            </div>
                                            <p
                                                class="mt-2 text-sm text-gray-500"
                                            >
                                                Please provide details about the
                                                issue.
                                            </p>
                                            <InputError
                                                class="mt-2"
                                                :message="form.errors.content"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-5">
                                <div class="flex justify-end">
                                    <Link
                                        @click="back()"
                                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >
                                        Back
                                    </Link>
                                    <button
                                        type="submit"
                                        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
