<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { PlusIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    tickets: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- If ticket is empty -->
                    <div v-if="!tickets.length">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="text-center">
                                <svg
                                    class="mx-auto h-12 w-12 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        vector-effect="non-scaling-stroke"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"
                                    />
                                </svg>
                                <h3
                                    class="mt-2 text-sm font-medium text-gray-900"
                                >
                                    Having trouble?
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Get started by creating new ticket.
                                </p>
                                <div class="mt-6">
                                    <Link
                                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        :href="route('ticket.create')"
                                    >
                                        <PlusIcon
                                            class="-ml-1 mr-2 h-5 w-5"
                                            aria-hidden="true"
                                        />
                                        New Ticket
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <h1>naay sulod animal</h1>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
