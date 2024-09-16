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
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }

        .Rectangle24022 {
            background-color: white;
            width: 399px;
            height: 186px;
            border-radius: 12px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

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

        .actions {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        button.Content:hover {
            opacity: 0.9;
        }

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
            <div class="AreYouSureDoYouWantToApproveThis" style="text-align: center; color: black; font-size: 16px; font-family: Montserrat; font-weight: 600; padding: 20px;">
                Are you sure you want to delete this account?
            </div>
            <div class="Line28" style="width: 100%; border: 1px solid #808080;"></div>
            <div class="actions" style="display: flex; justify-content: space-around; padding: 20px;">
                <!-- Confirm Delete Button -->
                <button id="confirmDelete" class="Content bg-[#41BC41] text-white rounded-lg" style="width: 96px; padding: 10px; font-size: 14px; font-family: Montserrat; font-weight: 700;">
                    CONFIRM
                </button>
                <!-- Cancel Delete Button -->
                <button id="cancelDelete" class="Content bg-[#BC4141] text-white rounded-lg" style="width: 96px; padding: 10px; font-size: 14px; font-family: Montserrat; font-weight: 700;">
                    CANCEL
                </button>
            </div>
        </div>
    </div>
    <!-- Success or Cancel Modal -->
    <div id="resultModal" class="modal" style="display:none;">
        <div id="resultMessage" class="Frame237698" style="width: 200px; padding: 12px 12px 8px 12px; border-radius: 8px; text-align: center; font-size: 16px; font-family: Montserrat; font-weight: 700; color: white;">
            <!-- Message will be dynamically inserted here (CONFIRMED or CANCELED) -->
        </div>
    </div>


    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden z-50">
        <div class="bg-white w-[399px] h-[155px] rounded-lg shadow-md border border-transparent flex flex-col items-center justify-center p-4">
            <div class="w-[379px] h-[54px] text-center text-black text-lg font-semibold font-montserrat break-words mb-1">
                Account Updated Successfully!
            </div>
            <div class="w-[96px] h-[37px] bg-[#41BC41] rounded-lg flex items-center justify-center mt-1">
                <button id="okButton" class="w-full h-full text-white text-sm font-bold rounded-lg focus:outline-none">
                    OK
                </button>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden z-50">
        <div class="bg-white w-[399px] h-[155px] rounded-lg shadow-md border border-transparent flex flex-col items-center justify-center p-4">
            <div class="w-[379px] h-[54px] text-center text-black text-lg font-semibold font-montserrat break-words mb-1">
                Error Message
            </div>
            <div class="w-[96px] h-[37px] bg-[#FF3B30] rounded-lg flex items-center justify-center mt-1">
                <button id="errorOkButton" class="w-full h-full text-white text-sm font-bold rounded-lg focus:outline-none">
                    OK
                </button>
            </div>
        </div>
    </div>


    <div id="sidebarExpanded" class="fixed top-0 left-0 w-[342px] h-screen px-[38px] py-[43px] bg-[#251599] rounded-tr-[40px] rounded-br-[40px] z-10 transform transition-transform duration-300 ease-in-out flex flex-col justify-between">
        <div class="self-stretch flex-col justify-start items-end gap-6 flex">
            <div id="closeButton" class="w-[39px] h-[39px] bg-white rounded-full shadow border border-[#e6e6e6] cursor-pointer flex items-center justify-center">
                <img src="./img/uip-icons/sideBar-close.png" alt="close">
            </div>

            <div class="self-stretch flex-col justify-start items-center gap-[47px] flex">
                <img id="sidebarLogo" class="w-[87px] h-[88px]" src="./img/uip-icons/UIP_solidA.png" alt="Logo" />
                <div class="self-stretch border border-[#d0d5dd]"></div>
                <div id="sidebarLinks" class="self-stretch flex-col justify-start items-start gap-[30px] flex">
                    <a href="./preboard.php" class="sidebar-link flex items-center gap-2 w-full px-4 py-2 text-white rounded text-base font-semibold border border-transparent hover:border-white">
                        <img src="./img/uip-icons/preboarding2.png" alt="Preboarding" class="w-5 h-5 mr-3">
                        <span class="sidebarText">Pre-Boarding</span>
                    </a>
                    <a href="./offboard.php" class="sidebar-link flex items-center gap-2 w-full px-4 py-2 text-white rounded text-base font-semibold border border-transparent hover:border-white">
                        <img src="./img/uip-icons/offboard.png" alt="Offboarding" class="w-5 h-5 mr-3">
                        <span class="sidebarText">Off-Boarding</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center gap-2 w-full px-3 py-2 bg-white rounded text-[#5041bc] text-base font-semibold border border-transparent hover:border-white">
                        <img src="./img/uip-icons/account2.png" alt="Account Page" class="w-7 h-7 mr-2">
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
            <a href="./login.html" class="self-stretch h-[34px] bg-white text-center text-[#5041bc] text-base font-semibold flex justify-center items-center rounded border border-transparent hover:border-white">
                <img src="./img/uip-icons/logout.png" alt="Logout" class="w-5 h-5 mr-5">
                <span class="sidebarText">Log out</span>
            </a>
        </div>
    </div>

    <div id="sidebarMinimized" class="fixed top-0 left-0 w-[100px] h-screen bg-[#251599] rounded-tr-[40px] rounded-br-[40px] z-10 transform transition-transform duration-300 ease-in-out flex flex-col justify-between p-[20px] hidden">
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col items-center gap-[100px]">
                <div id="openButton" class="w-[39px] h-[39px] bg-white rounded-full shadow border border-[#e6e6e6] cursor-pointer flex items-center justify-center">
                    <img src="./img/uip-icons/sideBar-open.png" alt="Open">
                </div>
                <img id="sidebarLogoMinimized" class="w-[50px] h-[50px]" src="./img/uip-icons/UIP_solidA.png" alt="Logo" />
                <div id="sidebarLinksMinimized" class="flex flex-col items-center gap-[20px]">
                    <a href="./dashboard.html" class="flex items-center justify-center w-[50px] h-[50px] rounded-full border border-transparent hover:border-white">
                        <img src="./img/uip-icons/preboarding2.png" alt="Preboarding" class="w-[20px] h-[20px]">
                    </a>
                    <a href="./offboard.html" class="flex items-center justify-center w-[50px] h-[50px] rounded-full border border-transparent hover:border-white">
                        <img src="./img/uip-icons/offboard.png" alt="Offboarding" class="w-[20px] h-[20px]">
                    </a>
                    <a href="#account" class="flex items-center justify-center w-[50px] h-[50px] bg-white rounded-full border border-transparent hover:border-white">
                        <img src="./img/uip-icons/account2.png" alt="Account Page" class="w-[40px] h-[40px]">
                    </a>
                </div>
            </div>

            <div id="sidebarFooterMinimized" class="flex flex-col items-center gap-[20px] mb-[20px]">
                <div class="w-[40px] h-[40px] bg-[#8a6767] rounded-full flex items-center justify-center">
                </div>
                <a href="./login.html" class="flex justify-center items-center w-[50px] h-[50px] bg-white text-center text-[#5041bc] rounded-full border border-transparent hover:border-white">
                    <img src="./img/uip-icons/logout.png" alt="Logout" class="w-5 h-5">
                </a>
            </div>
        </div>
    </div>


    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20">
        <div class="modal-content">
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="text-2xl font-bold mb-6 text-center">ADD ACCOUNT</h2>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-4">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" id="name" name="name" placeholder="Last Name,First Name M.I" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Example@example.com" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                        <input type="text" id="phone" name="phone" placeholder="ex. 09123456789" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">+ Add Account</button>
            </form>
        </div>
    </div>

    <!-- Edit Account Modal -->
    <div id="editAccountModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20 hidden">
        <div class="modal-content">
            <button id="closeEditAccountModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="text-2xl font-bold mb-6 text-center">Edit Account</h2>
            <form id="editAccountForm">
                <div class="grid grid-cols-1 gap-6 mb-4">
                    <div>
                        <label for="editName" class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" id="editName" name="editName" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="editEmail" class="block text-gray-700 font-medium mb-2">Email Address</label>
                        <input type="email" id="editEmail" name="editEmail" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="editAccountType" class="block text-gray-700 font-medium mb-2">Account Type</label>
                        <input type="text" id="editAccountType" name="editAccountType" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save Changes</button>
            </form>
        </div>
    </div>


    <!-- Change Password Modal -->
    <div id="changePasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm relative"> <!-- Reduced width here with max-w-sm -->
            <button id="closeChangePasswordModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="text-2xl font-bold mb-6 text-center">Change Password</h2>
            <form id="changePasswordForm">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-4">
                    <div>
                        <label for="currentPassword" class="block text-gray-700 font-medium mb-2">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword" placeholder="**********" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="newPassword" class="block text-gray-700 font-medium mb-2">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" placeholder="**********" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="confirmPassword" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="**********" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Change Password</button>
            </form>
        </div>
    </div>


    <section class="p-4 md:p-8" id="main-content">
        <div class="text-black font-montserrat font-bold leading-[44.8px]">
            <div class="flex flex-col items-start md:items-end space-y-4">
                <div class="flex flex-col md:flex-row justify-between items-center w-full">
                    <h1 class="text-2xl md:text-3xl">Account Page</h1>
                    <button id="addInternBtn" class="bg-[#624DE3] text-white px-4 py-1 rounded-lg flex items-center gap-2 hover:bg-[#1d1a4f]">
                        <img src="./img/uip-icons/add.png" alt="Add Intern" class="w-5 h-5">
                        <span>Add Account</span>
                    </button>
                </div>

                <!-- Table Section -->

                <div class="relative w-full max-w-xs md:max-w-md">
                    <input id="customSearch" type="text" placeholder="Search..."
                        class="w-full h-[45px] pl-4 pr-10 rounded-full bg-[#F5F3FF] text-black focus:outline-none" />
                    <button id="searchBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                        <img src="./img/uip-icons/search.png" alt="Search" class="w-5 h-5">
                    </button>
                </div>

                <div class="PreboardingDesktop relative bg-white p-10 mt-5 overflow-x-auto w-full">
                    <table class="min-w-full" id="example" data-order='[[ 0, "asc" ]]' data-page-length='10'>
                        <thead class="bg-white">
                            <tr>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">ID</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Name</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Email Address</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Account type</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]">Password</th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]"></th>
                                <th class="px-6 py-3 text-center font-montserrat text-[16px] font-bold leading-[16px]"></th>

                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "uip_preboarding_offboarding");
                                if ($conn->connect_error) {
                                    die("Connection Failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT id, name, email_address, account_type, password FROM accounts";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $rowIndex = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $bgColor = ($rowIndex % 2 == 0) ? 'bg-[#f7f6fe]' : 'bg-[#e5e7fe]';
                                        echo "<td class='$bgColor px-10 py-4 text-center whitespace-nowrap'>" . $row["id"] . "</td>";
                                        echo "<td class='$bgColor px-10 py-4 text-center whitespace-nowrap'>" . $row["name"] . "</td>";
                                        echo "<td class='$bgColor px-10 py-4 text-center whitespace-nowrap'>" . $row["email_address"] . "</td>";
                                        echo "<td class='$bgColor px-10 py-4 text-center whitespace-nowrap'>" . $row["account_type"] . "</td>";
                                        echo "<td class='$bgColor px-10 py-4 text-center whitespace-nowrap'>
                                        <button class='bg-[#624DE3] text-white px-6 py-2 rounded hover:bg-[#5038D3] transition-all duration-300' onclick='openChangePasswordModal(" . $row["id"] . ")'>
                                            Change
                                        </button>
                                      </td>";


                                        // Delete Button
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap text-center'>
                                        <button class='delete-account w-5 rounded' data-id='" . $row["id"] . "'>
                                            <img src='./img/uip-icons/delete.png' alt='delete'/>
                                        </button>
                                      </td>";

                                        // Edit Button in the PHP loop
                                        echo "<td class='$bgColor px-6 py-4 whitespace-nowrap text-center'>
                                        <button class='w-5 rounded edit-account' data-id='" . $row["id"] . "'>
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
        // Submit handler for change password form
        document.getElementById('changePasswordForm').addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent form submission
            const accountId = document.getElementById('changePasswordModal').getAttribute('data-account-id');
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                showErrorModal('New password do not match!');
                return;
            }

            // Send an AJAX request to change the password
            $.ajax({
                url: 'change_password.php',
                type: 'POST',
                data: {
                    id: accountId,
                    currentPassword: currentPassword,
                    newPassword: newPassword
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        showSuccessModal('Password changed successfully!');
                        // Close the modal and reset the form
                        const changePasswordModal = document.getElementById('changePasswordModal');
                        changePasswordModal.classList.remove('flex');
                        changePasswordModal.classList.add('hidden');
                        document.getElementById('changePasswordForm').reset();
                    } else {
                        showErrorModal('Failed: Incorrect current password');
                    }
                },
                error: function() {
                    showErrorModal('An error occurred while changing the password.');
                }
            });
        });

        // Function to show success modal
        function showSuccessModal(message) {
            const successModal = document.getElementById('successModal');
            successModal.querySelector('.text-center').textContent = message;
            successModal.classList.remove('hidden');
            successModal.classList.add('flex');
        }

        // Function to show error modal
        function showErrorModal(message) {
            const errorModal = document.getElementById('errorModal');
            errorModal.querySelector('.text-center').textContent = message;
            errorModal.classList.remove('hidden');
            errorModal.classList.add('flex');
        }

        // Hide modals on clicking the OK button
        document.getElementById('okButton').addEventListener('click', () => {
            document.getElementById('successModal').classList.add('hidden');
            document.getElementById('successModal').classList.remove('flex');
        });

        document.getElementById('errorOkButton').addEventListener('click', () => {
            document.getElementById('errorModal').classList.add('hidden');
            document.getElementById('errorModal').classList.remove('flex');
        });


        // Function to open the Edit Account modal
        function openEditAccountModal(accountId) {
            // Open the modal
            const editAccountModal = document.getElementById('editAccountModal');
            editAccountModal.classList.remove('hidden');
            editAccountModal.classList.add('flex');
            editAccountModal.setAttribute('data-account-id', accountId); // Store the account ID

            // Fetch account details via AJAX and populate the form
            $.ajax({
                url: 'get_account.php', // PHP script to fetch the account data
                type: 'GET',
                data: {
                    id: accountId
                },
                success: function(response) {
                    const accountData = JSON.parse(response);
                    document.getElementById('editName').value = accountData.name;
                    document.getElementById('editEmail').value = accountData.email_address;
                    document.getElementById('editAccountType').value = accountData.account_type;
                },
                error: function() {
                    alert('Failed to fetch account data.');
                }
            });
        }

        // Function to close the Edit Account modal
        document.getElementById('closeEditAccountModal').addEventListener('click', () => {
            const editAccountModal = document.getElementById('editAccountModal');
            editAccountModal.classList.remove('flex');
            editAccountModal.classList.add('hidden');
        });

        // Handle form submission for editing account
        document.getElementById('editAccountForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            const accountId = document.getElementById('editAccountModal').getAttribute('data-account-id');
            const updatedName = document.getElementById('editName').value;
            const updatedEmail = document.getElementById('editEmail').value;
            const updatedAccountType = document.getElementById('editAccountType').value;

            // Send the updated account data via AJAX to the server
            $.ajax({
                url: 'update_account.php',
                type: 'POST',
                data: {
                    id: accountId,
                    name: updatedName,
                    email: updatedEmail,
                    account_type: updatedAccountType
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        // Show the success modal
                        const successModal = document.getElementById('successModal');
                        successModal.classList.remove('hidden');

                        // Add event listener for the OK button
                        document.getElementById('okButton').addEventListener('click', function() {
                            successModal.classList.add('hidden');
                            location.reload(); // Reload the page to reflect the changes
                        });
                    } else {
                        alert('Failed to update account: ' + res.message);
                    }
                },
                error: function() {
                    alert('An error occurred while updating the account.');
                }
            });

        });

        // Function to handle account deletion
        function deleteAccount(accountId) {
            // Show the delete confirmation modal
            document.getElementById('deleteModal').style.display = 'flex';

            // Handle the "Confirm" button click
            document.getElementById('confirmDelete').addEventListener('click', function() {
                // AJAX request to delete the account
                $.ajax({
                    url: 'delete_account.php', // URL of the PHP script
                    type: 'POST',
                    data: {
                        id: accountId
                    },
                    success: function(response) {
                        const res = JSON.parse(response);

                        // Hide the delete confirmation modal
                        document.getElementById('deleteModal').style.display = 'none';

                        // Show the success message if the deletion was successful
                        if (res.status === 'success') {
                            showResultMessage('CONFIRMED', '#41BC41');
                            // Remove the row from the table
                            $('button[data-id="' + accountId + '"]').closest('tr').remove();
                        } else {
                            alert('Error: ' + res.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });

            // Handle the "Cancel" button click
            document.getElementById('cancelDelete').addEventListener('click', function() {
                // Hide the delete confirmation modal
                document.getElementById('deleteModal').style.display = 'none';

                // Show the cancel message
                showResultMessage('CANCELED', '#BC4141');
            });

            // When clicking outside the modal, close it
            window.onclick = function(event) {
                const modal = document.getElementById('deleteModal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };
        }

        // Function to show the result message modal
        function showResultMessage(message, bgColor) {
            const resultModal = document.getElementById('resultModal');
            const resultMessage = document.getElementById('resultMessage');

            resultMessage.textContent = message;
            resultMessage.style.backgroundColor = bgColor;

            // Show the result modal
            resultModal.style.display = 'flex';

            // Hide the result modal after 2 seconds
            setTimeout(() => {
                resultModal.style.display = 'none';
            }, 2000);
        }


        // Attach the event listener to delete buttons
        $(document).on('click', '.delete-account', function() {
            const accountId = $(this).data('id');
            deleteAccount(accountId);
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": [5, 5]
                }],
                "dom": '<"topBar d-flex justify-between"lr>t<"bottomBar d-flex justify-between"ip>',
            });
            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Attach the event listener to edit buttons
            $(document).on('click', '.edit-account', function() {
                const accountId = $(this).data('id');
                openEditAccountModal(accountId);
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

        // Function to open the Change Password modal
        function openChangePasswordModal(accountId) {
            // Open the modal
            const changePasswordModal = document.getElementById('changePasswordModal');
            changePasswordModal.classList.remove('hidden');
            changePasswordModal.classList.add('flex');
            changePasswordModal.setAttribute('data-account-id', accountId); // Store the account ID

            // Optionally, you can add more logic here to retrieve account info or do other tasks
        }

        // Function to close the Change Password modal
        document.getElementById('closeChangePasswordModal').addEventListener('click', () => {
            const changePasswordModal = document.getElementById('changePasswordModal');
            changePasswordModal.classList.remove('flex');
            changePasswordModal.classList.add('hidden');
        });

        // Submit handler for change password form
        document.getElementById('changePasswordForm').addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent form submission
            const accountId = document.getElementById('changePasswordModal').getAttribute('data-account-id');
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Handle password change logic here
            // Example: Submit form via AJAX to change password on the server
            console.log('Changing password for account ID:', accountId);
            console.log('Current Password:', currentPassword);
            console.log('New Password:', newPassword);

            // Add AJAX call to submit the form data to the server and process response
            // After successful password change, you can close the modal and clear the form

            // Close the modal after password change
            const changePasswordModal = document.getElementById('changePasswordModal');
            changePasswordModal.classList.remove('flex');
            changePasswordModal.classList.add('hidden');
            document.getElementById('changePasswordForm').reset(); // Clear form fields
        });
    </script>

</body>

</html>