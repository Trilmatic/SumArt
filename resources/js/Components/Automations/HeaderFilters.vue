<script setup>
import { ref } from "vue";
import { router, Link } from "@inertiajs/vue3";
import { debounce } from "@/Functions/helpers";
import CreateAutomationIcon from "@/Components/Icons/CreateAutomationIcon.vue";

const props = defineProps({
  filter: [Object, null],
});
const emit = defineEmits(["filters:filter", "filters:clear"]);
const timer = ref(null);

const debounceFilter = (event) => {
  debounce(triggerFilter(event.target.value), 500);
};

const clearFilters = () => {
  emit("filters:clear");
};

const triggerFilter = (value) => {
  emit("filters:filter", value);
};
</script>
<template>
  <div class="flex flex-wrap space-x-2">
    <div class="relative">
      <div
        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-search w-5 h-5 text-gray-500 dark:text-gray-400"
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
          <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
          <path d="M21 21l-6 -6"></path>
        </svg>
      </div>
      <input
        :value="filter && filter.name ? filter.name : null"
        class="form-input pl-10"
        type="search"
        @input="debounceFilter"
      />
    </div>
    <button
      v-if="
        filter &&
        (filter.name || filter.content_status_id || filter.content_type_id)
      "
      class="btn btn-sm btn-slate"
      @click="clearFilters()"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="icon icon-tabler icon-tabler-filter-x stroke-error"
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
        <path
          d="M13.785 19.405l-4.785 1.595v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414"
        ></path>
        <path d="M22 22l-5 -5"></path>
        <path d="M17 22l5 -5"></path>
      </svg>
    </button>
    <Link href="/automations/create" class="btn btn-primary btn-sm font-bold">
      <CreateAutomationIcon /><span class="ml-1">Create automation</span>
    </Link>
  </div>
</template>