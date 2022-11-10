<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    offices: Object,
});

const form = useForm({
    firstName: "",
    middleName: "",
    lastName: "",
    initials: "",
    office_id: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-50">
    <body class="h-full">
    ```
  -->
        <div
            class="flex min-h-full flex-col justify-center py-28 sm:px-6 lg:px-8"
        >
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <img
                    class="mx-auto h-40 w-auto"
                    src="../../../../public/images/seal.png"
                    alt="lguQuezon"
                />
                <h2
                    class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"
                >
                    Register new account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    <a
                        href="#"
                        class="font-medium text-indigo-600 hover:text-indigo-500"
                        >Management Information System IT Helpdesk</a
                    >
                </p>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                for="firstName"
                                class="block text-sm font-medium text-gray-700"
                                >Firstname</label
                            >
                            <div class="mt-1">
                                <input
                                    v-model="form.firstName"
                                    id="firstName"
                                    name="firstName"
                                    type="text"
                                    autocomplete="firstName"
                                    required=""
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.firstName"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="middleName"
                                class="block text-sm font-medium text-gray-700"
                                >Middlename</label
                            >
                            <div class="mt-1">
                                <input
                                    v-model="form.middleName"
                                    id="middleName"
                                    name="middleName"
                                    type="text"
                                    autocomplete="middleName"
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.middleName"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="lastName"
                                class="block text-sm font-medium text-gray-700"
                                >Lastname</label
                            >
                            <div class="mt-1">
                                <input
                                    v-model="form.lastName"
                                    id="lastName"
                                    name="lastName"
                                    type="text"
                                    autocomplete="lastName"
                                    required=""
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.lastName"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="initials"
                                class="block text-sm font-medium text-gray-700"
                                >Initials</label
                            >
                            <div class="mt-1">
                                <input
                                    v-model="form.initials"
                                    id="initials"
                                    name="initials"
                                    type="text"
                                    autocomplete="initials"
                                    required=""
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.initials"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="office"
                                class="block text-sm font-medium text-gray-700"
                                >Select Office</label
                            >
                            <div class="mt-1">
                                <select
                                    v-model="form.office_id"
                                    id="office"
                                    name="office"
                                    type="select"
                                    autocomplete="office"
                                    required=""
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                >
                                    <optgroup v-for="office in offices">
                                        <option :value="office.id">
                                            {{ office.office }}
                                        </option>
                                    </optgroup>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.office"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                                >Email address</label
                            >
                            <div class="mt-1">
                                <input
                                    v-model="form.email"
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    required=""
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700"
                                >Password</label
                            >
                            <div class="mt-1">
                                <input
                                    v-model="form.password"
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="current-password"
                                    required=""
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="confirm_password"
                                class="block text-sm font-medium text-gray-700"
                                >Confirm Password</label
                            >
                            <div class="mt-1">
                                <input
                                    v-model="form.password_confirmation"
                                    id="confirm_password"
                                    name="confirm_password"
                                    type="password"
                                    autocomplete="confirm_password"
                                    required=""
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password_confirmation"
                                />
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <div class="text-sm">
                                <Link
                                    href="login"
                                    class="font-medium text-indigo-600 hover:text-indigo-500"
                                    >Already a user?</Link
                                >
                            </div>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Sign in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
