<script setup>
import { ref, computed } from 'vue';
import { FilterMatchMode } from '@primevue/core/api';

import AdminNavbar from '@/Components/AdminNavbar.vue';
import OverviewStats from '@/Components/OverviewStats.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';

import AdminLayout from '@/Layouts/AdminLayout.vue';

// Table data
const reservations = ref([
  /*
  { referenceNumber: '20260504-8743', fullName: 'John Doe',          mobileNumber: '09123456789', facility: 'PAH',        equipment: 'Camera',      purpose: 'Event',       transactionDate: '2026-05-04' },
  { referenceNumber: '20260504-1234', fullName: 'Mark Ian',          mobileNumber: '09058551732', facility: 'AVR',        equipment: 'Projector',   purpose: 'Meeting',     transactionDate: '2026-05-06' },
  { referenceNumber: '20260505-2391', fullName: 'Maria Santos',      mobileNumber: '09171234567', facility: 'Library',    equipment: 'Laptop',      purpose: 'Study',       transactionDate: '2026-05-05' },
  { referenceNumber: '20260505-4820', fullName: 'Jose Reyes',        mobileNumber: '09281234567', facility: 'PAH',        equipment: 'Microphone',  purpose: 'Seminar',     transactionDate: '2026-05-05' },
  { referenceNumber: '20260506-3317', fullName: 'Ana Dela Cruz',     mobileNumber: '09391234567', facility: 'AVR',        equipment: 'Camera',      purpose: 'Graduation',  transactionDate: '2026-05-06' },
  { referenceNumber: '20260506-7743', fullName: 'Carlo Mendoza',     mobileNumber: '09501234567', facility: 'Gymnasium',  equipment: 'Speaker',     purpose: 'Sports',      transactionDate: '2026-05-06' },
  { referenceNumber: '20260507-5512', fullName: 'Liza Villanueva',   mobileNumber: '09611234567', facility: 'PAH',        equipment: 'Projector',   purpose: 'Workshop',    transactionDate: '2026-05-07' },
  { referenceNumber: '20260507-8834', fullName: 'Ryan Castillo',     mobileNumber: '09721234567', facility: 'AVR',        equipment: 'Laptop',      purpose: 'Training',    transactionDate: '2026-05-07' },
  { referenceNumber: '20260508-1123', fullName: 'Nina Aquino',       mobileNumber: '09831234567', facility: 'Library',    equipment: 'Microphone',  purpose: 'Seminar',     transactionDate: '2026-05-08' },
  { referenceNumber: '20260508-6654', fullName: 'Paolo Ramos',       mobileNumber: '09941234567', facility: 'Gymnasium',  equipment: 'Camera',      purpose: 'Event',       transactionDate: '2026-05-08' },
  { referenceNumber: '20260509-3345', fullName: 'Carla Bautista',    mobileNumber: '09151234567', facility: 'PAH',        equipment: 'Speaker',     purpose: 'Concert',     transactionDate: '2026-05-09' },
  { referenceNumber: '20260509-7891', fullName: 'Miguel Torres',     mobileNumber: '09261234567', facility: 'AVR',        equipment: 'Projector',   purpose: 'Meeting',     transactionDate: '2026-05-09' },
  { referenceNumber: '20260510-2278', fullName: 'Sofia Gonzales',    mobileNumber: '09371234567', facility: 'Library',    equipment: 'Laptop',      purpose: 'Research',    transactionDate: '2026-05-10' },
  { referenceNumber: '20260510-5563', fullName: 'Daniel Flores',     mobileNumber: '09481234567', facility: 'Gymnasium',  equipment: 'Microphone',  purpose: 'Sports',      transactionDate: '2026-05-10' },
  { referenceNumber: '20260511-4410', fullName: 'Isabel Pascual',    mobileNumber: '09591234567', facility: 'PAH',        equipment: 'Camera',      purpose: 'Workshop',    transactionDate: '2026-05-11' },
  { referenceNumber: '20260511-8821', fullName: 'Jerome Navarro',    mobileNumber: '09201234567', facility: 'AVR',        equipment: 'Speaker',     purpose: 'Training',    transactionDate: '2026-05-11' },
  { referenceNumber: '20260512-1190', fullName: 'Patricia Morales',  mobileNumber: '09311234567', facility: 'Library',    equipment: 'Projector',   purpose: 'Seminar',     transactionDate: '2026-05-12' },
  { referenceNumber: '20260512-6637', fullName: 'Kevin Hernandez',   mobileNumber: '09421234567', facility: 'Gymnasium',  equipment: 'Laptop',      purpose: 'Event',       transactionDate: '2026-05-12' },
  { referenceNumber: '20260513-3309', fullName: 'Rachel Domingo',    mobileNumber: '09531234567', facility: 'PAH',        equipment: 'Microphone',  purpose: 'Graduation',  transactionDate: '2026-05-13' },
  { referenceNumber: '20260513-9982', fullName: 'Aaron Villanueva',  mobileNumber: '09641234567', facility: 'AVR',        equipment: 'Camera',      purpose: 'Meeting',     transactionDate: '2026-05-13' },
  */
  ]);

// Stats — total is dynamic, rest are static for now
const stats = computed(() => {
  const monthName = new Date().toLocaleString('default', { month: 'long' });

  return [
    { label: 'Total Reservations', value: reservations.value.length.toString(), sub: 'All reservations' },
    { label: 'Pendings',           value: '12', sub: 'Waiting for review' },
    { label: 'Approved',           value: '6',  sub: `This month of ${monthName}` },
    { label: 'Rejected',           value: '1',  sub: `This month of ${monthName}` },
  ];
});

// Filters — global only
const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});
</script>

<template>
  <AdminLayout>
    <template #header-actions>
      <AdminNavbar />
    </template>

    <OverviewStats :stats="stats" />

    <!-- DataTable -->
    <div class="rounded-xl overflow-hidden border border-gray-200">
      <DataTable
          :value="reservations"
          paginator
          :rows="10"
          :rowsPerPageOptions="[10, 20, 30]"
          showGridlines
          tableStyle="min-width: 60rem"
          :globalFilterFields="['referenceNumber', 'fullName', 'mobileNumber', 'facility', 'equipment', 'purpose', 'transactionDate', 'start_date', 'end_date']"
          v-model:filters="filters"
          :pt="{
            column: {
              headerCell: { style: 'color: #ffffff; background-color: #850038; text-align: center;' }
            }
          }"
        >
        <template #header>
          <div class="flex justify-between items-center">
            <div class="leading-tight">
              <span class="text-[20px] font-semibold text-[#850038]">All Reservation History</span>
              <p class="text-[14px] text-black">Complete history of all reservation submitted to the system</p>
            </div>

            <IconField>
              <InputIcon class="pi pi-search" />
              <InputText v-model="filters['global'].value" placeholder="Search..." />
            </IconField>
          </div>
        </template>

        <template #empty>No reservations found.</template>

        <Column field="referenceNumber" header="Reference Number"  style="min-width: 10rem" />
        <Column field="transactionDate" header="Transaction Date"  style="min-width: 10rem" />
        <Column field="fullName"        header="Full Name"         style="min-width: 10rem" />
        <Column field="mobileNumber"    header="Mobile Number"     style="min-width: 10rem" />
        <Column field="facility"        header="Facility"          style="min-width: 8rem"  />
        <Column field="equipment"       header="Equipment"         style="min-width: 8rem"  />
        <Column field="purpose"         header="Purpose"           style="min-width: 8rem"  />
        <Column field="start_date"      header="Start Date"        style="min-width: 8rem"  />
        <Column field="end_date"        header="End Date"          style="min-width: 8rem"  />

      </DataTable>
    </div>

  </AdminLayout>
</template>
<style scoped>
:deep(.p-datatable-tbody td) {
  color: #000000;
}
</style>