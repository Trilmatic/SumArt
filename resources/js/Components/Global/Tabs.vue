<script setup>
import { ref, provide, useSlots, onMounted } from "vue";
const slots = useSlots();
const tabs = ref(slots.default().map((tab) => tab.props.title));
const selected = ref(tabs.value[0]);
provide("selected", selected);
</script>
<template>
  <div
    class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700"
  >
    <ul div class="flex flex-wrap -mb-px">
      <li class="mr-2" v-for="(t, i) in tabs" :key="i">
        <a
          href="javascript:;"
          class="inline-block p-4 border-b-2 border-transparent rounded-t-lg"
          :class="selected == t ? 'text-primary border-primary' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'"
          @click="selected = t"
          v-html="t"
        ></a>
      </li>
    </ul>
  </div>
  <div class="py-2">
    <slot></slot>
  </div>
</template>