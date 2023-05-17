<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import ContextMenuIcon from "@/Components/Icons/ContextMenuIcon.vue";

const visible = ref(false);
const popup = ref(null);

function clickHandler({ target }) {
  if (!visible.value || popup.value.contains(target)) return;
  visible.value = false;
}
function keyHandler({ keyCode }) {
  if (!visible.value || keyCode !== 27) return;
  visible.value = false;
}
onMounted(() => {
  document.addEventListener("click", clickHandler);
  document.addEventListener("keydown", keyHandler);
});
onUnmounted(() => {
  document.removeEventListener("click", clickHandler);
  document.removeEventListener("keydown", keyHandler);
});
</script>
<template>
  <div class="relative" ref="popup">
    <button @click="visible = !visible">
      <ContextMenuIcon />
    </button>
      <Transition name="slide-fade-down">
        <div
          class="absolute left-0 top-[calc(100%+0.5rem)] z-110 w-full max-w-lg rounded-xl bg-slate-300 dark:bg-slate-700 shadow-xl dark:shadow-dark-xl"
          v-if="visible"
        >
          <div class="flex flex-col w-full">
            <slot></slot>
          </div>
        </div>
      </Transition>
  </div>
</template>