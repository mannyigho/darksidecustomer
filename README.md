# darksidecustomer
darksidecustomer

## Description

This is a very simple and basic CRUD application that utilizes the PHP Laravel framework for backend functionality  and Vue JS 3 for frontend functionality. The APP provides the user with the ability to create a new customer, update a customer record, delete a customer record and view all customers records in a single view.

## Project Structure

The backend implementation involves the following:
A "storage.json" file that is located inside the "storage/app/database/" folder. This file serves as the database for this APP
A "CustomerController.php" file that is located inside the "app/Http/Controllers/Api/" folder. This "CustomerController.php" file holds the entire codes that performs the CRUD operations at the backend
An "api.php" file that contains all our backend routes e.g.

Route::get('customers', [CustomerController::class, 'index']);
Route::post('customer', [CustomerController::class, 'store']);
Route::get('customer/{id}', [CustomerController::class, 'show']);
Route::get('customer/{id}/edit', [CustomerController::class, 'edit']);
Route::post('customer/{id}/edit', [CustomerController::class, 'update']);
Route::delete('customer/{id}/delete', [CustomerController::class, 'delete']);

The frontend implementation involves the following:
A "Header.vue" file for displaying the APP page header
A "CustomerList.vue" file for listing all customers records
A "CustomerCreate.vue" file for creating a new customer
A "CustomerEdit.vue" file for updating a customer record
All these files can be accessed inside the "src/components/pages/" folder inside the frontend folder
A "routes.js" file for managing our routes for the APP. This file is located inside the "src/routes/" folder e.g.

import CustomersList from '../components/pages/CustomersList';
import CustomerCreate from '../components/pages/CustomerCreate';
import CustomerEdit from '../components/pages/CustomerEdit';
import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
    {
        name: 'CustomersList',
        path: '/customers',
        component: CustomersList
    },
    {
        name: 'CustomerCreate',
        path: '/create',
        component: CustomerCreate
    },
    {
        name: 'CustomerEdit',
        path: '/edit/:id?',
        component: CustomerEdit
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

export default router;

The routes.js file is then imported in the main.js file and used while loading the app e.g.

import { createApp } from 'vue'
import App from './App.vue'
import routes from './routes/routes'

createApp(App).use(routes).mount('#app')


## Technology Choices

Backend - PHP and Laravel Framework Version 9 for developing the backend APIs, JSON file as the storage media for the records
Frontend - View JS Version 3.2.13, Vue Router Version 4.0.13, Axios Version 1.6.3, Bootstrap CSS, Bootstrap Javascript for developing the frontend forms

## Installation
To install the project into your Linux box, copy the darksidecustomer folder into your "/var/www/html" folder, where all PHP files are served

## Usage

Open a terminal and navigate into the backend folder, which is inside the darksidecustomer folder
To start the backend App, inside the Terminal, type "php artisan server --port=8001"
To confirm your backend App is running, open a browser and type "http://localhost:8001/api/customers" to view all the Darkside customers records
Open another terminal and navigate into the frontend folder, which is inside the darksidecustomer folder
To start the frontend App, inside the Terminal, type "npm run serve"
To confirm your frontend App is running, open another browser and type "http://localhost:8080/#/customers" to view all Darkside customers records
On the frontend App, there are two (2) links: "All Customers" and "Add Customer"
The "All Customers" link enables you to view the details of all Darkside customers, with ability to "Edit" and "Delete" a customers record
The "Add Customer" link enables you to add a new customer details to the Darkside customers list