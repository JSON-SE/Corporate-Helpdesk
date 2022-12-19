<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Inertia } from "@inertiajs/inertia";
import {
    FaceFrownIcon,
    FaceSmileIcon,
    FireIcon,
    HandThumbUpIcon,
    HeartIcon,
    PaperClipIcon,
    XMarkIcon,
    ChatBubbleLeftEllipsisIcon,
    TagIcon,
    UserCircleIcon,
} from "@heroicons/vue/20/solid";
import {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/vue";

const props = defineProps({
    res: Object,
    mappedActivities: Object,
});

const form = useForm({
    id: props.res.id,
    comment: "",
    fileUpload: [],
    terms: false,
});

const submit = () => {
    form.post(route("comment.store", props.res.id), {
        onFinish: () => form.reset("comment"),
    });
};

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
                <div class="grid grid-cols-2 gap-4">
                    <!-- first column -->
                    <div class="col-span-1">
                        <div class="px-4 py-5 sm:px-6">
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Ticket Details
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                User and ticket report details
                            </p>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <dl
                                class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2"
                            >
                                <div class="sm:col-span-1">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Full name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ res.user }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Office
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ res.office }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Reference number
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ res.reference_number }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Status
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <div v-if="res.status == 'Open'">
                                            <span
                                                class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                                >Open</span
                                            >
                                        </div>
                                        <div
                                            v-else-if="
                                                res.status == 'In-progress'
                                            "
                                        >
                                            <span
                                                class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800"
                                                >In-progress</span
                                            >
                                        </div>
                                        <div
                                            v-else-if="
                                                res.status == 'Cancelled'
                                            "
                                        >
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
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Assigned to
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ res.assigned_user }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Assigned office
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ res.assigned_office }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Subject
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ res.title }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Date Created
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ res.created_at }}
                                    </dd>
                                </div>
                                <!-- <div class="sm:col-span-2">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Details
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ res.content }}
                                    </dd>
                                </div> -->
                                <div class="sm:col-span-1">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Remarks
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{
                                            res.remarks
                                                ? res.remarks
                                                : "No remarks"
                                        }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
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
                    <!-- second column -->
                    <div class="col-span-1">
                        <div class="px-4 py-5 sm:px-6">
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Feeds
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Stay informed: Get updates on the status of your
                                issued ticket
                            </p>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <inputerror
                                class="mt-2"
                                :message="form.errors.comment"
                            />
                            <!-- Add Comment -->
                            <div class="flex items-start space-x-4 mb-5">
                                <div class="flex-shrink-0">
                                    <!-- <img
                                        class="inline-block h-10 w-10 rounded-full"
                                        src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt=""
                                    /> -->
                                    <div>
                                        <div class="relative px-1">
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white"
                                            >
                                                <UserCircleIcon
                                                    class="h-7 w-7 text-gray-500"
                                                    aria-hidden="true"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <form
                                        @submit.prevent="submit"
                                        class="relative"
                                    >
                                        <div
                                            class="overflow-hidden rounded-lg border border-gray-300 shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500"
                                        >
                                            <label for="comment" class="sr-only"
                                                >Add your comment</label
                                            >
                                            <textarea
                                                rows="3"
                                                v-model="form.comment"
                                                id="comment"
                                                class="block w-full resize-none border-0 py-3 focus:ring-0 sm:text-sm"
                                                placeholder="Add your comment..."
                                            />

                                            <!-- Spacer element to match the height of the toolbar -->
                                            <div
                                                class="py-2"
                                                aria-hidden="true"
                                            >
                                                <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                                                <div class="py-px">
                                                    <div class="h-9" />
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2"
                                        >
                                            <div class="flex items-center">
                                                <input
                                                    v-on:change="
                                                        form.fileUpload
                                                    "
                                                    type="file"
                                                    class="py-2 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                                                    multiple
                                                />
                                            </div>
                                            <div class="flex-shrink-0">
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                >
                                                    Post
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Add Comment -->
                            <div class="flow-root mt-10">
                                <ul role="list" class="-mb-8">
                                    <li
                                        v-for="(
                                            activityItem, activityItemIdx
                                        ) in mappedActivities"
                                        :key="activityItem.id"
                                    >
                                        <div class="relative pb-8">
                                            <span
                                                v-if="
                                                    activityItemIdx !==
                                                    mappedActivities.length - 1
                                                "
                                                class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
                                                aria-hidden="true"
                                            />
                                            <div
                                                class="relative flex items-start space-x-3"
                                            >
                                                <template
                                                    v-if="
                                                        activityItem.type ===
                                                        'comment'
                                                    "
                                                >
                                                    <div class="relative">
                                                        <!-- <img
                                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white"
                                                            :src="
                                                                activityItem.imageUrl
                                                            "
                                                            alt=""
                                                        /> -->
                                                        <div>
                                                            <div
                                                                class="relative px-1"
                                                            >
                                                                <div
                                                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white"
                                                                >
                                                                    <UserCircleIcon
                                                                        class="h-7 w-7 text-gray-500"
                                                                        aria-hidden="true"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span
                                                            class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px"
                                                        >
                                                            <ChatBubbleLeftEllipsisIcon
                                                                class="h-5 w-5 text-gray-400"
                                                                aria-hidden="true"
                                                            />
                                                        </span>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div
                                                                class="text-sm"
                                                            >
                                                                <a
                                                                    class="font-medium text-gray-900"
                                                                    >{{
                                                                        activityItem.user
                                                                    }}</a
                                                                >
                                                            </div>
                                                            <p
                                                                class="mt-0.5 text-sm text-gray-500"
                                                            >
                                                                Commented
                                                                {{
                                                                    activityItem.date
                                                                }}
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="mt-2 text-sm text-gray-700"
                                                        >
                                                            <p>
                                                                {{
                                                                    activityItem.comment
                                                                }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </template>
                                                <template
                                                    v-else-if="
                                                        activityItem.type ===
                                                        'assignment'
                                                    "
                                                    condition="activityItem.type === 'assignment'"
                                                >
                                                    <div>
                                                        <div
                                                            class="relative px-1"
                                                        >
                                                            <div
                                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white"
                                                            >
                                                                <UserCircleIcon
                                                                    class="h-5 w-5 text-gray-500"
                                                                    aria-hidden="true"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="min-w-0 flex-1 py-1.5"
                                                    >
                                                        <div
                                                            class="text-sm text-gray-500"
                                                        >
                                                            <a
                                                                href="
                                                                    #
                                                                "
                                                                class="font-medium text-gray-900"
                                                                >{{
                                                                    activityItem.user
                                                                }}</a
                                                            >
                                                            {{ " " }}
                                                            {{
                                                                activityItem.comment
                                                            }}
                                                            <span
                                                                class="whitespace-nowrap"
                                                                >{{
                                                                    activityItem.date
                                                                }}</span
                                                            >
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
