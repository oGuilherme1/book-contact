<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <section class="container px-4 mx-auto">
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-[#6A64F1]">
                                    <tr>
                                        <!-- Headers for desktop -->
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left text-white dark:text-white hidden lg:table-cell">
                                            Nome
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left text-white dark:text-white hidden lg:table-cell">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left text-white dark:text-white hidden lg:table-cell">
                                            Telefone
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left text-white dark:text-white hidden lg:table-cell">
                                            Imagem
                                        </th>
                                        <th scope="col" class="relative py-3.5 px-4 hidden lg:table-cell">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                        <!-- Button column, visible on all screen sizes -->
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400 hidden lg:table-cell">
                                            <button type="button" @click="openModal(null, 'create')"
                                                class="bg-white text-center w-32 rounded-2xl h-10 relative font-sans text-black text-xl font-semibold group">
                                                <div
                                                    class="bg-[#6A64F1] rounded-xl h-8 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[119px] z-10 duration-500">
                                                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12 4a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H5a1 1 0 010-2h6V5a1 1 0 011-1z"
                                                            fill="#000000" />
                                                    </svg>
                                                </div>
                                                <p class="translate-x-2">Create</p>
                                            </button>
                                        </th>
                                        <th scope="col"
                                            @click=logout()
                                            class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400 hidden lg:table-cell">
                                            <button
                                                class="flex items-center justify-center w-full transition-all duration-300 group-hover:justify-start group-hover:px-3">
                                                <svg class="w-6 h-6" viewBox="0 0 512 512" fill="white">
                                                    <path
                                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </th>
                                    </tr>
                                    <!-- Mobile header -->
                                    <tr class=" lg:hidden">
                                        <th
                                            scope="col"
                                            class="py-3.5 flex justify-between items-center px-4 text-sm font-normal text-left text-white dark:text-white bg-[#6A64F1]">

                                            Contatos

                                            <button type="button" @click="openModal(null, 'create')"
                                                class="bg-white text-center w-32 rounded-2xl h-10 relative font-sans text-black text-xl font-semibold group">
                                                <div
                                                    class="bg-[#6A64F1] rounded-xl h-8 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[119px] z-10 duration-500">
                                                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12 4a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H5a1 1 0 010-2h6V5a1 1 0 011-1z"
                                                            fill="#000000" />
                                                    </svg>
                                                </div>
                                                <p class="translate-x-2">Create</p>
                                            </button>
                                            <button
                                                type="button"
                                                @click="logout()"
                                                class="flex items-center justify-center transition-all duration-300 group-hover:justify-start group-hover:px-3">
                                                <svg class="w-6 h-6" viewBox="0 0 512 512" fill="white">
                                                    <path
                                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <ContactItem v-for="item in paginatedContacts" :contact="item"
                                        @edit="openModal(item, 'update')" @contactDeleted="deletedContact" />
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="#" @click.prevent="previousPage"
                    :class="{ 'opacity-50 cursor-not-allowed': currentPage === 1 }"
                    class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Previous</span>
                </a>

                <div class="items-center hidden md:flex gap-x-3">
                    <a v-for="page in totalPages" :key="page" @click.prevent="goToPage(page)"
                        :class="{ 'text-blue-500 bg-blue-100/60': currentPage === page, 'text-gray-500 hover:bg-gray-100': currentPage !== page }"
                        class="px-2 py-1 text-sm rounded-md dark:bg-gray-800 dark:text-gray-300">
                        {{ page }}
                    </a>
                </div>

                <a href="#" @click.prevent="nextPage"
                    :class="{ 'opacity-50 cursor-not-allowed': currentPage === totalPages }"
                    class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </section>

        <ContactForm 
            v-model:isModalOpen="isModalOpen" 
            :contact="selectedContact" 
            :mode="formMode"
            :contacts="contacts"
            v-model:formSuccess="formSuccess" 
            @contactCreated="contactCreated"
            @contactUpdated="contactUpdated"
            @contactCreatedError="contactCreatedError"

        />

        <Alert
            v-if="alertOpen"
            :title="title" 
            :paragraph="paragraph"
            @closeAlert="closeAlert"


        />

    </div>
</template>


<script lang="ts">

import Alert from '@/components/Popup/Alert.vue';
import ContactItem from '@/components/Contact/ContactItem.vue';
import ContactForm from '@/components/Contact/ContactForm.vue';
import { getAllContact, logout } from '@/service/api/axios';

export default {
    name: 'ContactTable',
    components: {
        ContactItem,
        ContactForm,
        Alert
    },
    data() {
        return {
            isModalOpen: false,
            formSuccess: false,
            selectedContact: null,
            formMode: 'create',
            contacts: [],
            currentPage: 1,
            itemsPerPage: 10,
            title: '',
            paragraph: '',
            alertOpen: false
        };
    },

    watch: {
        formSuccess(newVal) {
            if (newVal) {
                this.fetchContacts();
                this.formSuccess = false;
            }
        }
    },

    computed: {
        totalPages() {
            return Math.ceil(this.contacts.length / this.itemsPerPage);
        },
        paginatedContacts() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.contacts.slice(start, end);
        }
    },

    methods: {
        async fetchContacts() {
            try {
                this.contacts = await getAllContact();
            } catch (error) {
                console.error('Erro ao buscar contatos:', error);

            }
        },

        deletedContact() {
            this.alertOpen = true;
            this.title = 'Contato deletado com sucesso!';
            this.fetchContacts();
        },

        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },

        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },

        goToPage(page: number) {
            this.currentPage = page;
        },

        openModal(contact = null, mode = 'update') {
            this.selectedContact = contact;
            this.formMode = mode;
            this.isModalOpen = true;
        },

        contactCreated() {
            this.alertOpen = true;
            this.title = 'Contato criado com sucesso!';
            this.paragraph = '';
        },

        contactUpdated() {
            this.alertOpen = true;
            this.title = 'Contato atualizado com sucesso!';
        },

        contactCreatedError(error: string) {
            this.alertOpen = true;
            this.title = 'Error ao criar contato!';
            this.paragraph = error;
        },

        contactUpdatedError() {
            this.alertOpen = true;
            this.title = 'Error ao atualizar contato!';
        },

        closeAlert() {
            this.alertOpen = false;
        },

        async logout() {
            try {
                await logout();
                this.$router.push('/');
                
            } catch (error) {
               this.alertOpen = true;
               this.title = 'Erro ao fazer logout';
            }
            
        }
    },
    mounted() {
        this.fetchContacts();
    }
};
</script>