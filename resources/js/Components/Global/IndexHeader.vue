<script setup></script>
<template>
  <div class="card sm:flex sm:flex-wrap justify-between items-center mb-2">
    <h2 class="h2 mb-2 text-2xl flex space-x-2">
      <slot name="title"></slot>
    </h2>
    <div class="flex space-x-2">
      <slot name="buttons"></slot>
    </div>
  </div>
</template>