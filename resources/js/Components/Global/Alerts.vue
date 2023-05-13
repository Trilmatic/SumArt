<script setup>
import { onMounted, reactive, ref } from "vue";
import Alert from "@/Components/Global/Alert.vue";

const eventName = ref("alert:push");
const alerts = ref([]);

const startListening = () => {
  document.addEventListener(eventName.value, (e) => {
    pushAlert(e.detail);
  });
};

const pushAlert = (alert) => {
  alerts.value.push(alert);
};

onMounted(() => {
  startListening();
});
</script>
<template>
  <div class="alert-container">
    <Alert
      v-for="(a, i) in alerts"
      :key="i"
      :type="a.type"
      :message="a.message"
    />
  </div>
</template>