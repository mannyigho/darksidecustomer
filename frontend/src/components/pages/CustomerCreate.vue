<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <h1><center>Add Customer</center></h1>
            <div class="alert alert-warning mt-4" v-if="errors.length" style="">
                <ul class="mb-0">
                    <li v-for="(error, index) in errors" :key="index">
                        {{ error }}
                    </li>
                </ul>
            </div>
            <form class="mx-auto" style="" @submit.prevent="saveCustomer" novalidate>
                <fieldset>
                    <div class="form-group">
                        <label class="form-label mt-4">NAME</label>
                        <input type="text" class="form-control" v-model="customer.name" placeholder="Enter customer name">
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-4">EMAIL</label>
                        <input type="email" class="form-control" v-model="customer.email" placeholder="Enter customer email">
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-4">PHONE</label>
                        <input type="text" class="form-control" v-model="customer.phone" placeholder="Enter customer phone">
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-4">ADDRESS</label>
                        <input type="text" class="form-control" v-model="customer.address" placeholder="Enter customer address">
                    </div>
                    <button class="btn btn-primary mt-4">Save Customer</button>
                </fieldset>
            </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default{
    name: 'CustomerCreate',
    data(){
        return {
            customer: {},
            name: '',
            email: '',
            phone: '',
            address: '',
            errors: []
        }
    },
    methods: {
        async saveCustomer() {
            this.errors = [];
            if(!this.customer.name){
                this.errors.push("Name field is required!");
            }
            if(!this.customer.email){
                this.errors.push("Email field is required!");
            }
            if(!this.customer.phone){
                this.errors.push("Phone field is required!");
            }
            if(!this.customer.address){
                this.errors.push("Address field is required!");
            }

            if(!this.errors.length){

                let url = "http://localhost:8001/api/customer";
                let formData = new FormData();
                formData.append('name', this.customer.name);
                formData.append('email', this.customer.email);
                formData.append('phone', this.customer.phone);
                formData.append('address', this.customer.address);
                
                await axios.post(url, formData).then((response) =>{
                    if(response.status == 201){
                        this.customer.name = '';
                        this.customer.email = '';
                        this.customer.phone = '';
                        this.customer.address = '';
                        alert(response.data.Message);
                    }else{
                        console.log('Error');
                    }
                }).catch((error) =>{
                    this.errors.push(error.response);
                });
            }
        }
    }
}
</script>