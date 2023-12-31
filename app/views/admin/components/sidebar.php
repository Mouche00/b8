<aside class="h-full w-16 py-4 bg-black flex flex-col justify-between text-white">
    <section class="w-[100%] mx-auto mb-10">
        <img class="w-[80%] mx-auto" src="<?= URLROOT . 'public/assets/images/logo-white.png'?>" alt="">
        <!-- <h1 class="logo-text text-3xl text-center">Yamaguchi-gumi Bank</h1> -->
    </section>
    <!-- <h1 class="text-4xl text-center">··········</h1> -->
    <section id="sidebar" class="w-full mx-auto my-10">
        <div id="bank" class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
            <a href="bank.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                <i class="fa-solid fa-yen-sign text-3xl"></i>
                <!-- <h2 class="text-2xl font-extrabold">BANKS</h2> -->
            </a>
        </div>
        <div id="agency" class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
            <a href="agency.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                <i class="fa-solid fa-building text-3xl"></i>
                <!-- <h2 class="text-2xl font-extrabold">AGENCIES</h2> -->
            </a>
        </div>
        <div id="atm" class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
            <a href="atm.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                <i class="fa-solid fa-gears text-3xl"></i>
                <!-- <h2 class="text-2xl font-extrabold">ATMS</h2> -->
            </a>
        </div>
        <div id="user" class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
            <a href="user.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                <i class="fa-solid fa-person text-3xl"></i>
                <!-- <h2 class="text-2xl font-extrabold">USERS</h2> -->
            </a>
        </div>
        <div id="account" class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
            <a href="account.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                <i class="fa-solid fa-book text-3xl"></i>
                <!-- <h2 class="text-2xl font-extrabold">ACCOUNTS</h2> -->
            </a>
        </div>
        <div id="transaction" class="w-full h-14 transition delay-100 hover:text-black hover:bg-white">
            <a href="transaction.php" class="w-[75%] h-full mx-auto flex justify-center items-center">
                <i class="fa-solid fa-arrow-right-arrow-left text-3xl"></i>
                <!-- <h2 class="text-2xl font-extrabold">TRANSACTIONS</h2> -->
            </a>
        </div>
    </section>
    <!-- <h1 class="text-4xl text-center">··········</h1> -->
    <section class="w-full mx-auto mt-10">
        <div class="w-[75%] h-12 mx-auto text-black bg-white rounded-lg">
            <a href="<?= URLROOT . 'app/controllers/loginController.php?logout=1'?>" class="w-[75%] h-full mx-auto flex justify-center items-center">
                <!-- <h2 class="text-2xl font-extrabold mx-auto">LOGOUT</h2> -->
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </div>
    </section>
</aside>