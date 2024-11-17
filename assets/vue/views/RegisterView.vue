<script setup>
import axios from 'axios';
import { ref } from 'vue';
import {useRouter} from "vue-router";

const router = useRouter();
const email = ref('');
const password = ref('');
const token = localStorage.getItem('auth_token');

const handleSubmit = async (submitEvent) => {
  submitEvent.preventDefault();
  const data = {
    username: email.value,
    password: password.value,
  };

  try {
    const response = await axios.post('http://localhost:8005/api/login_check',data,
        {
          headers: {
            'Content-Type': 'application/json'
          }
        }
    );
    localStorage.setItem('auth_token', response.data.token);
    await router.push('/');

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
          <label for="email">Email</label>
          <input v-model="email" class="textInput" type="email" placeholder="Digite seu email" id="email"/>
        </div>
        <div class="inputDiv">
          <label for="password">Senha</label>
          <input v-model="password" class="textInput" type="password" placeholder="Digite sua senha" id="password"/>
        </div>
        <input class="submitInput" type="submit" value="Enviar"/><br>
        <RouterLink class="registerLink" to="/register">Ainda não fez seu cadastro ?</RouterLink>
      </form>
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
</style>
