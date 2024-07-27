<template>
  <div class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- Fundo escuro com desfoque -->
    <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeModal"></div>

    <!-- Modal centralizado -->
    <div class="relative z-10 mx-auto w-full max-w-lg sm:max-w-md xs:max-w-xs bg-white rounded-lg shadow-lg">
      <form @submit.prevent="handleSubmit" class="py-6 px-9">
        <!-- Nome -->
        <div class="mb-5">
          <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
            Nome
          </label>
          <input type="text" v-model="form.name" id="name" placeholder="Seu nome"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
          <p v-if="errors.name" class="text-red-500 text-sm mt-2">{{ errors.name }}</p>
        </div>

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
          <input type="password" v-model="form.password" id="password" placeholder="********" min="8"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
          <p v-if="errors.password" class="text-red-500 text-sm mt-2">{{ errors.password }}</p>
        </div>

        <!-- Botão de Envio -->
        <div>
          <button type="submit"
            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
            Registrar
          </button>
        </div>

        <!-- Mensagem sobre login -->
        <div class="mt-4 text-center text-base font-medium text-[#6B7280]">
          <p>
            Já tem uma conta?
            <a href="/" class="text-[#6A64F1] hover:underline">Faça login aqui</a>
          </p>
        </div>
      </form>
    </div>
  </div>
  <Alert v-if="openAlert" :title="title" :paragraph="paragraph" @closeAlert="closeModal"/>
</template>



<script>
import { register } from '@/service/api/axios';
import Alert from '@/components/Popup/Alert.vue';
export default {
  name: 'RegisterView',
  components: {
    Alert
  },
  data() {
    
    return {
      form: {
        name: '',
        email: '',
        password: ''
      },
      errors: {
        name: '',
        email: '',
        password: ''
      },
      openAlert: false,
      title: '',
      paragraph: '',

    };
  },
  methods: {
    async handleSubmit() {
      // Resetar erros
      this.errors = { name: '', email: '', password: '' };

      let valid = true;

      if (!this.form.name) {
        this.errors.name = 'Nome é obrigatório.';
        valid = false;
      }

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
      formData.append('name', this.form.name);
      formData.append('email', this.form.email);
      formData.append('password', this.form.password);

      // Aqui você pode adicionar a lógica para registro, por exemplo, chamar uma API.
      try {
        // Exemplo de chamada de API
        await register(formData);
        this.$emit('registerSuccess');
        this.openAlert = true;
        this.title = 'Usuário registrado com sucesso';
        this.form = {...this.getDefaultForm()};
        
      } catch (error) {
        console.error('Erro:', error);
        this.openAlert = true;
        this.title = 'Erro ao registrar. Tente novamente.';
        this.paragraph = 'Este email ja está registrado.'
      }
    },

    closeModal() {
      this.openAlert = false;
    },

    getDefaultForm() {
      return {
        name: '',
        email: '',
        password: ''
      };
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