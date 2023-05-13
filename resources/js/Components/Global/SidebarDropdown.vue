<script setup>
//Imports
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  isActive: {
    type: Boolean,
    default: false,
  },
});

const expanded = ref(props.isActive);
</script>
<template>
  <li class="mt-0.5 w-full">
    <a
      class="nav-link ease-nav-brand"
      href="javascript:;"
      @click="expanded = !expanded"
    >
      <slot name="title"></slot>
      <div class="ml-auto">
        <svg
          v-if="expanded"
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-chevron-up"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M6 15l6 -6l6 6"></path>
        </svg>
        <svg
          v-else
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-chevron-down"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M6 9l6 6l6 -6"></path>
        </svg>
      </div>
    </a>
    <Transition name="slide-fade-down">
      <ul class="list-none" v-show="expanded">
        <slot name="links"></slot>
      </ul>
    </Transition>
  </li>
</template>