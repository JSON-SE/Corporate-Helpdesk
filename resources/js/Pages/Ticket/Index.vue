<script setup>
import { ref, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import {
    PlusIcon as PlusIconMini,
    ArrowPathIcon as ArrowPath,
    ChevronLeftIcon,
    ChevronRightIcon,
} from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/inertia-vue3";
import { moment } from "moment";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    tickets: Object,
    categories: Object,
    offices: Object,
    statuses: Object,
    filters: Object,
});

let search = ref(props.filters.search);
let categoryFilter = ref(props.filters.categoryFilter);
let statusFilter = ref(props.filters.statusFilter);
let officeFilter = ref(props.filters.officeFilter);
watch(search, (value) => {
    Inertia.get(
        "/ticket",
        {
            search: value,
            categoryFilter: categoryFilter.value,
            statusFilter: statusFilter.value,
            officeFilter: officeFilter.value,
        },
        {
            preserveState: true,
            replace: true,
        }
    );
});

function getCategory() {
    watch(categoryFilter, (value) => {
        Inertia.get(
            "/ticket",
            {
                search: search.value,
                categoryFilter: value,
                statusFilter: statusFilter.value,
                officeFilter: officeFilter.value,
            },
            {
                preserveState: true,
                replace: true,
            }
        );
    });
}
function getStatus() {
    watch(statusFilter, (value) => {
        Inertia.get(
            "/ticket",
            {
                search: search.value,
                categoryFilter: categoryFilter.value,
                statusFilter: value,
                officeFilter: officeFilter.value,
            },
            {
                preserveState: true,
                replace: true,
            }
        );
    });
}
function getOffice() {
    watch(officeFilter, (value) => {
        Inertia.get(
            "/ticket",
            {
                search: search.value,
                categoryFilter: categoryFilter.value,
                statusFilter: statusFilter.value,
                officeFilter: value,
            },
            {
                preserveState: true,
                replace: true,
            }
        );
    });
}
function resetFilter() {
    search.value = "";
    categoryFilter.value = "";
    statusFilter.value = "";
    officeFilter.value = "";
}
</script>

<template>
    <Head title="My Tickets" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Tickets
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 sm:px-6 lg:px-8 mt-6 pb-8">
                        <div class="sm:flex sm:items-center">
                            <!-- Search -->
                            <div class="mr-5">
                                <label
                                    for="search"
                                    class="block text-sm font-medium text-gray-700"
                                    >Ticket Search</label
                                >
                                <div class="relative mt-1 flex items-center">
                                    <input
                                        type="text"
                                        v-model="search"
                                        id="search"
                                        class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        autofocus
                                    />
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="mr-5">
                                <label
                                    for="category"
                                    class="block text-sm font-medium text-gray-700"
                                    >Category</label
                                >
                                <select
                                    v-model="categoryFilter"
                                    @click="getCategory"
                                    id="location"
                                    name="location"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                >
                                    <option selected="" value="">
                                        Select Category
                                    </option>
                                    <option
                                        v-for="category in categories"
                                        :key="category.id"
                                        :value="category.id"
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
                                    v-model="statusFilter"
                                    @click="getStatus"
                                    id="location"
                                    name="location"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                >
                                    <option selected="" value="">
                                        Select Status
                                    </option>
                                    <option
                                        v-for="status in statuses"
                                        :key="status.id"
                                        :value="status.id"
                                    >
                                        {{ status.status }}
                                    </option>
                                </select>
                            </div>
                            <!-- office -->
                            <!-- <div class="mr-5">
                                <label
                                    for="office"
                                    class="block text-sm font-medium text-gray-700"
                                    >Office</label
                                >
                                <select
                                    v-model="officeFilter"
                                    @click="getOffice"
                                    id="location"
                                    name="location"
                                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                >
                                    <option selected="" value="">
                                        Select Office
                                    </option>
                                    <option
                                        v-for="office in offices"
                                        :key="office.id"
                                        :value="office.id"
                                    >
                                        {{ office.office }}
                                    </option>
                                </select>
                            </div> -->
                            <div class="mr-2 mt-6">
                                <Link
                                    :href="route('ticket.create')"
                                    type="button"
                                    class="inline-flex items-center rounded-full border border-transparent bg-blue-600 p-1 text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    <PlusIconMini
                                        class="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </Link>
                            </div>
                            <div class="mt-6">
                                <Link
                                    @click="resetFilter"
                                    type="button"
                                    class="inline-flex items-center rounded-full border border-transparent bg-blue-600 p-1 text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    <ArrowPath
                                        class="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </Link>
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
                                                        Ticket Ref. #
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                    >
                                                        Category
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
                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                    >
                                                        Date
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                    >
                                                        <span class="sr-only"
                                                            >Edit</span
                                                        >
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="divide-y divide-gray-200 bg-white"
                                            >
                                                <tr
                                                    v-for="ticket in tickets.data"
                                                    :key="ticket.id"
                                                >
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                                    >
                                                        {{
                                                            ticket.reference_number
                                                        }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                                    >
                                                        {{ ticket.category }}
                                                    </td>

                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                    >
                                                        {{ ticket.user }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                    >
                                                        {{ ticket.office }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                    >
                                                        <!-- open -->
                                                        <div
                                                            v-if="
                                                                ticket.status ==
                                                                'Open'
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
                                                                ticket.status ==
                                                                'In-Progress'
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
                                                                ticket.status ==
                                                                'Cancelled'
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
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                    >
                                                        {{ ticket.created_at }}
                                                    </td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                                    >
                                                        <a
                                                            href="#"
                                                            class="text-indigo-600 hover:text-indigo-900 mx-4"
                                                            >Edit<span
                                                                class="sr-only"
                                                            >
                                                                {{
                                                                    ticket.id
                                                                }}</span
                                                            ></a
                                                        >
                                                        <Link
                                                            :href="
                                                                ticket.view_url
                                                            "
                                                            class="text-indigo-600 hover:text-indigo-900"
                                                            >View<span
                                                                class="sr-only"
                                                                >,
                                                                {{
                                                                    ticket.id
                                                                }}</span
                                                            ></Link
                                                        >
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- pagination -->
                        <nav
                            class="mt-6 flex items-center justify-between mx-auto"
                            aria-label="Pagination"
                        >
                            <div class="hidden sm:block">
                                <p class="text-sm text-gray-700">
                                    Showing
                                    {{ " " }}
                                    <span class="font-medium">{{
                                        tickets.current_page
                                    }}</span>
                                    {{ " " }}
                                    to
                                    {{ " " }}
                                    <span class="font-medium">{{
                                        tickets.per_page
                                    }}</span>
                                    {{ " " }}
                                    of
                                    {{ " " }}
                                    <span class="font-medium">{{
                                        tickets.total
                                    }}</span>
                                    {{ " " }}
                                    results
                                </p>
                            </div>
                            <div
                                class="flex flex-1 justify-between sm:justify-end"
                            >
                                <template v-for="link in tickets.links">
                                    <Link
                                        v-if="link.url"
                                        :href="link.url"
                                        v-html="link.label"
                                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 mr-3"
                                    />
                                    <span
                                        v-else
                                        v-html="link.label"
                                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 mr-3"
                                    ></span>
                                </template>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
