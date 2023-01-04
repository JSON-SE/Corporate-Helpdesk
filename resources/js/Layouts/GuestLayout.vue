<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { onMounted } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

onMounted(() => {
    // Set the interval to reload the page every 60 seconds (60000 milliseconds)
    setInterval(() => {
        // Use the Inertia.reload function to reload the page
        Inertia.reload();
    }, 10000);
});
</script>

<template>
    <div class="h-full bg-gray-50"><slot /></div>
</template>
