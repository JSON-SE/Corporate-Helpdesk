<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    res: Object,
});
</script>

<template>
    <Head title="Ticket" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Details
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <div class="flex flex-row justify-center">
                            <div class="basis-1/2">
                                <div
                                    class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Full name
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                    >
                                        {{ res.user }}
                                    </dd>
                                </div>
                                <div
                                    class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Office
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                    >
                                        {{ res.office }}
                                    </dd>
                                </div>
                                <div
                                    class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Reference Number
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                    >
                                        {{ res.reference_number }}
                                    </dd>
                                </div>
                                <div
                                    class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Subject
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                    >
                                        {{ res.title }}
                                    </dd>
                                </div>
                            </div>
                            <div class="basis-1/2">
                                <div
                                    class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Content
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                    >
                                        {{ res.content }}
                                    </dd>
                                </div>
                                <div
                                    class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Date Created
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                    >
                                        {{ res.created_at }}
                                    </dd>
                                </div>
                                <div
                                    class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Status
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                    >
                                        {{ res.status }}
                                    </dd>
                                </div>
                                <div
                                    class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Remarks
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                    >
                                        {{
                                            res.remarks
                                                ? res.remarks
                                                : "No remarks"
                                        }}
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-start">
                        <div class="basis-1/2">
                            <div
                                class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:px-6"
                            >
                                <Link
                                    class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    :href="route('ticket.index')"
                                    >Back</Link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
