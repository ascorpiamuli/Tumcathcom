<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI4 Enhanced UI</title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">CI4 App</h1>
            <button onclick="openModal()" class="px-4 py-2 bg-white text-blue-600 rounded-md shadow-md">Open Modal</button>
        </div>
    </nav>

    <!-- Modal -->
    <div id="myModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg">
            <h2 class="text-2xl font-bold">Modal Title</h2>
            <p>This is a simple modal.</p>
            <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-md">Close</button>
        </div>
    </div>

    <!-- Success Pop-up -->
    <div id="successAlert" class="hidden fixed bottom-5 right-5 bg-green-500 text-white p-4 rounded-md shadow-lg">
        ✅ <?= session()->getFlashdata('success') ?>
    </div>

    <!-- Form Example -->
    <form action="<?= base_url('/submit-form') ?>" method="post">
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md">Submit Form</button>
    </form>

    <script>
        function openModal() {
            document.getElementById('myModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('myModal').classList.add('hidden');
        }

        function showSuccessAlert() {
            let alertBox = document.getElementById('successAlert');
            alertBox.classList.remove('hidden');
            setTimeout(() => {
                alertBox.classList.add('hidden');
            }, 3000);
        }

        // Call success alert if PHP session message exists
        <?php if (session()->getFlashdata('success')) : ?>
            showSuccessAlert();
        <?php endif; ?>
    </script>

</body>
</html>
