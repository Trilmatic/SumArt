<script setup>
//imports
import TomSelect from "tom-select/dist/js/tom-select.complete.min";
import { onMounted, ref } from "vue";
import { toLocaleStringArray } from "@/Functions/variables";
import { saveDateFormat, initDateFormat } from "@/Functions/helpers";

const select = ref(null);

const onChange = (value) => saveDateFormat(value);

const initSelect = () => {
  const renderItem = (data, escape) => {
    return "<div>" + escape(data.name) + "</div>";
  };
  const tomselect = new TomSelect(select.value, {
    valueField: "code",
    searchField: "name",
    maxItems: 1,
    options: toLocaleStringArray,
    render: {
      option: renderItem,
      item: renderItem,
    },
  });
  tomselect.addItem(initDateFormat(), false);
  tomselect.on("change", onChange);
};

onMounted(() => {
  initSelect();
});
</script>
<template>
  <input ref="select" />
</template>