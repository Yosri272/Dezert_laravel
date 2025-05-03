<template>
    <div class="form-wrapper">
      <form @submit.prevent="submitForm">
        <h2>Registration Form</h2>

        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" v-model="form.name" id="name" required />
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" v-model="form.email" id="email" required />
          <div v-if="errors.email" class="error">{{ errors.email }}</div>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" v-model="form.password" id="password" required minlength="6" />
          <div v-if="errors.password" class="error">{{ errors.password }}</div>
        </div>

        <button type="submit">🚀 Submit</button>

        <div v-if="responseMessage" :class="['response', responseSuccess ? 'success' : 'fail']">
          {{ responseMessage }}
        </div>
      </form>
    </div>
  </template>

  <script>
  import axios from 'axios';
  import Swal from 'sweetalert2';

  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: ''
        },
        errors: {},
        responseMessage: '',
        responseSuccess: false
      };
    },
    methods: {
      // This method is called when the form is submitted
      async submitForm() {
         // Reset previous errors and response messages
        this.errors = {};
        this.responseMessage = '';
        this.responseSuccess = false;
       // Validate the email format using Regex
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(this.form.email)) {
          this.errors.email = 'Invalid email format.';
          return;
        }

        try {
           // Send data to the server using axios POST
          const response = await axios.post(
            'https://wepower.wepower.host/public/api/signup',
            this.form,
            {
              headers: {
                'Content-Type': 'application/json'   // Set content type to JSON
              }
            }
          );
           // If the response is successful, show a success message
          this.responseMessage = response.data.message;
          this.responseSuccess = true;
          this.form = { name: '', email: '', password: '' };
           // Show a success popup using SweetAlert
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: this.responseMessage,
            confirmButtonText: 'OK'
          });
        
        } catch (error) {
           // Handle errors if the request fails
          if (error.response && error.response.data && error.response.data.errors) {
            const serverErrors = error.response.data.errors;
            if (serverErrors.email) {
              this.errors.email = serverErrors.email[0];
            }
            if (serverErrors.password) {
              this.errors.password = serverErrors.password[0];
            }
          } else {
            this.responseMessage = 'An unexpected error occurred.';
          }
        // Show a errors popup using SweetAlert
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: this.responseMessage || 'Please check the form and try again.',
            confirmButtonText: 'OK'
          });
        }
      }
    }
  };
  </script>

  <style scoped>

  /* (All styles remain the same) */
  body {
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #e0f7fa, #ffffff);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Arial', sans-serif;
  }

  .form-wrapper {
    width: 100%;
    max-width: 500px;
    background: #ffffff;
    border-radius: 16px;
    padding: 40px 30px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    direction: ltr;
    text-align: left;
  }

  h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #00695c;
    font-size: 24px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
  }

  input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 15px;
    transition: 0.3s;
  }

  input:focus {
    border-color: #00796b;
    box-shadow: 0 0 6px rgba(0, 121, 107, 0.3);
    outline: none;
  }

  button {
    width: 100%;
    background: linear-gradient(to left, #00796b, #26a69a);
    color: #fff;
    border: none;
    padding: 14px;
    font-size: 16px;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s ease;
    font-weight: bold;
  }

  button:hover {
    background: linear-gradient(to left, #004d40, #009688);
  }

  .error {
    color: #d32f2f;
    font-size: 13px;
    margin-top: 5px;
  }

  .response {
    margin-top: 20px;
    padding: 10px;
    text-align: center;
    border-radius: 10px;
    font-weight: bold;
  }

  .response.success {
    background-color: #e0f2f1;
    color: #004d40;
    border: 1px solid #4db6ac;
  }

  .response.fail {
    background-color: #ffebee;
    color: #b71c1c;
    border: 1px solid #ef5350;
  }
  </style>
