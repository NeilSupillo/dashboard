<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/preboarding_table.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
</head>
<body>
    <p class="font-semibold text-lg">Test</p>
    <table id="preboarding_table" class="display">
        <thead>
            <tr>
                <th>Application ID</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Intern Type</th>
                <th>Phone Number</th>
                <th>Facebook Link</th>
                <th>Course</th>
                <th>School Name</th>
                <th>School Contact</th>
                <th>Hours Requirement</th>
                <th>Discord Name</th>
                <th>Orientation Date</th>
                <th>Start Date</th>
                <th>Tentative End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            {{-- Data Population will be done here automatically. --}}
        </tbody>
</body>
</html>