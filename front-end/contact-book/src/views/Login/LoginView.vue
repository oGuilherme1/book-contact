<template>
  <div class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- Fundo escuro com desfoque -->
    <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeModal"></div>

    <!-- Modal centralizado -->
    <div class="relative z-10 mx-auto w-full max-w-lg sm:max-w-md xs:max-w-xs bg-white rounded-lg shadow-lg">
      <form @submit.prevent="handleSubmit" class="py-6 px-9">
        <!-- Email -->
        <div class="mb-5">
          <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
            Email
          </label>
          <input type="email" v-model="form.email" id="email" placeholder="example@domain.com"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
          <p v-if="errors.email" class="text-red-500 text-sm mt-2">{{ errors.email }}</p>
        </div>

        <!-- Senha -->
        <div class="mb-5">
          <label for="password" class="mb-3 block text-base font-medium text-[#07074D]">
            Senha
          </label>
          <input type="password" v-model="form.password" id="password" placeholder="********"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
          <p v-if="errors.password" class="text-red-500 text-sm mt-2">{{ errors.password }}</p>
        </div>

        <!-- Botão de Envio -->
        <div>
          <button type="submit"
            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
            Entrar
          </button>
        </div>

        <!-- Mensagem sobre registro -->
        <div class="mt-4 text-center text-base font-medium text-[#6B7280]">
          <p>
            Ainda não tem uma conta?
            <a href="/register" class="text-[#6A64F1] hover:underline">Crie uma aqui</a>
          </p>
        </div>
      </form>
    </div>
  </div>
  <Alert v-if="openAlert" :title="title" :paragraph="paragraph" @closeAlert="closeModal"/>
</template>

<script>
import { login } from '@/service/api/axios';
import Alert from '@/components/Popup/Alert.vue';
export default {
  name: 'LoginView',
  components: {
    Alert
  },
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      errors: {
        email: '',
        password: ''
      },
      openAlert: false,
      title: '',
      paragraph: ''
    };
  },
  methods: {
    async handleSubmit() {
      // Resetar erros
      this.errors = { email: '', password: '' };

      let valid = true;

      if (!this.form.email) {
        this.errors.email = 'Email é obrigatório.';
        valid = false;
      }

      if (!this.form.password) {
        this.errors.password = 'Senha é obrigatória.';
        valid = false;
      }

      if(this.form.password.length < 8) {
        this.errors.password = 'Senha deve ter pelo menos 8 caracteres.';
        valid = false;
      }

      if (!valid) {
        console.log('error:', this.errors);
        return;
      }

      const formData = new FormData();
      formData.append('email', this.form.email);
      formData.append('password', this.form.password);

      try {
        // Exemplo de chamada de API
        await login(formData);
        this.$router.push('/contact');
      } catch (error) {
        console.error('Erro:', error);
        this.title = 'Erro';
        this.paragraph = 'Erro ao fazer login. Tente novamente.';
        this.errors.general = 'Erro ao fazer login. Tente novamente.';
      }
    },

    closeModal() {
      this.openAlert = false;
    }
  }
}
</script>

<style scoped>
/* Ajuste para tamanhos de tela */
@media (max-width: 640px) {
  .max-w-lg {
    max-width: 90%;
  }
}

@media (max-width: 480px) {
  .max-w-md {
    max-width: 85%;
  }
}
</style>