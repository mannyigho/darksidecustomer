<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        //return "All customers";
        $tempArray = array();
        $customerData = Storage::get("database/storage.json");
        $customers = json_decode($customerData);

        if (count($customers) >= 1) {
            $data = [
                "status" => 200,
                "data" => $customers
            ];
            return response()->json([$data, 200]);
        } else {
            return response()->json([
                "status" => 404,
                "Message" => "No records found"
            ], 404);
        }
    }


    public function store(Request $request)
    {
        // Validate Input Parameters
        $validator = Validator::make($request->all(), [
            "id" => 'required|digits:1',
            "name" => 'required|string|max:191',
            "email" => 'required|string|max:191',
            "phone" => 'required|string|max:15',
            "address" => 'required|string|max:191'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                "Message" => $validator->messages()
            ], 422);
        } else {
            // Add New Customer Record
            $tempArray = array();

            //Fetch records from storage.json file
            $response = Storage::get("database/storage.json");
            $tempArray = json_decode($response);

            $id = $request->id;
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $address = $request->address;
            $msg = "Record with ID " . $id . " already exist!";

            //Sort Array values in Descending order
            if (!empty($tempArray[0]->id)) {
                rsort($tempArray);
            }

            // Check if Id assigned to new record already exists in the DB
            if (empty($tempArray[0]->id)) {
                // ID does not exist
                $data = [
                    "id" => $id,
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone,
                    "address" => $address
                ];

                $tempArray[] = $data;
                // Store records into the storage.json file
                Storage::put("database/storage.json", json_encode($tempArray, JSON_PRETTY_PRINT));

                return response()->json([
                    "status" => 201,
                    "Message" => "New Customer Created!"
                ], 201);
            } elseif (!empty($tempArray[0]->id) && $tempArray[0]->id != $id) {

                $data = [
                    "id" => $id,
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone,
                    "address" => $address
                ];

                // Sort Array values in Ascending order
                if (!empty($tempArray[0]->id)) {
                    sort($tempArray);
                }

                $tempArray[] = $data;
                // Store records into the storage.json file
                Storage::put("database/storage.json", json_encode($tempArray, JSON_PRETTY_PRINT));

                return response()->json([
                    "status" => 201,
                    "Message" => "New customer record created!"
                ], 201);
            } else {
                // ID does exist
                return response()->json([
                    "status" => 501,
                    "Message" => $msg
                ], 501);
            }
        }
    }


    public function show($id)
    {
        // Fetch a particular record with matching ID
        $response = Storage::get("database/storage.json");
        $tempArray = json_decode($response);
        $recordCount = count($tempArray);

        if (($id < 1) || ($id > $recordCount)) {
            return response()->json([
                "status" => 404,
                "Message" => "No matching customer record found!"
            ], 404);
            //exit;
        } else {

            $recIndex = $id - 1;
            $customerRec = ((array) $tempArray[$recIndex]);

            $data = [
                "status" => 200,
                "data" => $customerRec
            ];
            return response()->json([$data, 200]);
        }
    }


    public function edit($id)
    {
        // Fetch a particular record with matching ID
        $response = Storage::get("database/storage.json");
        $tempArray = json_decode($response);
        $recordCount = count($tempArray);

        if (($id < 1) || ($id > $recordCount)) {
            return response()->json([
                "status" => 404,
                "Message" => "No matching record found!"
            ], 404);
            //exit;
        } else {

            $recIndex = $id - 1;
            $customerRec = ((array) $tempArray[$recIndex]);

            $data = [
                "status" => 200,
                "data" => $customerRec
            ];
            return response()->json([$data, 200]);
        }
    }


    public function update(Request $request, $id)
    {

        // Validate Input Parameters
        $validator = Validator::make($request->all(), [
            "name" => 'required|string|max:191',
            "email" => 'required|string|max:191',
            "phone" => 'required|string|max:15',
            "address" => 'required|string|max:191'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                "Message" => $validator->messages()
            ], 422);
        } else {

            // Update a particular record with matching ID
            $response = Storage::get("database/storage.json");
            $tempArray = json_decode($response);
            $recordCount = count($tempArray);

            if (($id < 1) || ($id > $recordCount)) {
                return response()->json([
                    "status" => 404,
                    "Message" => "No matching customer record found!"
                ], 404);
                //exit;
            } else {

                $name = $request->name;
                $email = $request->email;
                $phone = $request->phone;
                $address = $request->address;

                $data = [
                    "id" => $id,
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone,
                    "address" => $address
                ];

                $recIndex = $id - 1;

                for ($i = 0; $i < $recordCount; $i++) {
                    if ($i == $recIndex) {
                        unset($tempArray[$i]);
                        $newtempArray[] = $data;
                    } else {
                        $newtempArray[] = $tempArray[$i];
                    }
                }

                Storage::put("database/storage.json", "");
                Storage::put("database/storage.json", json_encode($newtempArray, JSON_PRETTY_PRINT));

                return response()->json([
                    "status" => 200,
                    "Message" => "Customer record updated successfully",
                    "data" => $data
                ], 200);
            }
        }
    }


    public function delete($id)
    {
        // Delete a particular customer record with matching ID
        $response = Storage::get("database/storage.json");
        $tempArray = json_decode($response, true);
        $recordCount = count($tempArray);

        if (($id < 1) || ($id > $recordCount)) {
            return response()->json([
                "status" => 404,
                "Message" => "No matching customer record found!"
            ], 404);
            //exit;
        } else {
            $recIndex = $id - 1;

            for ($i = 0; $i < $recordCount; $i++) {
                if ($i == $recIndex) {
                    unset($tempArray[$i]);
                } else {
                    $newtempArray[] = $tempArray[$i];
                }
            }

            Storage::put("database/storage.json", "");
            Storage::put("database/storage.json", json_encode($newtempArray, JSON_PRETTY_PRINT));

            return response()->json([
                "status" => 200,
                "Message" => "Customer record deleted successfully!"
            ], 200);
        }
    }
}
