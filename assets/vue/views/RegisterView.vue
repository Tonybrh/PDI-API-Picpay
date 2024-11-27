<script setup>
import axios from 'axios';
import { ref } from 'vue';
import {useRouter} from "vue-router";
import ToastComponent from "../components/ToastComponent.vue";

const router = useRouter();
const email = ref('');
const password = ref('');
const username = ref('');
const userType = ref('');
const cpfCnpj = ref('');
const showModal = ref(false);
const token = localStorage.getItem('auth_token');

const handleSubmit = async (submitEvent) => {
  submitEvent.preventDefault();
  showModal.value = true;
  const data = {
    name: username.value,
    email: email.value,
    password: password.value,
    cpfCnpj: cpfCnpj.value,
    userType: parseInt(userType.value),
  };
  try {

    // const response = await axios.post('http://localhost:8005/api/user/post', data);
    //
    // console.log('Resposta:', response);
    //
    // setTimeout(async () => {
    //   await router.push('/login');
    // }, 3000);
  } catch (error) {
    console.error('Erro:', error.response);
  }

};

</script>

<template>
  <div class="container">
    <div class="leftLoginDiv">
      <h2>Sistema de transações</h2>
      <h3>Cadastre-se para começar a usar o sistema</h3>
    </div>
    <div class="rightLoginDiv">
      <form class="loginForm" @submit="handleSubmit">
        <div class="inputDiv">
          <label for="username">Nome</label>
          <input v-model="username" class="textInput" type="text" placeholder="Digite seu nome" id="username"/>
        </div>
        <div class="inputDiv">
          <label for="email">Email</label>
          <input v-model="email" class="textInput" type="email" placeholder="Digite seu email" id="email"/>
        </div>
        <div class="inputDiv">
          <label for="password">Senha</label>
          <input v-model="password" class="textInput" type="password" placeholder="Digite sua senha" id="password"/>
        </div>
        <div class="inputDiv">
          <label for="cpfCnpj">Cpf-cnpj</label>
          <input v-model="cpfCnpj" class="textInput" type="text" placeholder="Digite sua senha" id="cpfCnpj"/>
        </div>
        <div class="inputDiv">
          <span>Tipo de usuário</span>
          <div>
            <input class="inputRadio" v-model="userType" type="radio" id="userCommon" value="2" name="userTYpe"/>
            <label for="userCommon">Comum</label>
          </div>
          <div>
            <input class="inputRadio" v-model="userType" type="radio" id="userShopman" value="1" name="userTYpe"/>
            <label for="userShopman">Lojista</label>
          </div>
        </div>
        <input class="submitInput" type="submit" value="Enviar"/><br>
        <RouterLink class="registerLink" to="/login">Já está cadastrado ?</RouterLink>
      </form>
      <ToastComponent
          :showModal="showModal"
          message="Usuário cadastrado com sucesso !"
      />
    </div>
  </div>
</template>

<style scoped>
.inputDiv{
  display: flex;
  flex-direction: column;
  align-items: start;
  margin-top: 20px;
  gap: 5px;
}
.textInput {
  border: 1px solid #555555;
  height: 30px;
  font-size: 16px;
  border-radius: 5px;
  background-color: transparent;
  padding-left: 10px;
  width: 250px;
}
.loginForm {
  text-align: center;
}
.submitInput {
  margin-top: 20px;
  width: 250px;
  background-color: #5ca4a9;
  border: 0;
  color: white;
  border-radius: 5px;
  height: 30px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  margin-bottom: 10px;
}
.leftLoginDiv {
  display: flex;
  flex-direction: column;
  background-color: #5ca4a9;
  justify-content: center;
  align-items: center;
  height: 100%;
  width: 50%;
  color: white;
}
.rightLoginDiv{
  flex-direction: column;
  justify-content: center;
  align-items: center;
  display: flex;
  background-color: #e6ebe0;
  width: 50%;
  height: 100%;
}
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.registerLink {
  color: black;
}
.inputRadio {
  margin-right: 20px;
}
</style>
