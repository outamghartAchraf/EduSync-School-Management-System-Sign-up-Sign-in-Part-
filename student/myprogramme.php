<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-5xl mx-auto">

        <!-- Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            <!-- Header -->
            <div class="p-4 border-b">
                <h2 class="text-lg font-bold">Enrolled Courses</h2>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">

                    <!-- Head -->
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Course Name</th>
                            <th class="px-4 py-3">Instructor</th>
                            <th class="px-4 py-3">Progress</th>
                            <th class="px-4 py-3">Grade</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y">

                        <!-- Row 1 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold">Mathematics 101</td>
                            <td class="px-4 py-3">Dr. Smith</td>

                            <!-- Progress -->
                            <td class="px-4 py-3 w-1/3">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                                </div>
                            </td>

                            <!-- Grade -->
                            <td class="px-4 py-3">
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">
                                    A-
                                </span>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold">Physics 201</td>
                            <td class="px-4 py-3">Prof. Johnson</td>

                            <td class="px-4 py-3">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 72%"></div>
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs font-semibold">
                                    B+
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</body>
</html>