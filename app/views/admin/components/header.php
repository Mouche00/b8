<header class="w-full h-[10%] bg-white border-b-4 border-dotted border-black flex justify-end">
    <div class="flex">
        <div class="flex flex-col m-auto mr-4">
            <h2 class="text-2xl font-bold"><?=$_SESSION['username']?></h2>
            <?php foreach($_SESSION["roles"] as $role): ?>
                <p><?=ucfirst($role['name'])?></p>
            <?php endforeach; ?>
        </div>
        <div class="h-[80%] m-auto mr-8 py-2 bg-black rounded-lg">
            <img class="h-full" src=<?= URLROOT . "public/assets/images/profile.png"?> alt="">
        </div>
    </div>
</header>