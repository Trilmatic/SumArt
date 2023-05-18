<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import ContextMenuIcon from "@/Components/Icons/ContextMenuIcon.vue";

const visible = ref(false);
const popup = ref(null);
const button = ref(null);
const positionTop = ref(null);
const positionLeft = ref(null);

const clickHandler = ({ target }) => {
  if (!visible.value || popup.value.contains(target)) return;
  visible.value = false;
};

const keyHandler = ({ keyCode }) => {
  if (!visible.value || keyCode !== 27) return;
  visible.value = false;
};

const initPosition = () => {
  const rect = button.value.getBoundingClientRect();
  positionTop.value = rect.top + window.scrollY + 25;
  positionLeft.value = rect.left + window.scrollX;
};

const toggleVisible = () => {
  initPosition();
  visible.value = !visible.value;
};

onMounted(() => {
  initPosition();
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
    <button
      ref="button"
      :class="{ 'text-info': visible }"
      @click="toggleVisible"
    >
      <ContextMenuIcon />
    </button>
    <Teleport to="body">
      <Transition
        enter-active-class="duration-100 ease-out"
        enter-from-class="transform opacity-0"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="duration-100 ease-in"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="transform opacity-0"
      >
        <div
          class="absolute z-110 rounded-xl bg-slate-300 dark:bg-slate-700 shadow-xl dark:shadow-dark-xl transition-opacity duration-200"
          :style="'top:' + positionTop + 'px;left:' + positionLeft + 'px;'"
          v-if="visible"
        >
          <div class="flex flex-col w-full">
            <slot></slot>
          </div>
        </div>
      </Transition>
    </Teleport>
  </div>
</template>