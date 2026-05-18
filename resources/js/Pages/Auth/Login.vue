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

<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center p-[18px] sm:p-[26px]">
    <div class="flex flex-col sm:flex-row w-full max-w-[880px] rounded-[22px] overflow-hidden shadow-md border border-gray-200">

      <!-- Left panel -->
      <div
        class="flex flex-col items-center justify-center gap-[18px] sm:gap-[26px] px-[26px] py-[35px] sm:px-[35px] sm:py-[52px] lg:px-[44px] lg:py-[61px] w-full sm:w-5/12 lg:w-6/12"
        style="background-color: #850038;"
      >
        <div class="flex items-center justify-center overflow-hidden w-[106px] sm:w-[123px] lg:w-auto">
          <img src="/images/up-cebu.png" alt="UP Logo" class="w-full h-auto" />
        </div>
        <p class="font-inter text-white/90 text-[17.6px] sm:text-[19.8px] lg:text-[17.6px] text-center leading-relaxed">
          University of the Philippines Cebu<br class="hidden sm:block" />
          Room and Equipment Reservation
        </p>
      </div>

      <!-- Right panel -->
      <div class="flex flex-col justify-center gap-[22px] sm:gap-[26px] px-[26px] py-[35px] sm:px-[44px] sm:py-[52px] lg:px-[88px] lg:py-[61px] bg-white flex-1">

        <div>
          <FloatLabel variant="on" class="w-full">
            <InputText
              id="email"
              v-model="form.email"
              type="email"
              class="w-full text-[15.4px]"
            />
            <label for="email">Email</label>
          </FloatLabel>
          <small class="text-red-500 text-[13.2px]">{{ form.errors.email }}</small>
        </div>

        <div>
          <FloatLabel variant="on" class="w-full">
            <Password
              id="password"
              v-model="form.password"
              :feedback="false"
              toggleMask
              class="w-full text-[15.4px]"
              inputClass="w-full"
            />
            <label for="password">Password</label>
          </FloatLabel>
          <small class="text-red-500 text-[13.2px]">{{ form.errors.password }}</small>
        </div>

        <Button
          type="submit"
          label="Log In"
          :loading="form.processing"
          class="w-full font-medium text-[15.4px] py-[14px]"
          style="background-color: #850038; border-color: #850038; border-radius: 26px !important;"
          @click="submit"
        />
      </div>

    </div>
  </div>
</template>