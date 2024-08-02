<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="error">
            {{ message }}
        </p>
    </div>
</template>
