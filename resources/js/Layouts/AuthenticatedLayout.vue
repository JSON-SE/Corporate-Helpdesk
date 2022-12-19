<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { CheckCircleIcon } from "@heroicons/vue/20/solid";
import { BellIcon, XMarkIcon } from "@heroicons/vue/24/outline";

const showingNavigationDropdown = ref(false);
const show = ref(true);
const open = ref(false);


function removeNotification(id){
    
    confirm("Are you sure to remove this notification?");
    Inertia.put(route("notified.close", id));
    
}
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <!-- navigation -->
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-12 w-auto"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </NavLink>
                            </div>
                            <!-- Ticket -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <!-- Settings Dropdown -->
                                <Dropdown>
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="mt-4 inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                Ticket

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('ticket.create')"
                                            as="button"
                                        >
                                            Request Ticket
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('ticket.index')"
                                            as="button"
                                        >
                                            Requested Tickets
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                            <!-- Tasks -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <!-- Settings Dropdown -->
                                <Dropdown>
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="mt-4 inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                Task Management

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('task.index')"
                                            as="button"
                                        >
                                            Tasks
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('ticket.index')"
                                            as="button"
                                        >
                                            Accomplishments
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <!-- Settings Dropdown -->
                                <Dropdown
                                    v-if="
                                        $page.props.user.roles.includes('admin')
                                    "
                                >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="mt-4 inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                Management

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="
                                                route(
                                                    'admin-ticket-management.index'
                                                )
                                            "
                                            as="button"
                                        >
                                            Ticket Management
                                        </DropdownLink>
                                        <DropdownLink href="#" as="button">
                                            User Management
                                        </DropdownLink>
                                        <!-- <DropdownLink href="#" as="button">
                                            Category Management
                                        </DropdownLink> -->
                                        <DropdownLink href="#" as="button">
                                            Office Management
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="relative inline-block pr-2 mr-4">
                                <button
                                    @click="open = !open"
                                    type="button"
                                    class="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    <span class="sr-only"
                                        >View notifications</span
                                    >
                                    <BellIcon
                                        class="h-6 w-6"
                                        aria-hidden="true"
                                    />
                                    <div
                                        v-if="$page.props.notification_counter"
                                    >
                                        <span
                                            class="absolute inset-0 object-right-top -mr-6"
                                        >
                                            <div
                                                class="inline-flex items-center px-1.5 py-0.5 border-2 border-white rounded-full text-xs font-semibold leading-4 bg-red-500 text-white"
                                            >
                                                {{
                                                    $page.props
                                                        .notification_counter
                                                }}
                                            </div>
                                        </span>
                                    </div>
                                </button>
                            </div>
                            <div class="ml-1 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{
                                                    $page.props.auth.user
                                                        .firstName
                                                }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <TransitionRoot as="template" :show="open">
                    <Dialog
                        as="div"
                        class="relative z-10"
                        @close="open = false"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-500"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-500"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div
                                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                            />
                        </TransitionChild>

                        <div class="fixed inset-0 overflow-hidden">
                            <div class="absolute inset-0 overflow-hidden">
                                <div
                                    class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                                >
                                    <TransitionChild
                                        as="template"
                                        enter="transform transition ease-in-out duration-500 sm:duration-700"
                                        enter-from="translate-x-full"
                                        enter-to="translate-x-0"
                                        leave="transform transition ease-in-out duration-500 sm:duration-700"
                                        leave-from="translate-x-0"
                                        leave-to="translate-x-full"
                                    >
                                        <DialogPanel
                                            class="pointer-events-auto w-screen max-w-md"
                                        >
                                            <div
                                                class="flex h-full flex-col overflow-y-scroll bg-gray-50 py-6 shadow-xl"
                                            >
                                                <div class="px-4 sm:px-6">
                                                    <div
                                                        class="flex items-start justify-between"
                                                    >
                                                        <DialogTitle
                                                            class="text-lg font-medium text-gray-900"
                                                            >Notifications</DialogTitle
                                                        >
                                                        <div
                                                            class="ml-3 flex h-7 items-center"
                                                        >
                                                            <button
                                                                type="button"
                                                                class="rounded-md bg-grey-50 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                                @click="
                                                                    open = false
                                                                "
                                                            >
                                                                <span
                                                                    class="sr-only"
                                                                    >Close
                                                                    panel</span
                                                                >
                                                                <XMarkIcon
                                                                    class="h-6 w-6"
                                                                    aria-hidden="true"
                                                                />
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="relative mt-6 flex-1 px-4 sm:px-6"
                                                >
                                                    <!-- Replace with your content -->

                                                    <div
                                                        v-for="item in $page
                                                            .props
                                                            .notifications"
                                                        :key="item.id"
                                                    >
                                                        <div
                                                            class="w-full p-3 mt-4 bg-white rounded shadow flex flex-shrink-0"
                                                        >
                                                            <div
                                                                tabindex="0"
                                                                aria-label="post icon"
                                                                role="img"
                                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center"
                                                            >
                                                                <svg
                                                                    width="16"
                                                                    height="16"
                                                                    viewBox="0 0 16 16"
                                                                    fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path
                                                                        d="M4.30325 12.6667L1.33325 15V2.66667C1.33325 2.48986 1.40349 2.32029 1.52851 2.19526C1.65354 2.07024 1.82311 2 1.99992 2H13.9999C14.1767 2 14.3463 2.07024 14.4713 2.19526C14.5963 2.32029 14.6666 2.48986 14.6666 2.66667V12C14.6666 12.1768 14.5963 12.3464 14.4713 12.4714C14.3463 12.5964 14.1767 12.6667 13.9999 12.6667H4.30325ZM5.33325 6.66667V8H10.6666V6.66667H5.33325Z"
                                                                        fill="#4338CA"
                                                                    />
                                                                </svg>
                                                            </div>
                                                            <div
                                                                class="pl-3 w-full"
                                                            >
                                                                <div
                                                                    class="flex items-center justify-between w-full"
                                                                >
                                                                    <p
                                                                        tabindex="0"
                                                                        class="focus:outline-none text-sm leading-none"
                                                                    >
                                                                        <span
                                                                            class="text-indigo-700"
                                                                            >{{
                                                                                item.sender_name
                                                                            }}</span
                                                                        >
                                                                        <div v-if="item.type === 1">
                                                                            commented on your ticket
                                                                        </div>
                                                                        <div v-else-if="item.type === 2">
                                                                            {{ item.comment }}
                                                                        </div>
                                                                        <div v-else-if="item.type === 4">
                                                                            has assigned you on a ticket
                                                                        </div>
                                                                        <span
                                                                            class="text-indigo-700"
                                                                            >{{ item.reference_number }}</span
                                                                        >
                                                                    </p>
                                                                    <button
                                                                        tabindex="0"
                                                                        aria-label="close icon"
                                                                        @click="removeNotification(item.id)"
                                                                        type="button"
                                                                        class="focus:outline-none cursor-pointer"
                                                                    >
                                                                        <svg
                                                                            width="14"
                                                                            height="14"
                                                                            viewBox="0 0 14 14"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                d="M10.5 3.5L3.5 10.5"
                                                                                stroke="#4B5563"
                                                                                stroke-width="1.25"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                            />
                                                                            <path
                                                                                d="M3.5 3.5L10.5 10.5"
                                                                                stroke="#4B5563"
                                                                                stroke-width="1.25"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                            />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                <p
                                                                    tabindex="0"
                                                                    class="focus:outline-none text-xs leading-3 pt-1 text-gray-500"
                                                                >
                                                                   {{ item.date }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /End replace -->
                                                </div>
                                            </div>
                                        </DialogPanel>
                                    </TransitionChild>
                                </div>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot>
                <!-- Alert Ticket Created -->
                <div
                    v-if="$page.props.flash.ticketCreated"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <CheckCircleIcon
                                                class="h-6 w-6 text-green-400"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Successfully saved!
                                            </p>
                                            <p
                                                class="mt-1 text-sm text-gray-500"
                                            >
                                                Your concern is now recorded.
                                                Please wait until MIS
                                                representative is available to
                                                address your concern. Have a
                                                great day ahead!
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <!-- Alert Ticket Updated -->
                <div
                    v-else-if="$page.props.flash.ticketUpdated"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <CheckCircleIcon
                                                class="h-6 w-6 text-green-400"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Successfully updated!
                                            </p>
                                            <p
                                                class="mt-1 text-sm text-gray-500"
                                            >
                                                Your ticket has been updated.
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <!-- Alert Ticket Removed -->
                <div
                    v-else-if="$page.props.flash.ticketDestroyed"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-red-400 ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <CheckCircleIcon
                                                class="h-6 w-6 text-red-400"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Removed successfully.
                                            </p>
                                            <p
                                                class="mt-1 text-sm text-red-500"
                                            >
                                                Your ticket has been removed.
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <!-- Registration Alert -->
                <div
                    v-else-if="$page.props.flash.registered"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-center">
                                        <div
                                            class="flex w-0 flex-1 justify-between"
                                        >
                                            <p
                                                class="w-0 flex-1 text-sm font-medium text-gray-900"
                                            >
                                                <strong>Welcome</strong>
                                                {{
                                                    $page.props.auth.user
                                                        .firstName
                                                }}
                                                {{
                                                    $page.props.auth.user
                                                        .middleName
                                                }}
                                                {{
                                                    $page.props.auth.user
                                                        .lastName
                                                }}!
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <!-- Logged in -->
                <div
                    v-else-if="$page.props.flash.loggedIn"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-center">
                                        <div
                                            class="flex w-0 flex-1 justify-between"
                                        >
                                            <p
                                                class="w-0 flex-1 text-sm font-medium text-gray-900"
                                            >
                                                <strong>Welcome back</strong>
                                                {{
                                                    $page.props.auth.user
                                                        .firstName
                                                }}
                                                {{
                                                    $page.props.auth.user
                                                        .middleName
                                                }}
                                                {{
                                                    $page.props.auth.user
                                                        .lastName
                                                }}!
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <!-- Alert Ticket Accepted -->
                <div
                    v-else-if="$page.props.flash.ticketAccepted"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <CheckCircleIcon
                                                class="h-6 w-6 text-green-400"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Ticket has been accepted.
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <!-- Alert Ticket Accepted -->
                <div
                    v-else-if="$page.props.flash.commentPosted"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <CheckCircleIcon
                                                class="h-6 w-6 text-green-400"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Your comment has been posted.
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <!-- Alert Ticket Closed -->
                <div
                    v-else-if="$page.props.flash.ticketClosed"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <CheckCircleIcon
                                                class="h-6 w-6 text-green-400"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Ticket has been closed
                                                successfully.
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <!-- Alert Ticket Removed -->
                <div
                    v-else-if="$page.props.flash.ticketCancelled"
                    aria-live="assertive"
                    class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6"
                >
                    <div
                        class="flex w-full flex-col items-center space-y-4 sm:items-end"
                    >
                        <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                        <transition
                            enter-active-class="transform ease-out duration-300 transition"
                            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                            leave-active-class="transition ease-in duration-100"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="show"
                                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-red-400 ring-opacity-5"
                            >
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <CheckCircleIcon
                                                class="h-6 w-6 text-red-400"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Cancelled
                                            </p>
                                            <p
                                                class="mt-1 text-sm text-red-500"
                                            >
                                                Your ticket has been cancelled.
                                            </p>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">
                                            <button
                                                type="button"
                                                @click="show = false"
                                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                            >
                                                <span class="sr-only"
                                                    >Close</span
                                                >
                                                <XMarkIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <slot />
            </main>
        </div>
    </div>
</template>
