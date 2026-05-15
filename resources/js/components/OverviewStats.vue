<script setup>
import Card from 'primevue/card';

defineProps({
  stats: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div>
    <h1 class="font-palatino text-[32px] text-[#850038] mb-6">Overview</h1>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <Card v-for="stat in stats" :key="stat.label">
      <template #content>
        <p class="text-[20px] font-regular text-black">{{ stat.label }}</p>
        <p class="text-5xl text-[#850038] font-bold mt-1">{{ stat.value }}</p>
        <p class="text-[14px] text-black">{{ stat.sub }}</p>
      </template>
    </Card>
  </div>
</template>