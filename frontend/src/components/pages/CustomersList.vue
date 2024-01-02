<template>
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1>Darkside Customers</h1>
        <table class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody v-for="customer in customers" :key="customer.id">
                <tr class="table-primary">
                    <td scope="row">{{ customer.id }}</td>
                    <td scope="row">{{ customer.name }}</td>
                    <td scope="row">{{ customer.email }}</td>
                    <td scope="row">{{ customer.phone }}</td>
                    <td scope="row">{{ customer.address }}</td>
                    <td scope="row">
                        <router-link class="btn btn-xs btn-secondary" :to="{name: 'CustomerEdit', params: {id: customer.id}}">Edit</router-link>&nbsp;&nbsp;
                        <button class="btn btn-xs btn-danger" @click.prevent="deleteCustomer(customer.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
</template>

<script>
import axios from 'axios';
export default{
    name: 'CustomerList',
    data() {
        return {
            customers:Array,
        }
    },
    created() {
        this.getCustomers();
    },
    methods: {
        async getCustomers() {
            let url = 'http://localhost:8001/api/customers';
            await axios.get(url).then(response =>{
                this.customers = response.data[0].data;
                //console.log(this.customers);
            }).catch(error => {
                console.log(error);
            });
        },
        async deleteCustomer(id){
            let url = `http://localhost:8001/api/customer/${id}/delete`;
            await axios.delete(url).then((response) => {
                console.log(response);
                if(response.status == 200) {
                    alert(response.data.Message);
                    this.getCustomers();
                }
            }).catch(error => {
                console.log(error);
            });
        }
    },
    mounted() {
       
    }
}
</script>