<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { PlusIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    tickets: Object,
    categories: Object,
    offices: Object,
    statuses: Object,
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
                        <div class="px-4 sm:px-6 lg:px-8 mt-6 pb-8">
                            <div class="sm:flex sm:items-center">
                                <div class="mr-5 mt-6">
                                    <Link
                                        :href="route('ticket.create')"
                                        type="button"
                                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                                    >
                                        New Ticket
                                    </Link>
                                </div>
                                <!-- Category -->
                                <div class="mr-5">
                                    <label
                                        for="category"
                                        class="block text-sm font-medium text-gray-700"
                                        >Category</label
                                    >
                                    <select
                                        id="location"
                                        name="location"
                                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    >
                                        <option selected="">
                                            Select Category
                                        </option>
                                        <option
                                            v-for="category in categories"
                                            :key="category.id"
                                        >
                                            {{ category.category }}
                                        </option>
                                    </select>
                                </div>
                                <!-- Status -->
                                <div class="mr-5">
                                    <label
                                        for="status"
                                        class="block text-sm font-medium text-gray-700"
                                        >Status</label
                                    >
                                    <select
                                        id="location"
                                        name="location"
                                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    >
                                        <option selected="">
                                            Select Status
                                        </option>
                                        <option
                                            v-for="status in statuses"
                                            :key="status.id"
                                        >
                                            {{ status.status }}
                                        </option>
                                    </select>
                                </div>
                                <!-- office -->
                                <div>
                                    <label
                                        for="office"
                                        class="block text-sm font-medium text-gray-700"
                                        >Office</label
                                    >
                                    <select
                                        id="location"
                                        name="location"
                                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    >
                                        <option selected="">
                                            Select Office
                                        </option>
                                        <option
                                            v-for="office in offices"
                                            :key="office.id"
                                        >
                                            {{ office.office }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-8 flex flex-col">
                                <div
                                    class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"
                                >
                                    <div
                                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                                    >
                                        <div
                                            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                                        >
                                            <table
                                                class="min-w-full divide-y divide-gray-300"
                                            >
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                        >
                                                            Category
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                        >
                                                            Ticket
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                        >
                                                            User
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                        >
                                                            Office
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                        >
                                                            Status
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                        >
                                                            <span
                                                                class="sr-only"
                                                                >Edit</span
                                                            >
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    class="divide-y divide-gray-200 bg-white"
                                                >
                                                    <tr
                                                        v-for="ticket in tickets"
                                                        :key="ticket.id"
                                                    >
                                                        <td
                                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                                        >
                                                            {{
                                                                ticket
                                                                    .categories
                                                                    .category
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                                        >
                                                            {{ ticket.title }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                        >
                                                            {{
                                                                ticket.users
                                                                    .firstName
                                                            }}
                                                            {{
                                                                ticket.users
                                                                    .middleName
                                                            }}
                                                            {{
                                                                ticket.users
                                                                    .lastName
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                        >
                                                            {{
                                                                ticket.users
                                                                    .offices
                                                                    .abbr
                                                            }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                        >
                                                            <!-- open -->
                                                            <div
                                                                v-if="
                                                                    ticket
                                                                        .statuses
                                                                        .id == 1
                                                                "
                                                            >
                                                                <span
                                                                    class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                                                    >Open</span
                                                                >
                                                            </div>
                                                            <!-- in-progress -->
                                                            <div
                                                                v-else-if="
                                                                    ticket
                                                                        .statuses
                                                                        .id == 2
                                                                "
                                                            >
                                                                <span
                                                                    class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800"
                                                                    >In-progress</span
                                                                >
                                                            </div>
                                                            <!-- Cancelled -->
                                                            <div
                                                                v-else-if="
                                                                    ticket
                                                                        .statuses
                                                                        .id == 3
                                                                "
                                                            >
                                                                <span
                                                                    class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800"
                                                                    >Cancelled</span
                                                                >
                                                            </div>
                                                            <!-- Complete -->
                                                            <div v-else>
                                                                <span
                                                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800"
                                                                    >Complete</span
                                                                >
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                                        >
                                                            <a
                                                                href="#"
                                                                class="text-indigo-600 hover:text-indigo-900 mx-4"
                                                                >Edit<span
                                                                    class="sr-only"
                                                                    >,
                                                                    {{
                                                                        ticket.name
                                                                    }}</span
                                                                ></a
                                                            >
                                                            <a
                                                                href="#"
                                                                class="text-indigo-600 hover:text-indigo-900"
                                                                >View<span
                                                                    class="sr-only"
                                                                    >,
                                                                    {{
                                                                        ticket.name
                                                                    }}</span
                                                                ></a
                                                            >
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <Pagination> </Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
