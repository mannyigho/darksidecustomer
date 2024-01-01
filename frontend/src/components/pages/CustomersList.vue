<template>
    <div class="container">
        <h1>Darkside Customers</h1>
        <table class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">ADDRESS</th>
                </tr>
            </thead>
            <tbody v-for="customer in customers" :key="customer.id">
                <tr class="table-primary">
                    <td scope="row">{{ customer.id }}</td>
                    <td scope="row">{{ customer.name }}</td>
                    <td scope="row">{{ customer.email }}</td>
                    <td scope="row">{{ customer.phone }}</td>
                    <td scope="row">{{ customer.address }}</td>
                </tr>
            </tbody>
        </table>
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
        }
    },
    mounted() {
        //console.log("Customers list component mounted");
    }
}
</script>