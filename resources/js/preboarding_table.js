import DataTable from "datatables.net-dt";

$(document).ready(function() {
 let table = new DataTable('#preboarding_table', {
    serverSide: true,
    processing: true,
    ajax: {
        url: 'api/get_preboarding_data',
        type: 'GET'
    },
    columns: [
        { data: 'app_id' },
        { data: 'name' },
        { data: 'email_address' },
        { data: 'intern_type' },
        { data: 'phone_number' },
        { data: 'facebook_link' },
        { data: 'course' },
        { data: 'school_name' },
        { data: 'school_contact' },
        { data: 'hours_requirement' },
        { data: 'discord_username' },
        { data: 'orientation_date' },
        { data: 'start_date' },
        { data: 'end_date' },
        { data: 'status' },
    ]   

 })
});