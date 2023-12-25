<?php

    // require(__DIR__ ."/../../controllers/agency.php");
    require("components/check.php");

?>

<!DOCTYPE html>
<html lang="en">

<!--  HEAD  -->
<head>
    <?php include("components/head.php") ?>
    <title>Agencies</title>
</head>
<!--  HEAD  -->

<body class="h-[100vh] w-full flex">

    <!--  SIDEBAR  -->
    <?php include("components/sidebar.php") ?>
    <!--  SIDEBAR  -->

    <!-- OVERLAY -->
    <div id="overlay" class="bg-black w-full h-[100vh] opacity-0 z-[-1] absolute transition ease-in-out delay-15"></div>
    <!-- OVERLAY -->

    <!-- FORM -->
    <section id="form-wrapper" class="h-[50vh] w-[30%] m-auto bg-white rounded flex justify-center items-center absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] z-20 scale-0 transition ease-in-out delay-15">
        <form id="add-form" action="" method="post" class="w-[80%] h-[90%] flex flex-col justify-evenly" autocomplete="off" enctype="multipart/form-data">
            <div class="flex justify-between">
                <div class="w-[45%] flex flex-col justify-evenly">
                    <label>Longitude:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="longitude" id="longitude">
                </div>
                <div class="w-[45%] flex flex-col">
                    <label>Latitude:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="latitude" id="latitude">
                </div>
            </div>
            <div class="flex justify-between">
                <div class="w-[32%] flex flex-col justify-evenly">
                    <label>City:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="city" id="city">
                </div>
                <div class="w-[32%] flex flex-col">
                    <label>District:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="district" id="district">
                </div>
                <div class="w-[32%] flex flex-col">
                    <label>Street:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="street" id="street">
                </div>
            </div>
            <div class="flex justify-between">
                <div class="w-[32%] flex flex-col justify-evenly">
                    <label>Postal Code:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="postal-code" id="postal-code">
                </div>
                <div class="w-[32%] flex flex-col">
                    <label>Email:</label>
                    <input class="bg-gray-300 rounded p-1" type="email" name="email" id="email">
                </div>
                <div class="w-[32%] flex flex-col">
                    <label>Telephone:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="telephone" id="telephone">
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="w-[100%] flex flex-col">
                    <label>Bank:</label>
                    <select class="bg-gray-300 rounded p-1" name="bank_id" id="bank_id">
                        <!-- <option id="admin" value="admin">admin</option>
                        <option id="client" value="client">client</option> -->
                    </select>
                </div>
            </div>
            <div class="flex flex-col">
                <!-- <button id="edit" class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="button">SUBMIT</button>
                <button id="submit" class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="button">SUBMIT</button> -->
                <input id="submit" type="submit" value="SUBMIT">
            </div>
        </form>
        
        <form id="edit-form" action="" method="post" class="w-[80%] h-[90%] flex flex-col justify-evenly" autocomplete="off" enctype="multipart/form-data">
            <input class="bg-gray-300 rounded p-1" type="hidden" name="id" id="id">
            <div class="flex justify-between">
                <div class="w-[45%] flex flex-col justify-evenly">
                    <label>Nationality:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="longitude" id="longitude">
                </div>
                <div class="w-[45%] flex flex-col">
                    <label>Latitude:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="latitude" id="latitude">
                </div>
            </div>
            <div class="flex justify-between">
                <div class="w-[32%] flex flex-col justify-evenly">
                    <label>City:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="city" id="city">
                </div>
                <div class="w-[32%] flex flex-col">
                    <label>District:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="district" id="district">
                </div>
                <div class="w-[32%] flex flex-col">
                    <label>Street:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="street" id="street">
                </div>
            </div>
            <div class="flex justify-between">
                <div class="w-[32%] flex flex-col justify-evenly">
                    <label>Postal Code:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="postal-code" id="postal-code">
                </div>
                <div class="w-[32%] flex flex-col">
                    <label>Email:</label>
                    <input class="bg-gray-300 rounded p-1" type="email" name="email" id="email">
                </div>
                <div class="w-[32%] flex flex-col">
                    <label>Telephone:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="telephone" id="telephone">
                </div>
            </div>
            <div class="flex justify-between">
                <div class="w-[100%] flex flex-col justify-evenly">
                    <label>Bank:</label>
                    <select class="bg-gray-300 rounded p-1" name="bank_id" id="bank_id">
                        <!-- <option value="1">1</option> -->
                    </select>
                </div>
            </div>
            <div class="flex flex-col">
                <!-- <button id="edit" class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="button">SUBMIT</button>
                <button id="submit" class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="button">SUBMIT</button> -->
                <input id="submit" type="submit" value="EDIT">
            </div>
        </form>
    </section>
    <!-- FORM -->

    <main class="w-[100%]">

        <!--  HEADER  -->
            <?php include("components/header.html") ?>
        <!--  HEADER  -->
        <section class="w-full h-[90%] bg-gray-200 flex justify-center items-center">
            <button id="add" type="button" class="w-14 h-[70%] bg-black text-white text-center rounded-l-lg">
                <i class="fa-solid fa-plus"></i>
            </button>
            <div class="w-[80%] h-[70%] bg-white rounded-r-lg p-8">
                <table id="table" class="w-[90%] mx-auto text-center py-4 cell-border">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="border-2 border-black">ID</th>
                            <th class="border-2 border-black">longitude</th>
                            <th class="border-2 border-black">latitude</th>
                            <th class="border-2 border-black">Bank</th>
                            <th class="border-2 border-black">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </main>
</body>
<script src="<?= URLROOT . 'public/assets/javascript/main.js'?>"></script>
<script src="<?= URLROOT . 'public/assets/javascript/agency.js'?>"></script>
</html>