<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    res: Object,
});

function back() {
    window.history.back();
}
</script>

<template>
    <Head title="Ticket" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Details
            </h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Ticket Details
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        User and ticket report details
                    </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Full name
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ res.user }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Office
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ res.office }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Reference number
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ res.reference_number }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Status
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <div v-if="res.status == 'Open'">
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                        >Open</span
                                    >
                                </div>
                                <div v-else-if="res.status == 'In-progress'">
                                    <span
                                        class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800"
                                        >In-progress</span
                                    >
                                </div>
                                <div v-else-if="res.status == 'Cancelled'">
                                    <span
                                        class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800"
                                        >Cancelled</span
                                    >
                                </div>
                                <div v-else>
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800"
                                        >Complete</span
                                    >
                                </div>
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Subject
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ res.title }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Date Created
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ res.created_at }}
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Details
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ res.content }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Remarks
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ res.remarks ? res.remarks : "No remarks" }}
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Return
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <Link
                                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    @click="back()"
                                >
                                    Back
                                </Link>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
