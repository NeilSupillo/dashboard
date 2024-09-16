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

        /* Sidebar expanded for desktop and minimized for mobile */
        @media (max-width: 768px) {
            #sidebarExpanded {
                display: none;
            }

            #sidebarMinimized {
                display: flex;
            }

            #main-content {
                margin-left: 100px;
            }
        }

        @media (min-width: 769px) {
            #sidebarExpanded {
                display: flex;
            }

            #sidebarMinimized {
                display: none;
            }

            #main-content {
                margin-left: 342px;
            }
        }

        /* Ensure smooth transitions */
        #main-content {
            transition: margin-left 0.3s ease-in-out;
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

        }

        @media (max-width: 768px) {
            #main-content .flex {
                flex-direction: row;
                justify-content: space-between;
            }
        }

        /* Modal Container */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Overlay with opacity */
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }

        /* Modal Content Styling */
        .Rectangle24022 {
            background-color: white;
            width: 399px;
            height: 186px;
            border-radius: 12px;
            /* Removed the black border */
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Confirm and Cancel buttons */
        button.Content {
            cursor: pointer;
            border: none;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            font-family: Montserrat;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        /* Add space between the buttons */
        .actions {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            /* Added space between buttons */
        }

        button.Content:hover {
            opacity: 0.9;
        }

        /* Success/Cancel message modal */
        .Frame237698 {
            padding: 12px;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="bg-[#FFF]">
    <!-- Delete Account Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="Rectangle24022 w-[399px] h-[186px] bg-white rounded-lg">
            <div class="AreYouSureDoYouWantToApproveThis"
                style="text-align: center; color: black; font-size: 16px; font-family: Montserrat; font-weight: 600; padding: 20px;">
                Are you sure you want to delete this account?
            </div>
            <div class="Line28" style="width: 100%; border: 1px solid #808080;"></div>
            <div class="actions" style="display: flex; justify-content: space-around; padding: 20px;">
                <!-- Confirm Delete Button -->
                <button id="confirmDelete" class="Content bg-[#41BC41] text-white rounded-lg"
                    style="width: 96px; padding: 10px; font-size: 14px; font-family: Montserrat; font-weight: 700;">
                    CONFIRM
                </button>
                <!-- Cancel Delete Button -->
                <button id="cancelDelete" class="Content bg-[#BC4141] text-white rounded-lg"
                    style="width: 96px; padding: 10px; font-size: 14px; font-family: Montserrat; font-weight: 700;">
                    CANCEL
                </button>
            </div>
        </div>
    </div>
    <!-- Success or Cancel Modal -->
    <div id="resultModal" class="modal" style="display:none;">
        <div id="resultMessage" class="Frame237698"
            style="width: 200px; padding: 12px 12px 8px 12px; border-radius: 8px; text-align: center; font-size: 16px; font-family: Montserrat; font-weight: 700; color: white;">
            <!-- Message will be dynamically inserted here (CONFIRMED or CANCELED) -->
        </div>
    </div>

    <!-- Approve Confirmation Modal -->
    <div id="approveModal" class="modal">
        <div class="Rectangle24022 w-[399px] h-[186px] bg-white rounded-lg">
            <div class="AreYouSureDoYouWantToApproveThis"
                style="text-align: center; color: black; font-size: 16px; font-family: Montserrat; font-weight: 600; padding: 20px;">
                Are you sure you want to approve/disapprove this intern?
            </div>
            <div class="Line28" style="width: 100%; border: 1px solid #808080;"></div>
            <div class="actions" style="display: flex; justify-content: space-around; padding: 20px;">
                <!-- Confirm Button -->
                <button id="confirmAction" class="Content bg-[#41BC41] text-white rounded-lg"
                    style="width: 96px; padding: 10px; font-size: 14px; font-family: Montserrat; font-weight: 700;">
                    CONFIRM
                </button>
                <!-- Cancel Button -->
                <button id="cancelAction" class="Content bg-[#BC4141] text-white rounded-lg"
                    style="width: 96px; padding: 10px; font-size: 14px; font-family: Montserrat; font-weight: 700;">
                    CANCEL
                </button>
            </div>
        </div>
    </div>

    <!-- Success or Cancel Modal -->
    <div id="resultApprove" class="modal" style="display:none;">
        <div id="resultMessageApprove" class="Frame237698"
            style="width: 200px; padding: 12px 12px 8px 12px; border-radius: 8px; text-align: center; font-size: 16px; font-family: Montserrat; font-weight: 700; color: white;">
            <!-- Message will be dynamically inserted here (CONFIRMED or CANCELED) -->
        </div>
    </div>

    <div id="sidebarExpanded"
        class="fixed top-0 left-0 w-[342px] h-screen px-[38px] py-[43px] bg-[#251599] rounded-tr-[40px] rounded-br-[40px] z-10 transform transition-transform duration-300 ease-in-out flex flex-col justify-between">
        <div class="self-stretch flex-col justify-start items-end gap-6 flex">
            <div id="closeButton"
                class="w-[39px] h-[39px] bg-white rounded-full shadow border border-[#e6e6e6] cursor-pointer flex items-center justify-center">
                <img src="{{ asset('img/uip-icons/sideBar-close.png') }}" alt="close">

            </div>

            <div class="self-stretch flex-col justify-start items-center gap-[47px] flex">
                <img id="sidebarLogo" class="w-[87px] h-[88px]" src="{{ asset('img/uip-icons/UIP_solidA.png') }}" alt="Logo" />
                <div class="self-stretch border border-[#d0d5dd]"></div>
                <div id="sidebarLinks" class="self-stretch flex-col justify-start items-start gap-[30px] flex">
                    <a href="#"
                        class="sidebar-link flex items-center gap-2 w-full px-4 py-2 bg-white rounded text-[#5041bc] text-base font-semibold border border-transparent hover:border-white">
                        <img src="{{ asset('img/uip-icons/preboard.png') }}" alt="Preboarding" class="w-5 h-5 mr-3">
                        <span class="sidebarText">Pre-Boarding</span>
                    </a>
                    <a href="./offboard.php"
                        class="sidebar-link flex items-center gap-2 w-full px-4 py-2 text-white rounded text-base font-semibold border border-transparent hover:border-white">
                        <img src="{{ asset('img/uip-icons/offboard.png') }}" alt="Offboarding" class="w-5 h-5 mr-3 text-blue-800">
                        <span class="sidebarText">Off-Boarding</span>
                    </a>
                    <a href="./account.php"
                        class="sidebar-link flex items-center gap-2 w-full px-3 py-2 text-white rounded text-base font-semibold border border-transparent hover:border-white">
                        <img src="{{ asset('img/uip-icons/account.png') }}" alt="Account Page" class="w-7 h-7 mr-2">
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
                <img src="{{ asset('img/uip-icons/logout.png') }}" alt="Logout" class="w-5 h-5 mr-5">
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
                    <img src="{{ asset('img/uip-icons/sideBar-open.png') }}" alt="Open">
                </div>
                <img id="sidebarLogoMinimized" class="w-[50px] h-[50px]" src="{{ asset('img/img/uip-icons/UIP_solidA.png') }}"
                    alt="Logo" />
                <div id="sidebarLinksMinimized" class="flex flex-col items-center gap-[20px]">
                    <a href="#preboarding"
                        class="flex items-center justify-center w-[50px] h-[50px] bg-white rounded-full border border-transparent hover:border-white">
                        <img src="{{ asset('img/img/uip-icons/preboard.png') }}" alt="Preboarding" class="w-[20px] h-[20px]">
                    </a>
                    <a href="#offboarding"
                        class="flex items-center justify-center w-[50px] h-[50px] rounded-full border border-transparent hover:border-white">
                        <img src="{{ asset('img/uip-icons/offboard.png') }}"  alt="Offboarding" class="w-[20px] h-[20px]">
                    </a>
                    <a href="#account"
                        class="flex items-center justify-center w-[50px] h-[50px] rounded-full border border-transparent hover:border-white">
                        <img src="{{ asset('img/uip-icons/account.png') }}" alt="Account Page" class="w-[40px] h-[40px]">
                    </a>
                </div>
            </div>

            <div id="sidebarFooterMinimized" class="flex flex-col items-center gap-[20px] mb-[20px]">
                <div class="w-[40px] h-[40px] bg-[#8a6767] rounded-full flex items-center justify-center">
                </div>
                <a href="./login.html"
                    class="flex justify-center items-center w-[50px] h-[50px] bg-white text-center text-[#5041bc] rounded-full border border-transparent hover:border-white">
                    <img src="{{ asset('img/uip-icons/logout.png') }}" alt="Logout" class="w-5 h-5">
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
                            <option id="intern_type_new" value="New Intern">New Intern</option>
                            <option id="intern_type_returning" value="Returning Intern">Returning Intern</option>
                            <option id="intern_type_voluntary" value="Voluntary Intern">Voluntary Intern</option>
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
            <div class="flex flex-col md:flex-row justify-between items-center w-full">
                <h1 class="text-2xl md:text-3xl">Pre-Boarding</h1>
                <button id="addInternBtn"
                    class="bg-[#624DE3] text-white px-4 py-1 rounded-lg flex items-center gap-2 hover:bg-[#1d1a4f]">
                    <img src="{{ asset('img/uip-icons/add.png') }}" alt="Add Intern" class="w-5 h-5">
                    <span class="hidden md:inline">Add Intern</span>
                </button>
            </div>

            <div class="flex justify-end w-full px-4">
                <div class="relative w-full max-w-xs sm:max-w-sm md:max-w-md pt-4">
                    <input id="customSearch" type="text" placeholder="Search..."
                        class="w-full h-[45px] sm:h-[50px] pl-4 pr-10 rounded-full bg-[#F5F3FF] text-black focus:outline-none" />
                    <button id="searchBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                        <img src="{{ asset('img/uip-icons/search.png') }}" alt="Search" class="w-5 h-5">
                    </button>
                </div>
            </div>



            <!-- Edit Modal -->
            <div id="successModal"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden z-50">
                <div
                    class="bg-white w-[399px] h-[155px] rounded-lg shadow-md border border-transparent flex flex-col items-center justify-center p-4">
                    <div
                        class="w-[379px] h-[54px] text-center text-black text-lg font-semibold font-montserrat break-words mb-1">
                        <!-- Dynamic message will be inserted here -->
                    </div>
                    <div class="w-[96px] h-[37px] bg-[#41BC41] rounded-lg flex items-center justify-center mt-1">
                        <button id="okButton"
                            class="w-full h-full text-white text-sm font-bold rounded-lg focus:outline-none">
                            OK
                        </button>
                    </div>
                </div>
            </div>

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
                                    <option id="intern_type_new" value="New Intern">New Intern</option>
                                    <option id="intern_type_returning" value="Returning Intern">Returning Intern
                                    </option>
                                    <option id="intern_type_voluntary" value="Voluntary Intern">Voluntary Intern
                                    </option>
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
                                    class="block text-gray-700 font-medium mb-2">University Contact Number/Email</label>
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
                                <label for="edit_end_date" class="block text-gray-700 font-medium mb-2">End Date</label>
                                <input type="date" id="edit_end_date" name="end_date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="edit_status" class="block text-gray-700 font-medium mb-2">Status</label>
                                <select id="edit_status" name="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
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

            <div class="PreboardingDesktop relative bg-white mt-10 w-full">
                <table class="min-w-full overflow-x-auto relative" id="example" data-order='[[ 0, "asc" ]]'
                    data-page-length='10'>
                    <thead class="bg-white">
                        <tr>
                            <!-- Column Headers -->
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">ID
                            </th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Name
                            </th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Type
                                of Intern</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Email
                                Address</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Phone
                                Number</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                Facebook Link</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                Course</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                University</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                University Contact Number or Email</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                Discord Username</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Hours
                                Requirement</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">
                                Orientation Date</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Start
                                Date</th>
                            <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">End
                                Date</th>
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

                                    echo "<td class='px-6 py-4 whitespace-nowrap text-center'>
    <button class='shadow-lg shadow-black-950/80 " .
                                        ($row['status'] === 'approved' ? 'bg-green-500' : 'bg-orange-500') .
                                        " text-white font-normal px-[10px] rounded-[8px] hover:bg-[#8b4727]' data-intern-id='" . $row['app_id'] . "'>
        " . ucfirst($row['status']) . "
    </button>
</td>";




// Get the base URL for the application
$baseUrl = url('/');

// Inside the PHP while loop where the buttons are generated
echo "<td class='px-6 py-4 whitespace-nowrap text-center'>
        <button class='w-5 rounded' data-delete-id='" . $row["app_id"] . "'>
            <img src='" . $baseUrl . "/img/uip-icons/delete.png' alt='delete'/>
        </button>
    </td>";

// Edit Button
echo "<td class='px-6 py-4 whitespace-nowrap text-center'>
        <button class='w-5 rounded' data-id='" . $row["app_id"] . "'>
            <img src='" . $baseUrl . "/img/uip-icons/edit.png' alt='edit'/>
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
            </div>
            </table>
        </div>
        </div>

    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let internIdToApprove;

            document.querySelectorAll('button[data-intern-id]').forEach(button => {
                button.addEventListener('click', function () {
                    internIdToApprove = this.getAttribute('data-intern-id');
                    console.log('Intern ID:', internIdToApprove);
                    document.getElementById('approveModal').style.display = 'flex';
                });
            });

            document.getElementById('confirmAction').addEventListener('click', function () {
                if (internIdToApprove) {
                    fetch(`approve.php?id=${internIdToApprove}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `status=approved`
                    })
                        .then(response => response.text())
                        .then(result => {
                            console.log('Server response:', result);
                            if (result.trim() === 'success') {
                                document.getElementById('approveModal').style.display = 'none';
                                showResultModal('APPROVED', '#41BC41');
                                const statusButton = document.querySelector(`button[data-intern-id='${internIdToApprove}']`);
                                statusButton.textContent = 'Approved';
                                statusButton.classList.remove('bg-orange-500', 'hover:bg-[#8b4727]');
                                statusButton.classList.add('bg-green-500');
                            } else {
                                showResultModal('ERROR', '#BC4141');
                                console.error('Error:', result);
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            showResultModal('ERROR', '#BC4141');
                        });
                }
            });

            // Handle Cancel action
            document.getElementById('cancelAction').addEventListener('click', function () {
                // Close the delete confirmation modal
                document.getElementById('approveModal').style.display = 'none';
                showResultModal('CANCELED', '#BC4141'); // Show cancel message
            });

            function showResultModal(message, bgColor) {
                const resultModal = document.getElementById('resultApprove');
                const resultMessage = document.getElementById('resultMessageApprove');
                resultMessage.textContent = message;
                resultMessage.style.backgroundColor = bgColor;
                resultModal.style.display = 'flex';
                setTimeout(() => {
                    resultModal.style.display = 'none';
                }, 1500);
            }
        });

    </script>


    <script>
        document.querySelectorAll('button[data-id]').forEach(button => {
            button.addEventListener('click', function () {
                const internId = this.getAttribute('data-id');

                // Fetch the intern data via AJAX
                fetch(`get_intern.php?id=${internId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate the modal with the fetched data
                        document.getElementById('edit_name').value = data.name;
                        document.getElementById('edit_intern_type').value = data.intern_type;
                        document.getElementById('edit_email').value = data.email;
                        document.getElementById('edit_phone').value = data.phone;
                        document.getElementById('edit_university').value = data.university;
                        document.getElementById('edit_university_contact').value = data.university_contact;
                        document.getElementById('edit_hours').value = data.hours;
                        document.getElementById('edit_orientation_date').value = data.orientation_date;
                        document.getElementById('edit_start_date').value = data.start_date;
                        document.getElementById('edit_end_date').value = data.end_date;
                        document.getElementById('edit_status').value = data.status;

                        // Show the edit modal
                        document.getElementById('editModal').classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching intern data:', error);
                    });
            });
        });

        document.getElementById('editForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(this);
            const internId = document.querySelector('button[data-id]').getAttribute('data-id');

            fetch(`update_intern.php?id=${internId}`, {
                method: 'POST',
                body: formData,
            })
                .then(response => response.text())
                .then(result => {
                    if (result.trim() === 'success') {
                        showModal('Intern Details Updated Successfully!', () => {
                            location.reload(); // Reload the page after clicking OK
                        });
                    } else {
                        showModal('Error updating intern details: ' + result);
                    }
                })
                .catch(error => {
                    console.error('Error updating intern details:', error);
                    showModal('An error occurred while updating intern details.');
                });
        });

        function showModal(message, callback) {
            const modal = document.getElementById('successModal');
            const messageDiv = modal.querySelector('.text-center');
            messageDiv.textContent = message;
            modal.classList.remove('hidden');

            const okButton = document.getElementById('okButton');
            okButton.addEventListener('click', () => {
                modal.classList.add('hidden');
                if (callback) callback(); // Call the provided callback function
            }, { once: true }); // Ensure the event listener is added only once
        }


        document.addEventListener('DOMContentLoaded', function () {
            let internIdToDelete = null; // Variable to store the intern ID for deletion

            // When a delete button is clicked, open the delete confirmation modal
            document.querySelectorAll('button[data-delete-id]').forEach(button => {
                button.addEventListener('click', function () {
                    internIdToDelete = this.getAttribute('data-delete-id');
                    console.log('Intern ID to delete:', internIdToDelete); // Debugging to ensure ID is retrieved

                    // Show the delete confirmation modal
                    document.getElementById('deleteModal').style.display = 'flex';
                });
            });

            // Handle Confirm Delete action
            document.getElementById('confirmDelete').addEventListener('click', function () {
                if (internIdToDelete) {
                    fetch(`delete_intern.php?id=${internIdToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                    })
                        .then(response => response.text())
                        .then(result => {
                            console.log('Server response:', result); // Debugging to check the server response
                            // Close the delete modal
                            document.getElementById('deleteModal').style.display = 'none';

                            if (result.trim() === 'success') {
                                showResultModal('CONFIRMED', '#41BC41'); // Success message
                                setTimeout(() => location.reload(), 1500); // Reload after showing the result
                            } else {
                                showResultModal('ERROR', '#BC4141'); // Show error message
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            showResultModal('ERROR', '#BC4141'); // Show error message
                        });
                }
            });

            // Handle Cancel action
            document.getElementById('cancelDelete').addEventListener('click', function () {
                // Close the delete confirmation modal
                document.getElementById('deleteModal').style.display = 'none';
                showResultModal('CANCELED', '#BC4141'); // Show cancel message
            });

            // Function to display the result modal
            function showResultModal(message, bgColor) {
                const resultModal = document.getElementById('resultModal');
                const resultMessage = document.getElementById('resultMessage');

                resultMessage.textContent = message;
                resultMessage.style.backgroundColor = bgColor; // Change background color based on action
                resultModal.style.display = 'flex'; // Show result modal

                // Hide result modal after 1.5 seconds
                setTimeout(() => {
                    resultModal.style.display = 'none';
                }, 1500);
            }
        });



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


        document.getElementById('closeEditModal').addEventListener('click', function () {
            document.getElementById('editModal').classList.add('hidden');

        });
    </script>

</body>

</html>