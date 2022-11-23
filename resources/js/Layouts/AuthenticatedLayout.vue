<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { CheckCircleIcon, XMarkIcon } from "@heroicons/vue/20/solid";

const showingNavigationDropdown = ref(false);
const show = ref(true);
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
                                            Create Ticket
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('ticket.index')"
                                            as="button"
                                        >
                                            My Tickets
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>

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
                                        <DropdownLink href="#" as="button">
                                            User Management
                                        </DropdownLink>
                                        <DropdownLink href="#" as="button">
                                            Assign Staff
                                        </DropdownLink>
                                        <DropdownLink href="#" as="button">
                                            Category Management
                                        </DropdownLink>
                                        <DropdownLink href="#" as="button">
                                            Office Management
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
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
                <!-- Alert Message -->
                <div
                    v-if="$page.props.flash.message"
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
                <slot />
            </main>
        </div>
    </div>
</template>
