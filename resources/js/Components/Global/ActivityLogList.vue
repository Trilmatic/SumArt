<script setup>
import ArrowBadgeRightIcon from "@/Components/Icons/ArrowBadgeRightIcon.vue";
import { activityLogMessages } from "@/Functions/variables";
import { formatDateTime } from "@/Functions/helpers";
import { computed } from "vue";
const props = defineProps({
  activity: Array,
});

const activityList = computed(() => {
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
  <ul class="p-4">
    <li v-for="a in activityList" :key="a.id" class="mb-0 p-0">
      <div class="flex space-x-2">
        <p
          class="mb-0 text-sm leading-normal text-center text-slate-700 dark:text-slate-400 lg:text-left"
        >
          {{ formatDateTime(a.created_at) }}
        </p>
        <p class="mb-0 pb-4 px-2 border-l border-primary text-sm">
          {{ a.message }}
          <span v-for="(value, key) in a.properties.old" :key="key">
            <span
              class="block py-1"
              v-if="value && value !== a.properties.attributes[key]"
            >
              <span class="text-slate-500">
                {{
                  a.properties.attributes[key]
                    ? a.properties.attributes[key]
                    : "none"
                }}

                <ArrowBadgeRightIcon /> {{ value }}
              </span>
            </span>
          </span>
        </p>
      </div>
    </li>
  </ul>
</template>