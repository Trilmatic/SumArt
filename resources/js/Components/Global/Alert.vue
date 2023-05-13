<script setup>
import { reactive, ref, onMounted, onUnmounted } from "vue";

const visible = ref(true);
const interval = ref(null);
const percentage = ref(100);

const props = defineProps({
  type: {
    type: String,
    default: "default",
  },
  message: String,
});

onMounted(() => {
  interval.value = setInterval(() => {
    percentage.value -= 3.5;
  }, 100);
  setTimeout(() => {
    clearInterval(interval.value);
    visible.value = false;
  }, 3000);
});

onUnmounted(() => {
  clearInterval(interval);
});
</script>
<template>
  <Transition name="fade" appear>
    <div class="alert" :class="'alert-' + type" v-if="visible">
      <svg
        aria-hidden="true"
        class="flex-shrink-0 w-5 h-5"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
          clip-rule="evenodd"
        ></path>
      </svg>
      <span class="sr-only">{{ type }}</span>
      <div class="ml-3 text-sm font-medium">
        {{ message }}
      </div>
      <button
        type="button"
        class="close-button"
        aria-label="Close"
        @click="visible = false"
      >
        <span class="sr-only">Close</span>
        <svg
          aria-hidden="true"
          class="w-5 h-5"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <div class="absolute bottom-0 left-0 w-full h-2">
        <div class="relative w-full h-2">
          <!-- Timer counter -->
          <div class="counter"></div>
          <!-- Timer bar progress -->
          <div
            class="time-left"
            :class="type"
            :style="'width:' + percentage + '%'"
          ></div>
        </div>
      </div>
    </div>
  </Transition>
</template>