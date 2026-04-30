<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard - EduSync</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-600 text-white min-h-screen fixed shadow-lg">

        <!-- Logo -->
        <div class="flex items-center gap-2 px-5 py-4 text-xl font-bold">
            🎓 EduSync
        </div>

        <hr class="border-blue-400">

        <!-- Menu -->
        <nav class="mt-4 flex flex-col gap-1 px-3">

            <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-md bg-blue-500 font-semibold">
                📊 Dashboard
            </a>

            <a href="myprogramme.php" class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-500 transition">
                📚 Mon Programme
            </a>

            <a href="mapromotion.php" class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-500 transition">
                🎓 Mon Promotion
            </a>

            <a href="profile.php" class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-500 transition">
                👤 Profile
            </a>

            <a href="details.php" class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-500 transition">
                ℹ️ Details
            </a>

        </nav>

        <!-- Footer -->
        <div class="absolute bottom-0 w-full px-5 py-4 border-t border-blue-400">
            <div class="text-xs uppercase text-blue-200 mb-2">Account</div>
            <a href="../auth/logout.php" class="flex items-center gap-2 text-yellow-300 hover:text-yellow-400">
                 Logout
            </a>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="ml-64 w-full p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Welcome </h1>
                <p class="text-gray-500 text-sm">Here's your academic overview.</p>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="mt-4">
            <div class="bg-white shadow rounded-xl p-5">

                <h5 class="font-bold mb-4 text-gray-800">Quick Actions</h5>

                <div class="flex flex-wrap gap-3">

                    <button class="border border-blue-500 text-blue-600 px-4 py-2 rounded-lg text-sm hover:bg-blue-500 hover:text-white transition">
                        Materials
                    </button>

                    <button class="border border-green-500 text-green-600 px-4 py-2 rounded-lg text-sm hover:bg-green-500 hover:text-white transition">
                        Submit
                    </button>

                    <button class="border border-cyan-500 text-cyan-600 px-4 py-2 rounded-lg text-sm hover:bg-cyan-500 hover:text-white transition">
                        Message
                    </button>

                </div>

            </div>
        </div>

    </main>

</div>

</body>
</html>