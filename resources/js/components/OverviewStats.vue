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
        <p class="text-sm text-black-900">{{ stat.label }}</p>
        <p class="text-3xl text-[#850038] font-bold mt-1">{{ stat.value }}</p>
        <p class="text-[12px] text-black-900">{{ stat.sub }}</p>
      </template>
    </Card>
  </div>
</template>