<script setup>
import { ref, provide, useSlots, onMounted } from "vue";
const slots = useSlots();
const tabs = ref(slots.default().map((tab) => tab.props.title));
const selected = ref(tabs.value[0]);
provide("selected", selected);
</script>
<template>
  <div
    class="tabs"
  >
    <ul div class="flex flex-wrap -mb-px">
      <li class="mr-2" v-for="(t, i) in tabs" :key="i">
        <a
          href="javascript:;"
          class="tab"
          :class="selected == t ? 'active' : ''"
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