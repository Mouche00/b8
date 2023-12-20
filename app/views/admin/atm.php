<?php

    // require(__DIR__ ."/../../controllers/atm.php");
    require("components/check.php");

?>

<!DOCTYPE html>
<html lang="en">

<!--  HEAD  -->
<head>
    <?php include("components/head.html") ?>
    <title>Banks</title>
</head>
<!--  HEAD  -->

<body class="h-[100vh] w-full flex">

    <!--  SIDEBAR  -->
    <aside class="h-full w-16 py-4 bg-black flex flex-col justify-between text-white">
        <section class="w-[100%] mx-auto mb-10">
            <img class="w-[80%] mx-auto" src="../public/assets/images/logo-white.png" alt="">
            <!-- <h1 class="logo-text text-3xl text-center">Yamaguchi-gumi Bank</h1> -->
        </section>
        <!-- <h1 class="text-4xl text-center">··········</h1> -->
        <section class="w-full mx-auto my-10">
            <div class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
                <a href="bank.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                    <i class="fa-solid fa-yen-sign text-3xl"></i>
                    <!-- <h2 class="text-2xl font-extrabold">BANKS</h2> -->
                </a>
            </div>
            <div class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
                <a href="agency.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                    <i class="fa-solid fa-building text-3xl"></i>
                    <!-- <h2 class="text-2xl font-extrabold">AGENCIES</h2> -->
                </a>
            </div>
            <div class="w-full h-14 transition delay-100 text-black bg-white">
                <a href="#" class="w-[75%] h-full mx-auto flex justify-center items-center">
                    <i class="fa-solid fa-gears text-3xl"></i>
                    <!-- <h2 class="text-2xl font-extrabold">ATMS</h2> -->
                </a>
            </div>
            <div class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
                <a href="user.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                    <i class="fa-solid fa-person text-3xl"></i>
                    <!-- <h2 class="text-2xl font-extrabold">USERS</h2> -->
                </a>
            </div>
            <div class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
                <a href="account.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                    <i class="fa-solid fa-book text-3xl"></i>
                    <!-- <h2 class="text-2xl font-extrabold">ACCOUNTS</h2> -->
                </a>
            </div>
            <div class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
                <a href="transaction.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                    <i class="fa-solid fa-arrow-right-arrow-left text-3xl"></i>
                    <!-- <h2 class="text-2xl font-extrabold">TRANSACTIONS</h2> -->
                </a>
            </div>
        </section>
        <!-- <h1 class="text-4xl text-center">··········</h1> -->
        <section class="w-full mx-auto mt-10">
            <div class="w-[75%] h-12 mx-auto text-black bg-white rounded-lg">
                <a href="../app/controllers/login.php?delete=1" class="w-[75%] h-full mx-auto flex justify-center items-center">
                    <!-- <h2 class="text-2xl font-extrabold mx-auto">LOGOUT</h2> -->
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </div>
        </section>
    </aside>
    <!--  SIDEBAR  -->

    <!-- OVERLAY -->
    <div id="overlay" class="bg-black w-full h-[100vh] opacity-0 z-[-1] absolute transition ease-in-out delay-15"></div>
    <!-- OVERLAY -->

    <!-- FORM -->
    <section id="form-wrapper" class="h-[20vh] w-[30%] m-auto bg-white rounded flex justify-center items-center absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] z-20 scale-0 transition ease-in-out delay-15">
        <form id="add-form" action="" method="post" class="w-[80%] h-[90%] flex flex-col justify-evenly" autocomplete="off" enctype="multipart/form-data">
            <div class="flex justify-between">
                <div class="w-[45%] flex flex-col justify-evenly">
                    <label>longitude:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="longitude" id="longitude">
                </div>
                <div class="w-[45%] flex flex-col">
                    <label>latitude:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="latitude" id="latitude">
                </div>
            </div>
            <div class="flex justify-between">
                <div class="w-[45%] flex flex-col">
                    <label>Address:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="address" id="address">
                </div>
                <div class="w-[45%] flex flex-col">
                    <label>Bank:</label>
                    <select class="bg-gray-300 rounded p-1" name="bank_id" id="bank_id"></select>
                    <!-- waaaaaa rayane select hna  -->
                </div>
            </div>
            <div class="flex flex-col">
                <!-- <button id="edit" class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="button">SUBMIT</button>
                <button id="submit" class="w-[30%] rounded m-auto bg-green-500 text-white p-1" type="button">SUBMIT</button> -->
                <input id="submit" type="submit" value="SUBMIT">
            </div>
        </form>
        
        <form id="edit-form" action="" method="post" class="w-[80%] h-[90%] flex flex-col justify-evenly" autocomplete="off" enctype="multipart/form-data">
            <div class="flex justify-between">
                <input class="bg-gray-300 rounded p-1" type="hidden" name="id" id="edit-id">
                <div class="w-[45%] flex flex-col justify-evenly">
                    <label>longitude:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="longitude" id="edit-longitude">
                </div>
                <div class="w-[45%] flex flex-col">
                    <label>latitude:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="latitude" id="edit-latitude">
                </div>
                </div>
            <div class="flex justify-between">

                <div class="w-[45%] flex flex-col justify-evenly">
                    <label>Address:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="address" id="edit-address">
                </div>
                <div class="w-[45%] flex flex-col">
                    <label>Bank:</label>
                    <input class="bg-gray-300 rounded p-1" type="text" name="bank_id" id="edit-bank_id">
                    <!-- waaaaaa rayane select hna  -->
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

    <main class="w-[85%]">

        <!--  HEADER  -->
            <?php include("components/header.html") ?>
        <!--  HEADER  -->
        <section class="w-full h-[90%] bg-gray-200 flex justify-center items-center">
            <button id="add" type="button" class="w-14 h-[80%] bg-black text-white text-center rounded-l-lg">
                <i class="fa-solid fa-plus"></i>
            </button>
            <div class="w-[80%] h-[80%] bg-white rounded-r-lg p-8">
                <table id="table" class="w-[90%] mx-auto text-center py-4 cell-border">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="border-2 border-black">longitude</th>
                            <th class="border-2 border-black">latitude</th>
                            <th class="border-2 border-black">Address</th>
                            <th class="border-2 border-black">Bank</th>
                            <th class="border-2 border-black">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </main>
</body>
<script src="../public/assets/javascript/main.js"></script>
<script src="../public/assets/javascript/atm.js"></script>
</html>