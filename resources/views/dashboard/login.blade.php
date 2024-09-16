<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Page</title>
  <script src="https://cdn.tailwindcss.com"></script>


</head>
<body class="bg-cover bg-center" style="background-image: url('img/uip-icons/bg.png');">

    <section class="flex w-full h-screen py-[133px] justify-center items-center">
        
        <div class="flex flex-col items-center gap-[43px]">
            <form class="flex flex-col items-center gap-[25px]">
                <div class="w-[200px] h-[200px]">
                    <img src="./img/uip-icons/UIP_solidA.png" alt="Logo">
                </div>
                <div class="w-[300px]">
                    <div class="relative flex items-center">
                        <img src="./img/uip-icons/user.png" alt="user" class="absolute left-3 w-5 h-5">
                        <input type="text" placeholder="Username" class="w-full h-[45px] pl-10 pr-[12px] bg-transparent border border-white rounded-[4px] text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-white transition duration-300 ease-in-out">
                    </div>
                </div>
                <div class="w-[300px]">
                    <div class="relative flex items-center">
                        <img src="./img/uip-icons/lock.png" alt="lock" class="absolute left-3 w-5 h-5">
                        <input type="password" placeholder="Password" class="w-full h-[45px] pl-10 pr-[12px] bg-transparent border border-white rounded-[4px] text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-white transition duration-300 ease-in-out">
                    </div>
                </div>
                <button id="loginBtn" class="shadow-lg shadow-blue-950/80 w-[300px] h-[45px] bg-white text-[#2148C0] font-bold rounded-[4px] hover:bg-gray-200 transition duration-300 ease-in-out">
                    <a href="./preboard.php">LOGIN </a>
                </button>                 
                <div class="w-[300px] flex flex-col items-end text-lg">
                    <a href="#" class="text-white hover:underline mb-1">Forgot password?</a>
                </div>
            </form>
            
        </div>
    </section>

</body>
</html>
