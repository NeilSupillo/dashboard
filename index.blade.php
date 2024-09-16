<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Boarding Orientation Attendance Form</title>
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <script src="js/dataInsertion.js" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body class="overflow-x-hidden">
    <div class="w-full min-h-screen bg-white flex flex-col">
        <!-- Top Bar -->
        <div class="w-full h-20 p-5 bg-UIP-blue shadow flex items-center px-10">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-black/10 rounded-full">
                    <a target="_blank" href="https://www.uip.ph/">
                        <img src="./img/uip-icons/UIP_solidA.png">
                    </a>
                </div>
                <div class="text-white lg:text-2xl text-xl font-medium font-poppins"><a target="_blank"
                        href="https://www.uip.ph/">UIP Inc.</a></div>
            </div>
        </div>

        <!-- Form -->
        <form id="preboarding_form" class="form-container w-full max-w-4xl mt-10 px-4 mx-auto">
            <div class="text-center mb-10 font-montserrat">
                <h1 class="lg:text-5xl text-2xl font-montserrat font-bold text-UIP-orange pb-2">UNIFIED INTERNSHIP
                    <br>PROGRAM INC.</h1>
                <div class="lg:text-4xl text-xl font-montserrat font-bold text-UIP-blue">Pre-Boarding Orientation Form
                </div>
                <div class="lg:text-base text-sm font-poppins font-normal mt-2">Please fill in the required information
                    for the pre-boarding orientation.</div>
            </div>

            <!-- Form Fields -->
            <div class="space-y-10">
                <!-- Name and Intern Type -->
                <div class="form-group flex lg:flex-row flex-col gap-10 pt-4 lg:px-0 px-4">
                    <!-- Name Field -->
                    <div class="flex-1 flex flex-col gap-1">
                        <label class="lg:text-lg font-semibold">Name</label>
                        <input type="text" name="name" id="name_input"
                            class="px-3 py-2 border border-gray-300 rounded-md lg:text-lg"
                            placeholder="Last Name, First Name M.I" required />
                    </div>

                    <!-- Type of Intern Field -->
                    <div id="intern-form" class="flex-1 flex flex-col gap-1">
                        <label class="lg:text-lg font-semibold">Type of Intern</label>
                        <select id="intern_type"
                            class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-md h-11 pointer-events-auto">
                            <option id="intern_type_new" value="New Intern">New Intern</option>
                            <option id="intern_type_returning" value="Returning Intern">Returning Intern</option>
                            <option id="intern_type_voluntary" value="Voluntary Intern">Voluntary Intern</option>
                        </select>
                    </div>



                </div>

                <!-- Other Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:px-0 px-4 lg:text-lg">
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Email Address</label>
                        <input type="email" name="email" id="email_address"
                            class="px-3 py-2 border border-gray-300 rounded-md" placeholder="Enter your Email Address"
                            required />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Phone Number</label>
                        <input type="tel" name="phone" id="phone_number"
                            class="px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="e.g., +1-123-456-7890 or 0912345678" required />
                        <span class="text-sm text-gray-500">Format: +1-123-456-7890, 0912345678</span>
                    </div>


                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Facebook Link</label>
                        <input type="url" name="facebook" id="facebook_link"
                            class="px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter your Facebook profile link" required />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">School/University Name</label>
                        <input type="text" name="school" id="school_name"
                            class="px-3 py-2 border border-gray-300 rounded-md" placeholder="Enter your School Name"
                            required />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">School/University Contact Number or Email</label>
                        <input type="text" name="school-contact" id="school_contact"
                            class="px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter your school contact number or Email" required />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Course</label>
                        <input type="text" name="course" id="course" class="px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Ex. Bachelor of Science in Computer Engineering" required />
                    </div>
                    <div class=" flex flex-col gap-1">
                        <label class="font-semibold">Discord Server</label>
                        <a href="https://discord.gg/NcRqGFWeQd" target="_blank"
                            class="flex items-center cursor-pointer relative">
                            <input type="radio" name="discord-server" value="Join Server" class="hidden peer" />
                            <span
                                class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-md peer-checked:bg-UIP-blue hover:bg-UIP-blue hover:text-white">Join
                                Server</span>
                        </a>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Discord Username</label>
                        <input type="text" name="discord-username" id="discord_username"
                            class="px-3 py-2 border border-gray-300 rounded-md"
                            placeholder="Enter your Discord Username" required />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Hours Requirement</label>
                        <input type="text" name="hours" id="hours_requirement"
                            class="px-3 py-2 border border-gray-300 rounded-md" placeholder="Ex. 300 Hours" required />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Orientation Date</label>
                        <input type="date" name="orientation-date" id="orientation_date"
                            class="px-3 py-2 border border-gray-300 rounded-md" required />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Start Date</label><label class="text-sm font-normal">(Start Date of
                            your OJT/Internship)</label>
                        <input type="date" name="start-date" id="start_date"
                            class="px-3 py-2 border border-gray-300 rounded-md" required />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-semibold">Estimated End Date</label><label class="text-sm font-normal">(End
                            Date of your OJT/Internship)</label>
                        <input type="date" name="end-date" id="end_date"
                            class="px-3 py-2 border border-gray-300 rounded-md" required />
                    </div>
                </div>

                <!-- Privacy Agreement -->
                <div class="flex items-center gap-2 mt-4 lg:px-0 px-4">
                    <input type="checkbox" name="privacy" id="privacyCheck" class="mr-2" required />
                    <span class="lg:text-lg text-sm font-semibold">I agree that all information that I input is true and
                        I allow the organization to use it.</span>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-10 mb-10 pb-10 md:mb5">
                    <button type="submit" id="submitBtn" onclick=test()
                        class="px-6 py-3 bg-UIP-orange text-black rounded-md font-medium hover:bg-white hover:text-black border border-UIP-blue">Submit
                        <!-- Spinner Annimate Button -->
                        <!-- <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg" class="animate-spin h-5 w-5 mr-10">
                            <path d="M10 3.5C6.41015 3.5 3.5 6.41015 3.5 10C3.5 10.4142 3.16421 10.75 2.75 10.75C2.33579 10.75 2 10.4142 2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10C18 14.4183 14.4183 18 10 18C9.58579 18 9.25 17.6642 9.25 17.25C9.25 16.8358 9.58579 16.5 10 16.5C13.5899 16.5 16.5 13.5899 16.5 10C16.5 6.41015 13.5899 3.5 10 3.5Z" fill="#212121"/></svg> -->
                    </button>
                </div>
            </div>
        </form>

        <footer
            class="w-full bg-UIP-blue border-t border-gray-200 lg:py-12 py-8 flex flex-col md:flex-row justify-between items-center px-10">
            <div class="flex flex-col items-center md:items-start mb-6 md:mb-0">
                <div class="lg:text-lg text-xs text-white text-center md:text-left">
                    <div class="flex items-center justify-center lg:flex-row flex-col md:justify-start">
                        <a target="_blank" href="https://www.uip.ph/"><img src="./img/uip-icons/UIP_solidA.png"
                                alt="UIP Logo" class="w-10 h-10 lg:mr-4 mr-0 rounded-full mb-3 lg:mb-0"></a>
                        <span>UNIFIED INTERNSHIP PROGRAM INCORPORATED</span>
                    </div>
                    <div class="mt-2">2nd Floor Room 203C, E&V Building, 1039 Quirino Highway corner Dumalay Street,
                    </div>
                    <div>Brgy. Sta. Monica, Novaliches, Quezon City, 5th District, National Capital Region, 1123</div>
                </div>
            </div>

            <div class="flex justify-center space-x-6">
                <a target="_blank" href="mailto:info@uip.ph" class="text-white">
                    <i class="fas fa-envelope fa-2x"></i>
                </a>
                <a target="_blank" href="https://maps.app.goo.gl/eQqh1NYHSGYAZf5RA" class="text-white">
                    <i class="fas fa-map-marker-alt fa-2x"></i>
                </a>
                <a target="_blank" href="https://www.facebook.com/uipinc" class="text-white">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a target="_blank" href="https://www.instagram.com/uip_incorporated/" class="text-white">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a target="_blank" href="https://open.spotify.com/show/5bDTPJsg5QV6l7Brc5sT1U?si=384a7d1a40734c27"
                    class="text-white">
                    <i class="fab fa-spotify fa-2x"></i>
                </a>
                <a target="_blank" href="https://www.youtube.com/@UIPIncorporated" class="text-white">
                    <i class="fab fa-youtube fa-2x"></i>
                </a>
            </div>
        </footer>
    </div>  

    <!-- Modal HTML -->
    <div id="confirmation-modal"
        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden px-4 py-8 sm:px-6 sm:py-10">
        <div
            class="bg-white p-6 sm:p-8 border border-gray-300 rounded-md shadow-lg relative max-w-sm sm:max-w-md mx-auto">
            <img src="img/uip-icons/UIP_solidA.png" alt="Logo" class="absolute top-4 left-4 w-16 h-16" />
            <span class="absolute top-2 right-2 text-gray-500 cursor-pointer" id="modal-close">&times;</span>
            <p class="text-sm sm:text-lg font-semibold text-center mt-12">
                Your response is submitted successfully.<br><br>
                This is your application ID: <span id="application-id" class="font-bold"></span><br><br>
                Thank you!
            </p>
        </div>
    </div>


</body>

</html>