<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.tailwindcss.js"></script>
    <style>
        .blur {
            filter: blur(4px);
            transition: filter 0.3s;
        }

        #modal {
            display: none;
        }

        #modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Hide sidebar*/
        @media (max-width: 768px) {
            #sidebarExpanded {
                display: none;
            }

            #sidebarMinimized {
                display: flex;
            }
        }

        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 2rem;
            box-sizing: border-box;
            width: 100%;
            max-width: 800px;
            background-color: white;
            border-radius: 0.5rem;
            position: relative;
        }

        #closeModal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            cursor: pointer;
        }

        #main-content {
            transition: margin-left 0.3s ease-in-out;
            margin-left: 342px;
        }

        .sidebar-minimized #main-content {
            margin-left: 100px;
        }

        #sidebarExpanded {
            width: 342px;
        }

        #sidebarMinimized {
            width: 100px;
        }

        .d-flex {
            display: flex;
        }

        /* Table and horizontal scrolling */
        table {
            width: 100%;
            display: block;
            overflow-x: auto;
            white-space: nowrap;
            /* Prevent columns from wrapping */
        }
    </style>
</head>

<body class="bg-[#FFF]">
    <div id="sidebarExpanded"
        class="fixed top-0 left-0 w-[342px] h-screen px-[38px] py-[43px] bg-[#251599] rounded-tr-[40px] rounded-br-[40px] z-10 transform transition-transform duration-300 ease-in-out flex flex-col justify-between">
        <div class="self-stretch flex-col justify-start items-end gap-6 flex">
            <div id="closeButton"
                class="w-[39px] h-[39px] bg-white rounded-full shadow border border-[#e6e6e6] cursor-pointer flex items-center justify-center">
                <img src="./img/uip-icons/sideBar-close.png" alt="close">
            </div>

            <div class="self-stretch flex-col justify-start items-center gap-[47px] flex">
                <img id="sidebarLogo" class="w-[87px] h-[88px]" src="./img/uip-icons/UIP_solidA.png" alt="Logo" />
                <div class="self-stretch border border-[#d0d5dd]"></div>
                <div id="sidebarLinks" class="self-stretch flex-col justify-start items-start gap-[30px] flex">
                    <a href="./preboard.php"
                        class="sidebar-link flex items-center gap-2 w-full px-4 py-2 text-white rounded text-base font-semibold border border-transparent hover:border-white">
                        <img src="./img/uip-icons/preboarding2.png" alt="Preboarding" class="w-5 h-5 mr-3">
                        <span class="sidebarText">Pre-Boarding</span>
                    </a>
                    <a href="#"
                        class="sidebar-link flex items-center gap-2 w-full px-4 py-2 bg-white rounded text-[#5041bc] text-base font-semibold border border-transparent hover:border-white">
                        <img src="./img/uip-icons/offboard2.png" alt="Offboarding" class="w-5 h-5 mr-3 text-blue-800">
                        <span class="sidebarText">Off-Boarding</span>
                    </a>
                    <a href="./account.php"
                        class="sidebar-link flex items-center gap-2 w-full px-3 py-2 text-white rounded text-base font-semibold border border-transparent hover:border-white">
                        <img src="./img/uip-icons/account.png" alt="Account Page" class="w-7 h-7 mr-2">
                        <span class="sidebarText">Account Page</span>
                    </a>
                </div>
            </div>
        </div>

        <div id="sidebarFooter" class="self-stretch flex-col justify-end items-start gap-[22px] flex mb-[30px]">
            <div class="self-stretch flex items-center gap-4">
                <div class="w-10 h-10 bg-[#8a6767] rounded-full"></div>
                <div class="text-white sidebarText">
                    <div class="font-semibold">Admin</div>
                    <div class="font-semibold">admin@example.com</div>
                </div>
            </div>
            <a href="./login.html"
                class="self-stretch h-[34px] bg-white text-center text-[#5041bc] text-base font-semibold flex justify-center items-center rounded border border-transparent hover:border-white">
                <img src="./img/uip-icons/logout.png" alt="Logout" class="w-5 h-5 mr-5">
                <span class="sidebarText">Log out</span>
            </a>
        </div>
    </div>

    <div id="sidebarMinimized"
        class="fixed top-0 left-0 w-[100px] h-screen bg-[#251599] rounded-tr-[40px] rounded-br-[40px] z-10 transform transition-transform duration-300 ease-in-out flex flex-col justify-between p-[20px] hidden">
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col items-center gap-[100px]">
                <div id="openButton"
                    class="w-[39px] h-[39px] bg-white rounded-full shadow border border-[#e6e6e6] cursor-pointer flex items-center justify-center">
                    <img src="./img/uip-icons/sideBar-open.png" alt="Open">
                </div>
                <img id="sidebarLogoMinimized" class="w-[50px] h-[50px]" src="./img/uip-icons/UIP_solidA.png"
                    alt="Logo" />
                <div id="sidebarLinksMinimized" class="flex flex-col items-center gap-[20px]">
                    <a href="#preboarding"
                        class="flex items-center justify-center w-[50px] h-[50px] rounded-full border border-transparent hover:border-white">
                        <img src="./img/uip-icons/preboarding2.png" alt="Preboarding" class="w-[20px] h-[20px]">
                    </a>
                    <a href="#offboarding"
                        class="flex items-center justify-center w-[50px] h-[50px] bg-white rounded-full border border-transparent hover:border-white">
                        <img src="./img/uip-icons/offboard2.png" alt="Offboarding" class="w-[20px] h-[20px]">
                    </a>
                    <a href="#account"
                        class="flex items-center justify-center w-[50px] h-[50px] rounded-full border border-transparent hover:border-white">
                        <img src="./img/uip-icons/account.png" alt="Account Page" class="w-[40px] h-[40px]">
                    </a>
                </div>
            </div>

            <div id="sidebarFooterMinimized" class="flex flex-col items-center gap-[20px] mb-[20px]">
                <div class="w-[40px] h-[40px] bg-[#8a6767] rounded-full flex items-center justify-center">
                </div>
                <a href="./login.html"
                    class="flex justify-center items-center w-[50px] h-[50px] bg-white text-center text-[#5041bc] rounded-full border border-transparent hover:border-white">
                    <img src="./img/uip-icons/logout.png" alt="Logout" class="w-5 h-5">
                </a>
            </div>
        </div>
    </div>


    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20">
        <div class="modal-content">
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="text-2xl font-bold mb-6 text-center">ADD NEW INTERN</h2>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter intern's name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="intern-type" class="block text-gray-700 font-medium mb-2">Type of Intern</label>
                        <select id="intern-type" name="intern-type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select type</option>
                            <option value="full-time">Full-Time</option>
                            <option value="part-time">Part-Time</option>
                        </select>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter intern's email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                        <input type="text" id="phone" name="phone" placeholder="Enter intern's phone number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="university" class="block text-gray-700 font-medium mb-2">University</label>
                        <input type="text" id="university" name="university" placeholder="Enter university name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="university-contact" class="block text-gray-700 font-medium mb-2">University Contact
                            Number/Email</label>
                        <input type="text" id="university-contact" name="university-contact"
                            placeholder="Enter university contact info"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="hours" class="block text-gray-700 font-medium mb-2">Hours Requirement</label>
                        <input type="number" id="hours" name="hours" placeholder="Enter hours required"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="orientation-date" class="block text-gray-700 font-medium mb-2">Orientation
                            Date</label>
                        <input type="date" id="orientation-date" name="orientation-date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="start-date" class="block text-gray-700 font-medium mb-2">Start Date</label>
                        <input type="date" id="start-date" name="start-date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="end-date" class="block text-gray-700 font-medium mb-2">End Date</label>
                        <input type="date" id="end-date" name="end-date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add
                    Intern</button>
            </form>
        </div>
    </div>

    <section class="p-4 md:p-8" id="main-content">
        <div class="text-black font-montserrat font-bold leading-[44.8px]">
            <div class="flex flex-col items-start md:items-end space-y-4">
                <div class="flex flex-col md:flex-row justify-between items-center w-full">
                    <h1 class="text-2xl md:text-3xl">Off-Boarding</h1>
                    <button id="addInternBtn"
                        class="bg-[#624DE3] text-white px-4 py-1 rounded-lg flex items-center gap-2 hover:bg-[#1d1a4f]">
                        <img src="./img/uip-icons/add.png" alt="Add Intern" class="w-5 h-5">
                        <span>Add Intern</span>
                    </button>
                </div>

                <!--
                <div class="relative w-full max-w-xs md:max-w-md">
                    <input id="myInput" type="text" placeholder="Search..."
                    class="w-full h-[45px] pl-4 pr-10 rounded-full bg-[#F5F3FF] text-black focus:outline-none" />
                        <button id="searchBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                            <img src="./img/uip-icons/search.png" alt="Search" class="w-5 h-5">
                        </button>
                </div> -->

                <!-- Edit Modal -->
                <div id="editModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 hidden">
                    <div class="modal-content bg-white p-6 rounded-lg shadow-lg relative">
                        <button id="closeEditModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <h2 class="text-2xl font-bold mb-6 text-center">Edit Intern</h2>
                        <form id="editForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label for="edit_name" class="block text-gray-700 font-medium mb-2">Name</label>
                                    <input type="text" id="edit_name" name="name" placeholder="Enter intern's name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_intern_type" class="block text-gray-700 font-medium mb-2">Type of
                                        Intern</label>
                                    <select id="edit_intern_type" name="intern_type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Select type</option>
                                        <option value="full-time">Full-Time</option>
                                        <option value="part-time">Part-Time</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="edit_email" class="block text-gray-700 font-medium mb-2">Email
                                        Address</label>
                                    <input type="email" id="edit_email" name="email" placeholder="Enter intern's email"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_phone" class="block text-gray-700 font-medium mb-2">Phone
                                        Number</label>
                                    <input type="text" id="edit_phone" name="phone"
                                        placeholder="Enter intern's phone number"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_university"
                                        class="block text-gray-700 font-medium mb-2">University</label>
                                    <input type="text" id="edit_university" name="university"
                                        placeholder="Enter university name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_university_contact"
                                        class="block text-gray-700 font-medium mb-2">University Contact
                                        Number/Email</label>
                                    <input type="text" id="edit_university_contact" name="university_contact"
                                        placeholder="Enter university contact info"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_hours" class="block text-gray-700 font-medium mb-2">Hours
                                        Requirement</label>
                                    <input type="number" id="edit_hours" name="hours" placeholder="Enter hours required"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_orientation_date"
                                        class="block text-gray-700 font-medium mb-2">Orientation Date</label>
                                    <input type="date" id="edit_orientation_date" name="orientation_date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_start_date" class="block text-gray-700 font-medium mb-2">Start
                                        Date</label>
                                    <input type="date" id="edit_start_date" name="start_date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_end_date" class="block text-gray-700 font-medium mb-2">End
                                        Date</label>
                                    <input type="date" id="edit_end_date" name="end_date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="edit_status" class="block text-gray-700 font-medium mb-2">Status</label>
                                    <select id="edit_status" name="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Select status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>



                <!-- Table Section -->
                <div class="relative w-full max-w-xs md:max-w-md">
                    <input id="customSearch" type="text" placeholder="Search..."
                        class="w-full h-[45px] pl-4 pr-10 rounded-full bg-[#F5F3FF] text-black focus:outline-none" />
                    <button id="searchBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                        <img src="./img/uip-icons/search.png" alt="Search" class="w-5 h-5">
                    </button>
                </div>

                <div class="PreboardingDesktop relative bg-white mt-10 w-full">
                    <table class="min-w-full overflow-x-auto relative" id="example" data-order='[[ 0, "asc" ]]'
                        data-page-length='10'>
                        <thead class="bg-white">
                            <tr>
                                <!-- Column Headers -->
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    ID</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Name</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Type of Intern</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Email Address</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Phone Number</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Facebook Link</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Course</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    University</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    University Contact Number or Email</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Hours Requirement</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Discord Username</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Orientation Date</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Start Date</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    End Date</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "uip_preboarding_offboarding");
                                if ($conn->connect_error) {
                                    die("Connection Failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT app_id, name, email_address, intern_type, phone_number, facebook_link, 
                                course, school_name, school_contact, hours_requirement, discord_username, 
                                orientation_date, start_date, end_date, status 
                                FROM preboarding_attendance";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $rowIndex = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $bgColor = ($rowIndex % 2 == 0) ? 'bg-[#f7f6fe]' : 'bg-[#e5e7fe]';
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["app_id"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["name"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["intern_type"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["email_address"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["phone_number"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["facebook_link"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["course"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["school_name"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["school_contact"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["hours_requirement"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["discord_username"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["orientation_date"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["start_date"] . "</td>";
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap'>" . $row["end_date"] . "</td>";

                                        // Status
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap text-center'>
                                            <button class='shadow-lg shadow-black-950/80 bg-orange-500 text-white font-normal px-[10px] rounded-[8px] hover:bg-[#8b4727]'>" . $row["status"] . "</button>
                                        </td>";

                                        // Delete Button
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap text-center'>
                                            <button class='w-5 rounded'>
                                                <img src='./img/uip-icons/delete.png' alt='delete'/>
                                            </button>
                                        </td>";

                                        // Edit Button
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap text-center'>
                                            <button class='w-5 rounded' data-id='" . $row["app_id"] . "'>
                                                <img src='./img/uip-icons/edit.png' alt='edit'/>
                                            </button>
                                        </td>";

                                        echo "</tr>";
                                        $rowIndex++;
                                    }
                                } else {
                                    echo "<tr><td colspan='17'>No records found</td></tr>";
                                }

                                $conn->close();
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>






            </div>
        </div>
    </section>


    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": [15, 16]
                }],
                "dom": '<"topBar d-flex justify-between"lr>t<"bottomBar d-flex justify-between"ip>',
                "fixedHeader": true,
            });
            $('#customSearch').on('keyup', function () {
                table.search(this.value).draw();
            });
        });

    </script>


    <script>
        const sidebarExpanded = document.getElementById('sidebarExpanded');
        const sidebarMinimized = document.getElementById('sidebarMinimized');
        const closeButton = document.getElementById('closeButton');
        const openButton = document.getElementById('openButton');
        const addInternBtn = document.getElementById('addInternBtn');
        const modal = document.getElementById('modal');
        const closeModal = document.getElementById('closeModal');
        const mainContent = document.getElementById('main-content');

        function toggleSidebar(expanded) {
            if (expanded) {
                sidebarExpanded.style.display = 'flex';
                sidebarMinimized.style.display = 'none';
                mainContent.classList.add('sidebar-expanded');
                mainContent.classList.remove('sidebar-minimized');
                mainContent.style.marginLeft = '342px';
            } else {
                sidebarExpanded.style.display = 'none';
                sidebarMinimized.style.display = 'flex';
                mainContent.classList.add('sidebar-minimized');
                mainContent.classList.remove('sidebar-expanded');
                mainContent.style.marginLeft = '100px';
            }
        }

        closeButton.addEventListener('click', () => {
            toggleSidebar(false);
        });

        openButton.addEventListener('click', () => {
            toggleSidebar(true);
        });

        addInternBtn.addEventListener('click', () => {
            modal.classList.add('show');
            mainContent.classList.add('blur');
        });

        closeModal.addEventListener('click', () => {
            modal.classList.remove('show');
            mainContent.classList.remove('blur');
        });

        document.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('show');
                mainContent.classList.remove('blur');
            }
        });

        document.querySelectorAll('button[data-id]').forEach(button => {
            button.addEventListener('click', function () {
                const internId = this.getAttribute('data-id');
                // Fetch intern data based on internId using AJAX (not shown here)
                // For demonstration, we'll populate with static data
                document.getElementById('edit_name').value = ''; // Replace with actual data
                // Populate other fields similarly

                document.getElementById('editModal').classList.remove('hidden');

            });
        });

        document.getElementById('closeEditModal').addEventListener('click', function () {
            document.getElementById('editModal').classList.add('hidden');

        });
    </script>
</body>

</html>