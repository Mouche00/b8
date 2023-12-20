<?php

    // require(__DIR__ ."/../../controllers/account.php");
    require(__DIR__ ."/../../models/user.php");
    require(__DIR__ ."/../../models/account.php");
    require("components/check.php");

    $user = new User();
    $account = new Account();

    $currentUser = $user->getId($_SESSION['username']);

    $id = $currentUser['id'];

    $accounts = $account->displayFromUser($id);


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
    <?php include("components/sidebar.html") ?>
    <!--  SIDEBAR  -->


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
                            <th class="border-2 border-black">ID</th>
                            <th class="border-2 border-black">rib</th>
                    </thead>
                    <tbody>
                        <?php foreach($accounts as $account): ?>
                            <tr>
                                <th><?=$account['id']?></th>
                                <th><?=$account['rib']?></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
<script src="../public/assets/javascript/main.js"></script>
<script src="../public/assets/javascript/client.js"></script>
</html>