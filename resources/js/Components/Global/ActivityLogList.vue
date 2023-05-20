<script setup>
import ArrowBadgeRightIcon from "@/Components/Icons/ArrowBadgeRightIcon.vue";
import { activityLogMessages } from "@/Functions/variables";
import { formatDateTime } from "@/Functions/helpers";
import { Link, router } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
  activity: Array,
});

const activityList = computed(() => {
  if (!props.activity) return [];
  return props.activity.map((a) => {
    if (
      activityLogMessages[a.subject_type] &&
      activityLogMessages[a.subject_type][a.description]
    ) {
      a.message = activityLogMessages[a.subject_type][a.description];
    } else {
      a.message = "";
    }
    return a;
  });
});
</script>
<template>
  <ol class="relative border-l border-gray-200 dark:border-gray-700 mt-4">
    <li class="mb-4 ml-4" v-for="a in activityList" :key="a.id">
      <div
        class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
      ></div>
      <time
        class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"
        >{{ formatDateTime(a.created_at) }}</time
      >
      <h4
        class="text-base font-semibold text-gray-900 dark:text-white"
        v-if="a.subject_type === 'App\\Models\\Automation'"
      >
        <Link class="link" :href="route('automations.showById', a.subject_id)"
          >Automation</Link
        >
        {{ a.message }}
      </h4>
      <p class="text-sm mb-4 font-normal text-gray-500 dark:text-gray-400" v-if="false">
        <span v-for="(value, key) in a.properties.old" :key="key">
          <span
            class="block py-1"
            v-if="value && value !== a.properties.attributes[key]"
          >
            <span class="text-slate-500">
              {{ value }}

              <ArrowBadgeRightIcon />
              {{
                a.properties.attributes[key]
                  ? a.properties.attributes[key]
                  : "none"
              }}
            </span>
          </span></span
        >
      </p>
    </li>
  </ol>
</template>