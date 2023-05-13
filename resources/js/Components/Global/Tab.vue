<script setup>
import { inject } from "vue";
const props = defineProps({
  title: String,
});
const selected = inject("selected");
</script>
<template>
  <div v-show="selected === title">
    <slot></slot>
  </div>
</template>