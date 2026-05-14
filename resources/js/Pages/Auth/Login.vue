<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4 sm:p-6">
    <div class="flex flex-col sm:flex-row w-full max-w-3xl rounded-2xl overflow-hidden shadow-md border border-gray-200">

      <!-- Left panel -->
      <div
        class="flex flex-col items-center justify-center gap-4 sm:gap-6 px-6 py-8 sm:px-8 sm:py-12 lg:px-10 lg:py-14 w-full sm:w-5/12 lg:w-6/12"
        style="background-color: #850038;"
      >
        <div class="flex items-center justify-center overflow-hidden w-24 sm:w-28 lg:w-auto">
          <img src="/images/up-cebu.png" alt="UP Logo" class="w-full h-auto" />
        </div>
        <p class="font-inter text-white/90 text-base sm:text-lg lg:text-[16px] text-center leading-relaxed">
          University of the Philippines Cebu<br class="hidden sm:block" />
          Room and Equipment Reservation
        </p>
      </div>

      <!-- Right panel -->
      <div class="flex flex-col justify-center gap-5 sm:gap-6 px-6 py-8 sm:px-10 sm:py-12 lg:px-20 lg:py-14 bg-white flex-1">

        <div>
          <FloatLabel variant="on" class="w-full">
            <InputText
              id="email"
              v-model="form.email"
              type="email"
              class="w-full"
            />
            <label for="email">Email</label>
          </FloatLabel>
          <small class="text-red-500 text-xs">{{ form.errors.email }}</small>
        </div>

        <div>
          <FloatLabel variant="on" class="w-full">
            <Password
              id="password"
              v-model="form.password"
              :feedback="false"
              toggleMask
              class="w-full"
              inputClass="w-full"
            />
            <label for="password">Password</label>
          </FloatLabel>
          <small class="text-red-500 text-xs">{{ form.errors.password }}</small>
        </div>

        <Button
          type="submit"
          label="Log In"
          :loading="form.processing"
          class="w-full rounded-[24px] font-medium"
          style="background-color: #850038; border-color: #850038; border-radius: 24px !important;"
          @click="submit"
        />
      </div>

    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'
import Button from 'primevue/button'
import FloatLabel from 'primevue/floatlabel'

const form = useForm({
  email: '',
  password: '',
})

const submit = () => {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  })
}
</script>