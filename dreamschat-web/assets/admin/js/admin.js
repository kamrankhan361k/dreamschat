/*
Author       : Dreamguys
Template Name: Dreamschat - Admin
Version      : 1.0
*/

"use strict";
window.onload = function () {

    if (envData.DB_INTERFACE_THEME == 'light'){
        $('body').removeClass('darkmode');  
    } else {
        $('body').addClass('darkmode');
    }
    //$('#phonenumber').intlTelInput();

    var table = $('.userTable').DataTable({
        "paging": true,
        "pageLength": 10,
    });
    var admin_id = $("#admin_id").val();
    var profilesetRef = firebase.database().ref("data/profileSettings/" + admin_id);
    profilesetRef.once('value', function(setsnapshot) {
        $(".admin_name").text(setsnapshot.val().userName);
        var userImage = (setsnapshot.val().image)?setsnapshot.val().image: baseUrl+'assets/img/user-placeholder.jpg';
        $(".admin_img").attr("src", userImage);
        $('.admin_img_pre').attr('src', userImage);
    });

    var userref = firebase.database().ref("data/users");
    userref.once("value")
        .then(function (snapshot) {
            $("#user_total_count").text(snapshot.numChildren());
        });

    var today = new Date()
    var curHr = today.getHours()

    if (curHr < 12) {
        $("#user_time").text('Good Morning');
    } else if (curHr < 18) {
        $("#user_time").text('Good Afternoon');
    } else {
        $("#user_time").text('Good Evening');
    }


      // Get the current date
var currentDate = new Date();

// Define an array of month names
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

// Define an array of day names
var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

// Get the day, date, month, and year
var dayName = dayNames[currentDate.getDay()];
var day = currentDate.getDate();
var monthName = monthNames[currentDate.getMonth()];
var year = currentDate.getFullYear();

// Build the formatted date string
var formattedDate = dayName + ", " + day + " " + monthName + " " + year;

// Set the content of the <h6> element to the formatted date
$('#current-date').text(formattedDate);
//document.getElementById("current-date").textContent = formattedDate;
    var callref = firebase.database().ref("data/calls");
    callref.once("value").then(function (snapshot) {
        $("#call_total_count").text(snapshot.numChildren());
    });

    var callref = firebase.database().ref("data/calls");
    callref.once("value").then(function (snapshot) {
        $("#videocalls_total_count").text(snapshot.numChildren());
    });

    var chatref = firebase.database().ref("data/chats");
    chatref.once("value").then(function (snapshot) {
         $("#chats_totals_count").text(snapshot.numChildren());
    });

    var statusref = firebase.database().ref("data/userstatus");
    statusref.once("value").then(function (snapshot) {
        $("#status_total_count").text(snapshot.numChildren());
    });

    var groupref = firebase.database().ref("data/groups");
    groupref.once("value").then(function (snapshot) {
        $("#groups_total_count").text(snapshot.numChildren());
    });

    var storiesDataTable = $('#user-status-list').DataTable({
        "bFilter": true,
        "ordering":false,
        "language": {
        search: ' ',
        searchPlaceholder: "Search...",
        paginate: {
          next: ' <i class="fas fa-chevron-right"></i>',
          previous: '<i class="fas fa-chevron-left"></i> '
      
        }
    },
    initComplete: (settings, json)=>{
        $('.dataTables_filter').appendTo('#tableSearch');
        $('.dataTables_filter').appendTo('.search-input');
    },  
    });

    var userstatusref = firebase.database().ref('data/userstatus').orderByChild("timeStamp");

    var totalStoriesCount = 1;
    userstatusref.on("child_added", function(snapshot) {
            var regdate = dateToString(snapshot.val().timeStamp);
            var logintime = getCurrentTime(snapshot.val().timeStamp);
            var id = snapshot.key;

            var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
            var user_array = id.split("-");
            var from_name = '';
            var email = '';
            var regdate = dateToString(snapshot.val().timeStamp);
            var logintime = getCurrentTime(snapshot.val().timeStamp);
            var imageval = baseUrl + 'assets/img/user-placeholder.jpg';

            var userstatusrefRef = firebase.database().ref("data/users/" + user_array[0]);
            userstatusrefRef.once('value', function(snapshot) {
                if (snapshot.val() != null) {
                    if (snapshot.val().firstName == null || snapshot.val().firstName == undefined || snapshot.val().firstName == '') {
                        from_name = user_array[0];
                    } else {
                        from_name = snapshot.val().firstName;
                    }
                    if (snapshot.val().email == null || snapshot.val().email == undefined || snapshot.val().email == '') {
                        email = user_array[0];
                    } else {
                        email = snapshot.val().email;
                    }

                    if (dateToString(snapshot.val().timeStamp) == null || dateToString(snapshot.val().timeStamp) == undefined || dateToString(snapshot.val().timeStamp) == '') {
                        regdate = user_array[0];
                    } else {
                        regdate = dateToString(snapshot.val().timeStamp);
                    }

                    if (getCurrentTime(snapshot.val().timeStamp) == null || getCurrentTime(snapshot.val().timeStamp) == undefined || getCurrentTime(snapshot.val().timeStamp) == '') {
                        logintime = user_array[0];
                    } else {
                        logintime = getCurrentTime(snapshot.val().timeStamp);
                    }
                    if (snapshot.val().image != "" && snapshot.val().image != undefined) {
                        imageval = snapshot.val().image;
                    }
                }
            });

            var tableRow = [
                totalStoriesCount,
                '<h2 class="table-avatar"><a href="javascript:;" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="' + imageval + '" alt="User Image"></a><a href="javascript:;">' + from_name + ' </a></h2>',
                divid,
                email,
                regdate,
                logintime,
                '<div class="actions"><a href="#" class="btn btn-sm bg-danger-light" data-bs-toggle="modal" data-bs-target="#delete-user" onclick="delete_userstatus(\'' + snapshot.key + '\')"><i class="bx bx-trash"></i></a></div>'
            ];

            // Add the row to the DataTable and draw it
            storiesDataTable.row.add(tableRow).draw();

            var totalStories = storiesDataTable.rows().count();
            $("#userstories_total_count").text(totalStories);

            totalStoriesCount++;
    });


    userref.orderByChild("username").limitToLast(5).on("child_added", function(snapshot) {
        // Check if the "username" field exists in the data
       
        if (snapshot.val() && snapshot.val().username) {
            var imageval = baseUrl + 'assets/img/avatar-8.jpg';
            var lastSeen = '';
           
            var regdate = dateToString(snapshot.val().timeStamp);
            var lastSeen = getCurrentTime(snapshot.val().timeStamp);
            var country_name = snapshot.val().country_name ? snapshot.val().country_name : '--';

            var tableRow = $('<tr><td> <h2 class="table-avatar"> <a href="javascript:;"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/user-placeholder.jpg" alt="User Image">' + snapshot.val().username + '</a> </h2></td><td> ' + regdate + '</td><td>' + lastSeen + '</td><td>' + country_name + '</td></tr>');
    
            $('#user-list-table').prepend(tableRow);
        }
    });

    var groupref = firebase.database().ref("data/groups");

    groupref.orderByChild("date").limitToLast(5).on("child_added", function(snapshot) {
        // Check if the "username" field exists in the data
        if (snapshot.val()) {
            var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
            var lastSeen = '';
            var userIds = snapshot.val().userIds;
            var usercount = userIds.length;
            var members = snapshot.val().members;
            var date = dateToString(snapshot.val().date);

            var tableRow = $('<tr><td> <h2 class="table-avatar"> <a href="javascript:;"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="assets/img/user-placeholder.jpg" alt="User Image">' + snapshot.val().name + '</a> </h2></td><td> ' + date + '</td> <td>' + usercount + '</td></tr>');
    
           $('#groups-list-table').prepend(tableRow);
        }
    });
    
    var userDataTable = $('#userlist-list-table').DataTable({
        "bFilter": false,
        "ordering":false,
        "language": {
        search: ' ',
                searchPlaceholder: "Search...",
                paginate: {
                  next: ' <i class="fas fa-chevron-right"></i>',
                  previous: '<i class="fas fa-chevron-left"></i> '
              
                }
    },
        initComplete: (settings, json)=>{
            $('.dataTables_filter').appendTo('#tableSearch');
            $('.dataTables_filter').appendTo('.search-input');
         },  
    });
   
    
   
    var totalUserCount = 1; // Initialize the count to 0

    var userRef = firebase.database().ref('data/users');
   
    userRef.on("child_added", function (snapshot) {
        // var imageval = baseUrl + 'assets/img/avatar-8.jpg';
        var imageval = baseUrl + 'assets/img/user-placeholder.jpg';

       
        var lastSeen = '';
        var mobileNumber = snapshot.val().mobile_number; // Access the mobile number field

        lastSeen = secondsToString(snapshot.val().timeStamp);

        if (snapshot.val().image != "" && snapshot.val().image != undefined) {
            imageval = snapshot.val().image;
        }

        if (snapshot.val().adminblock == true) {
            var adminblocktext = 'Unblock';
            var colorte = 'success';
            var funtext = 'unblock';
            var classtex = 'block_user';
        } else {
            var adminblocktext = 'Block';
            var colorte = 'warning';
            var funtext = 'block';
            var classtex = 'user';
        }

        var regdate = dateToString(snapshot.val().timeStamp) || '--';
        var logintime = getCurrentTime(snapshot.val().timeStamp) || '--';
        var email = snapshot.val().email || '--';
        var mobile_no = snapshot.val().id || '--';
        var country_name = snapshot.val().country_name || '--';
        var username = snapshot.val().nameToDisplay || '--';

        //if (snapshot.val().adminblock === false || snapshot.val().adminblock == undefined) {
            // Assuming you have a DataTable instance named userDataTable
        var columnToDisableSorting = 2; // Change this to the index of the column for which you want to disable sorting

            userDataTable.row.add([
            totalUserCount, // Column 1
            '<h2 class="table-avatar"><a href="javascript:;" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="'+imageval+'" alt="User Image"></a><a href="javascript:;">' + username + '</a></h2>', // Column 2
            mobile_no, // Column 3
            email, // Column 4
            regdate, // Column 5
            logintime, // Column 6
            country_name, // Column 7
            lastSeen, // Column 8
            '<div class="dropdown dropdown-action table-dropdown"><a href="javascript:;" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu dropdown-menu-end"><ul><li><a class="dropdown-item" href="#" onclick="edit_users(\'' + snapshot.key + '\')" data-bs-toggle="modal" data-bs-target="#modal-edituser"><i class="bx bx-edit"></i> Edit User</a></li><li><a class="dropdown-item" href="javascript:;" onclick="block_users(\'' + snapshot.key + '\')"><i class="bx bx-block me-2"></i>' + adminblocktext + ' User</a></li><li><a class="dropdown-item" href="javascript:;" onclick="delete_users(\'' + snapshot.key + '\')"><i class="bx bx-trash-alt me-2"></i>Delete</a></li></ul></div></div>' // Column 9
            ]).draw();
            userDataTable.order([]).draw();


            totalUserCount++;

            var totalUsers = userDataTable.rows().count();
            $("#userspage_total_count").text(totalUsers);
        //}
    });

    var blockDataTable = $('#blockList-list-table').DataTable({
        "bFilter": true,
        "ordering":false,
        "language": {
        search: ' ',
                searchPlaceholder: "Search...",
                paginate: {
                  next: ' <i class="fas fa-chevron-right"></i>',
                  previous: '<i class="fas fa-chevron-left"></i> '
              
                }
    },
        initComplete: (settings, json)=>{
            $('.dataTables_filter').appendTo('#tableSearch');
            $('.dataTables_filter').appendTo('.search-input');
        },  
    });

    var blockedUserCount = 1; // Initialize the count to 0
    var blockedUserRef = firebase.database().ref("data/users");
    blockedUserRef.orderByChild("timeStamp").on("child_added", function(snapshot) {
        var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
       
        var lastSeen = '';
        var mobileNumber = snapshot.val().mobile_number; // Access the mobile number field

        lastSeen = secondsToString(snapshot.val().timeStamp);

        if (snapshot.val().image != "" && snapshot.val().image != undefined) {
            imageval = snapshot.val().image;
        }

        if (snapshot.val().adminblock == true) {
            var adminblocktext = 'Unblock';
            var colorte = 'success';
            var funtext = 'unblock';
            var classtex = 'block_user';
        } else {
            var adminblocktext = 'Block';
            var colorte = 'warning';
            var funtext = 'block';
            var classtex = 'user';
        }

        // Check if the "username" field exists in the data
        if (snapshot.val()) {  //&& snapshot.val().username
            var regdate = dateToString(snapshot.val().timeStamp) || '--';
            var logintime = getCurrentTime(snapshot.val().timeStamp) || '--';
            var email = snapshot.val().email || '--';
            var country_name = snapshot.val().country_name || '--';

            var mobile_no = snapshot.val().id || '--';
            if (snapshot.val().adminblock === true) {
                blockDataTable.row.add([
                    blockedUserCount,
                    '<h2 class="table-avatar"><a href="javascript:;" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="' + imageval + '" alt="User Image"></a><a href="javascript:;">' + snapshot.val().firstName + '</a></h2>',
                    mobile_no,
                    email,
                    regdate,
                    logintime,
                    country_name,
                    '<div class="blocked-group"><a href="javascript:;" class="btn blocked-btn">Blocked</a></div>',
                    '<div class="dropdown dropdown-action table-dropdown"><a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu dropdown-menu-end"><ul><li><a class="dropdown-item" href="javascript:;" onclick="unblock_users(\'' + snapshot.key + '\')"><i class="bx bx-block me-2"></i>' + adminblocktext + ' User</a></li></ul></div></div>'
                ]).draw();

                blockedUserCount++;

                var totalBlocked = blockDataTable.rows().count();
                $("#userspageblocked_total_count").text(totalBlocked);
            }
        }
    });
     
    var reportDataTable = $('#reporteruser-list-table').DataTable({
        "bFilter": true,
        "ordering":false,
        "language": {
        search: ' ',
        searchPlaceholder: "Search...",
        paginate: {
          next: ' <i class="fas fa-chevron-right"></i>',
          previous: '<i class="fas fa-chevron-left"></i> '
      
        }
    },
    initComplete: (settings, json)=>{
        $('.dataTables_filter').appendTo('#tableSearch');
        $('.dataTables_filter').appendTo('.search-input');
    },  
    });

    var reportUserCount = 1;

    var reportref  = firebase.database().ref('data/report').limitToFirst(100);
    reportref .on("child_added", function(snapshot) {
        firebase.database().ref("data/users/"+snapshot.val().reportUser).once('value', function(usershot) {
        if (usershot.val() != null) {
            var online = 'Online';
            var onlineclass = 'success';
            var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
            var lastSeen = '';
            var mobileNumber = usershot.val().id || '--'; // Access the mobile number field

            if (usershot.val().online == false) {
                online = 'Offline';
                onlineclass = 'danger';
                lastSeen = secondsToString(usershot.val().timeStamp);
            } else {
                lastSeen = '--';
            }

            if (usershot.val().image != "" && usershot.val().image != undefined) {
                imageval = usershot.val().image;
            }

            if (usershot.val().adminblock == true) {
                var adminblocktext = 'Unblock';
                var colorte = 'success';
                var funtext = 'unblock';
                var classtex = 'block_user';
            } else {
                var adminblocktext = 'Block';
                var colorte = 'warning';
                var funtext = 'block';
                var classtex = 'user';
            }

            if (usershot.val()) {
                var data = usershot.val();
                var id = snapshot.key;
                var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");

                var name = usershot.val().firstName;
                var regdate = dateToString(snapshot.val().timeStamp) || '--';
                var logintime = getCurrentTime(snapshot.val().timeStamp) || '--';
                var email = usershot.val().email || '--';
                var country_name = usershot.val().country_name || '--';
                var mobile_no = usershot.val().id || '--';

                //var reportedBy = snapshot.val().reportBy || '--';
                firebase.database().ref("data/users/"+snapshot.val().reportBy).once('value', function(usershots) {
                 var reportedBy = usershots.val().firstName || snapshot.val().reportBy;

                var tableRow = [
                    reportUserCount,
                    '<h2 class="table-avatar"><a href="javascript:;" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="' + imageval + '" alt="User Image"></a><a href="javascript:;">' + usershot.val().firstName + '</a></h2>',
                    mobile_no,
                    email,
                    regdate,
                    logintime,
                    reportedBy,
                    '<div class="actions"><span class="text-end"><a href="#" class="btn btn-sm bg-danger-light" onclick="delete_report(\'' + snapshot.key + '\')"><i class="bx bx-trash"></i></a></span></div>'
                ];

                reportDataTable.row.add(tableRow).draw();
                });
                reportUserCount++;

                var totalReports = reportDataTable.rows().count();
                $("#report_total_count").text(totalReports);
            }
        }
        });
    });

    var chatDataTable = $('#chats-list-table').DataTable({
        "bFilter": true,
        "ordering":false,
        "language": {
        search: ' ',
                searchPlaceholder: "Search...",
                paginate: {
                  next: ' <i class="fas fa-chevron-right"></i>',
                  previous: '<i class="fas fa-chevron-left"></i> '
              
                }
    },
        initComplete: (settings, json)=>{
            $('.dataTables_filter').appendTo('#tableSearch');
            $('.dataTables_filter').appendTo('.search-input');
        },  
    });      
    
    var chatref = firebase.database().ref("data/chats");
    var totalChatCount = 1; // Initialize the total chat count

    chatref.orderByChild("date").on("child_added", function(snapshot) {
        var id = snapshot.key;
        var substring1 = "roup";

        if (id.indexOf(substring1) !== 1) {
            var groupchatref = firebase.database().ref("data/chats/" + id);

            groupchatref.once("value").then(function(childsnapshot) {
                $('#tdchat_' + divid).text(childsnapshot.numChildren());
                var test = childsnapshot.numChildren();
                

                var user_array = id.split("-");
                var from_name = '';
                var to_name = '';

                var fromusersRef = firebase.database().ref("data/users/" + user_array[0]);
                fromusersRef.once('value', function(snapshot) {
                    if (snapshot.val() != null) {
                        if (snapshot.val().username == null || snapshot.val().username == undefined || snapshot.val().username == '') {
                            from_name = user_array[0];
                        } else {
                            from_name = snapshot.val().username;
                        }
                    }
                });

                var tousersRef = firebase.database().ref("data/users/" + user_array[1]);
                tousersRef.once('value', function(snapshot) {
                    if (snapshot.val() != null) {
                        if (snapshot.val().username == null || snapshot.val().username == undefined || snapshot.val().username == '') {
                            to_name = user_array[1];
                        } else {
                            to_name = snapshot.val().username;
                        }
                    }
                });

                from_name = from_name == null || from_name == '' ? '--' : from_name;
                to_name = to_name == null || to_name == '' ? '--' : to_name;

                var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
                var admin_id = $('#admin_id').val();

                var tableRow = [
                    totalChatCount,
                    '<h2 class="table-avatar"><a href="javascript:;" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user-placeholder.jpg" alt="User Image"></a><a href="javascript:;">' + from_name + '</a></h2>',
                    '<h2 class="table-avatar"><a href="javascript:;" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user-placeholder.jpg" alt="User Image"></a><a href="javascript:;">' + to_name + '</a></h2>',
                    '<td id="tdchat_' + divid + '">'+test+'</td>',
                    '<td class="text-end"><div class="actions"><a onclick="delete_chats(\'' + snapshot.key + '\')" href="#" class="btn btn-sm bg-danger-light"><i class="bx bx-trash"></i></a></div></td>'
                ];

                chatDataTable.row.add(tableRow).draw();
                totalChatCount++;

                var totalChats = chatDataTable.rows().count();
                $("#chats_total_count").text(totalChats);
            });
        }
    });

    var callDataTable = $('#calls-list-table').DataTable({
        "bFilter": true,
        "ordering":false,
        "language": {
        search: ' ',
                searchPlaceholder: "Search...",
                paginate: {
                  next: ' <i class="fas fa-chevron-right"></i>',
                  previous: '<i class="fas fa-chevron-left"></i> '
              
                }
    },
        initComplete: (settings, json)=>{
            $('.dataTables_filter').appendTo('#tableSearch');
            $('.dataTables_filter').appendTo('.search-input');
        },  
    });

    var callref = firebase.database().ref("data/calls");
    var totalcallsCount = 1;
    callref.on("child_added", function(snapshot) {
        var data = snapshot.val();
        var id = snapshot.key;
        var incount = 0;
        var outcount = 0;
        var misscount = 0;
        var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");

        var user_array = id.split("-");
        var from_name = '';

        var fromcallRef = firebase.database().ref("data/users/" + user_array[0]);

        // Create a promise to handle the asynchronous Firebase query
        var getNamePromise = new Promise(function(resolve, reject) {
            fromcallRef.once('value', function(snapshot) {
                if (snapshot.val() != null) {
                    if (snapshot.val().username == null || snapshot.val().username == undefined || snapshot.val().username == '') {
                        from_name = user_array[0];
                    } else {
                        from_name = snapshot.val().username;
                    }
                }
                resolve(); // Resolve the promise when the data is fetched
            });
        });

        // Use the promise to wait for the data to be fetched before proceeding
        getNamePromise.then(function() {
            from_name = from_name == null || from_name == '' ? '--' : from_name;

            // Loop through child nodes of the current snapshot
            snapshot.forEach(function(childSnapshot) {
                var childData = childSnapshot.val();
                if (childData.inOrOut == 'IN') {
                    incount++;
                } else if (childData.inOrOut == 'OUT') {
                    outcount++;
                } else if (childData.inOrOut == 'CANCELED') {
                    misscount++;
                }
            });

            // Create an array for the DataTable row
            var tableRow = [
                totalcallsCount,
                from_name,
                incount,
                outcount,
                misscount,
                '<div class="actions"><a onclick="delete_calls(\'' + snapshot.key + '\')" href="#" class="btn btn-sm bg-danger-light"><i class="bx bx-trash"></i></a></div>'
            ];

            // Add the row to the DataTable and draw it
            callDataTable.row.add(tableRow).draw();
            totalcallsCount++;
            // Update the total count of calls with the number of rows in the table
            var totalCalls = callDataTable.rows().count();
            $("#calls_total_count").text(totalCalls);
        });
    });

    userref.on("child_removed", function (snapshot) {
        var id = snapshot.key;
        var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
        $('#tr_' + divid).remove();
    });
    groupref.on("child_removed", function (snapshot) {
        var id = snapshot.key;
        var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
        $('#tr_' + divid).remove();
    });
    callref.on("child_removed", function (snapshot) {
        var id = snapshot.key;
        var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
        $('#trcall_' + divid).remove();
    });

    reportref.on("child_removed", function (snapshot) {
        var id = snapshot.key;
        var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
        $('#trreport_' + divid).remove();
    });

    $("#search-admin-content").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        var $userTableRows = $("#user-list-table tr");
        var found = false;
        
        $userTableRows.each(function () {
            var rowText = $(this).text().toLowerCase();
            var isVisible = rowText.indexOf(value) > -1;
            $(this).toggle(isVisible);
            if (isVisible) {
                found = true;
            }
        });
        
        if (!found) {
            $("#error-message").show();
        } else {
            $("#error-message").hide();
        }
    });
    $("#search-group-content").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        var $userTableRows = $("#groups-list-table tr");
        var found = false;
        
        $userTableRows.each(function () {     
            var rowText = $(this).text().toLowerCase();
            var isVisible = rowText.indexOf(value) > -1;
            $(this).toggle(isVisible);
            if (isVisible) {
                found = true;
            }
        });
        if (!found) {
            $("#errorr-message").show();
        } else {
            $("#errorr-message").hide();
        }
    });

   
    $("#search-blocklistadmin-content").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        var $userTableRows = $(".blockuser-list-table tr");
        var found = false;
        
        $userTableRows.each(function () {
            var rowText = $(this).text().toLowerCase();
            var isVisible = rowText.indexOf(value) > -1;
            $(this).toggle(isVisible);
            if (isVisible) {
                found = true;
            }
        });
        
        if (!found) {
            $("#blockerror-messages").show();
        } else {
            $("#blockerror-messages").hide();
        }
    });
}

$("#search-userlistadmin-content").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $("#reporteruser-list-table tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#usererror-messages").show();
    } else {
        $("#usererror-messages").hide();
    }
});

$("#search-userlist-content").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $("#userlist-list-table tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#usererror-messages").show();
    } else {
        $("#usererror-messages").hide();
    }
});

$("#search-blocklist-content").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $("#blockList-list-table tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#usererror-messages").show();
    } else {
        $("#usererror-messages").hide();
    }
});

$("#search-chatlistadmin-content").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $("#chats-list-table tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#chaterror-messages").show();
    } else {
        $("#chaterror-messages").hide();
    }
});

$("#search-calllistadmin-content").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $("#calls-list-table tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#callerror-messages").show();
    } else {
        $("#callerror-messages").hide();
    }
});


$("#search-reportlistadmin-content").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $(".reportlist-list-table tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#reporterror-messages").show();
    } else {
        $("#reporterror-messages").hide();
    }
});


$("#search-reportlistadmin-content").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $(".reportlist-list-table tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#reporterror-messages").show();
    } else {
        $("#reporterror-messages").hide();
    }
});

$("#search-story-content").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $(".user-status-list tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#storyerror-message-messages").show();
    } else {
        $("#storyerror-message-messages").hide();
    }
});
    
    


function updateblock_users(id) {
    firebase.database().ref('data/users/' + id).update({
        adminblock: true
    });
    var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
    $('#tr_' + divid).remove();
    toastr.success("User Blocked Successfully!");
}

function updateunblock_users(id) {
    firebase.database().ref('data/users/' + id).update({
        adminblock: false
    });
    var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
    $('#tr_' + divid).remove();
    toastr.success("User Unblocked Successfully!");
}

function block_users(id) {
    firebase.database().ref('data/users/' + id).update({
        adminblock: true // Set adminblock to true to block the user
    });
    var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
    $('#tr_' + divid).remove();
    toastr.success("User Blocked Successfully!");
    setTimeout(function() {
      window.location.reload();
    }, 2000); // Adjust the delay as needed
}

function unblock_users(id) {
    firebase.database().ref('data/users/' + id).update({
        adminblock: false
    });
    var divid = id.replace(/[.*+?^${}()|[\]\\]/g, "");
    $('#tr_' + divid).remove();
    toastr.success("User Unblocked Successfully!");
    setTimeout(function() {
      window.location.reload();
    }, 2000); // Adjust the delay as needed
}

function delete_groups(id) {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            firebase.database().ref("data/groups/" + id).remove();
            swal("Success!", "Group Deleted Successfully!", "success");
        }
    });
}

function delete_chats(id) {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            firebase.database().ref("data/chats/" + id).remove();
            toastr.success("Chat Deleted Successfully!");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });
}



function delete_users(id) {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            firebase.database().ref("data/users/" + id).remove();
            toastr.success("User Deleted Successfully!");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });

}

function delete_userstatus(id) {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            firebase.database().ref("data/userstatus/" + id).remove();
            toastr.success("User Status Deleted Successfully!");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });

}


function delete_report(id) {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            firebase.database().ref("data/report/" + id).remove();
            toastr.success("User Report Deleted Successfully!");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });

}

function delete_calls(id) {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        cancelButtonClass: "swal-button--cancel",
    }).then((willDelete) => {
        if (willDelete) {

            firebase.database().ref("data/calls/" + id).remove();
            toastr.success("Calls Deleted Successfully!");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });
}

function insertagora() {
    var agorakey = $("#agora_appkey").val();
    if (!agorakey) {
        toastr.warning("Please Enter Application Key!");
    } else {
        $.ajax({
            url: 'admin/insertagora',
            type: 'POST',
            data: {
                agorakey: agorakey
            },
            success: function(data) {
                toastr.success("Updated Successfully!");
                setTimeout(function() {
                  window.location.reload();
                }, 2000); // Adjust the delay as needed
            }
        });
    }
}

function insertfirbasevalue() {
    var appkey = $("#appkey").val();
    var authdomain = $("#authdomain").val();
    var dburl = $("#dburl").val();
    var projectid = $("#projectid").val();
    var storagebugket = $("#storagebugket").val();
    var messageid = $("#messageid").val();
    var appid = $("#appid").val();
    
    if (!appkey) {
        toastr.warning("Please enter application key!");
    } else if (!authdomain) {
        toastr.warning("Please enter authenticated domain!");
    } else if (!dburl) {
        toastr.warning("Please enter databse url!");
    } else if (!projectid) {
        toastr.warning("Please enter project id!");
    } else if (!storagebugket) {
        toastr.warning("Please enter storage bugket!");
    } else if (!messageid) {
        toastr.warning("Please enter message id!");
    } else if (!appid) {
        toastr.warning("Please enter application id!");
    }
      else {
        $.ajax({
            url: 'admin/insertfirebasevalue',
            type: 'POST',
            data: {
                appkey: appkey,
                authdomain: authdomain,
                dburl: dburl,
                projectid: projectid,
                storagebugket: storagebugket,
                messageid: messageid,
                appid: appid,
               

            },
            success: function(data) {
                toastr.success("Updated Succeessfully!");
                setTimeout(function() {
                  window.location.reload();
                }, 2000); // Adjust the delay as needed
            }
        });
    }
}

function insertwebsitesettings() {
   var company_name = $("#company_name").val();
    var company_email = $("#company_email").val();
    var company_phonenumber = $("#company_phonenumber").val();
    var company_address = $("#company_address").val();
    var company_country = $("#company_country").val();
    var company_state = $("#company_state").val();
    var company_city = $("#company_city").val();
    var company_postalcode = $("#company_postalcode").val();
    var company_fax = $("#company_fax").val();
    var company_logo = $('#company_logo').prop('files')[0];
    var company_icon = $('#company_icon').prop('files')[0];
    var favicon = $('#favicon').prop('files')[0];
    var form_data = new FormData();
    form_data.append('company_name', company_name);
    form_data.append('company_email', company_email);
    form_data.append('company_phonenumber', company_phonenumber); 
    form_data.append('company_address', company_address);
    form_data.append('company_country', company_country);
    form_data.append('company_state', company_state);
    form_data.append('company_city', company_city);
    form_data.append('company_postalcode', company_postalcode);
   
    form_data.append('company_fax', company_fax);
   
    form_data.append('company_logo', company_logo);
    form_data.append('hcompany_logo', $("#hcompany_logo").val());
    form_data.append('company_icon', company_icon);
    form_data.append('hcompany_icon', $("#hcompany_icon").val());
    form_data.append('favicon', favicon);
    form_data.append('hfavicon', $("#hfavicon").val());
    

    
    $.ajax({
        url: 'admin/insertwebsitesettings',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            if (response === 'success') {
                toastr.success("Settings saved successfully");
                setTimeout(function() {
                  window.location.reload();
                }, 2000); // Adjust the delay as needed
            } else {
                toastr.error("An error occurred while saving settings");
            }
        },
        error: function () {
            toastr.error("An error occurred while making the request");
        }
    });
}

function toggleTheme(theme) {
    // Replace this with your theme toggling logic
    console.log("Toggling theme to: " + theme);
    //insertappearancesettings(theme);
}

$(document).ready(function() {
    
    $(".theme-image").click(function() {
       
        var onclickValue = $(this).attr("onclick");
        
        var matches = /toggleTheme\(['"]([^'"]+)['"]\)/.exec(onclickValue);
        if (matches && matches.length === 2) {
            var theme = matches[1];  
            
            $('#theme_color').val(theme);
            console.log("Clicked on theme: " + theme);   
            //insertappearancesettings(theme);
        }
    });
});

function insertappearancesettings() {
    var theme_color = $('#theme_color').val(); 
    var form_data = new FormData();
    form_data.append('theme_color', theme_color);

    $.ajax({
        url: 'admin/insertappearancesettings', // Replace with the correct URL
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            if (response == 'success') {
                toastr.success("Settings saved successfully!");
                setTimeout(function() {
                  window.location.reload();
                }, 2000); // Adjust the delay as needed
            } else {
                toastr.error("Failed to save settings");
            }
        },
        error: function (xhr, status, error) {
            toastr.error("Failed to save settings: " + error);
        }
    });
}

function lightappearancesettings() {
    var theme_color = 'light'; 
    var form_data = new FormData();
    form_data.append('theme_color', theme_color);

    $.ajax({
        url: 'admin/insertappearancesettings', // Replace with the correct URL
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            if (response == 'success') {
                toastr.success("Updated Succeessfully!");
                setTimeout(function() {
                  window.location.reload();
                }, 2000); // Adjust the delay as needed
            } else {
                toastr.error("Failed to save settings");
            }
        },
        error: function (xhr, status, error) {
            toastr.error("Failed to save settings: " + error);
        }
    });
}

function darkappearancesettings() {
    var theme_color = 'dark'; 
    var form_data = new FormData();
    form_data.append('theme_color', theme_color);

    $.ajax({
        url: 'admin/insertappearancesettings', // Replace with the correct URL
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            if (response == 'success') {
                toastr.success("Updated Succeessfully!");
                setTimeout(function() {
                  window.location.reload();
                }, 2000); // Adjust the delay as needed
            } else {
                toastr.error("Failed to save settings");
            }
        },
        error: function (xhr, status, error) {
            toastr.error("Failed to save settings: " + error);
        }
    });
}

function secondsToString(millis) {
    var currentMillis = new Date().getTime();
    var elapsedMillis = currentMillis - millis;
    var date = new Date(millis);

    if (elapsedMillis < 10000) {
        return 'Just now';
    } else if (elapsedMillis < 60000) {
        var seconds = Math.floor(elapsedMillis / 1000);
        return seconds + ' seconds ago';
    } else if (elapsedMillis < 3600000) {
        var minutes = Math.floor(elapsedMillis / 60000);
        return minutes + ' minutes ago';
    } else if (elapsedMillis < 86400000) {
        var hours = Math.floor(elapsedMillis / 3600000);
        return hours + ' hours ago';
    } else {
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return padZero(day) + '-' + padZero(month) + '-' + year;
    }
}

function padZero(number) {
    return (number < 10 ? '0' : '') + number;
}


function getCurrentTime(timestamp) {
    const date = new Date(timestamp);
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';

    // Convert hours from 24-hour format to 12-hour format
    const formattedHours = (hours % 12) || 12;

    const formattedTime = `${padZero(formattedHours)}.${padZero(minutes)} ${ampm}`;
    return formattedTime;
}

function padZero(number) {
    return (number < 10 ? '0' : '') + number;
}

// Example usage:
const timestamp = 1632183540000; // Replace this with the actual timestamp you have
const registrationTime = getCurrentTime(timestamp);



function dateToString(millis) {
    var date = new Date(millis);
    var day = date.getDate();
    var month = date.toLocaleString('default', { month: 'short' });
    var year = date.getFullYear();
    return padZero(day) + ' ' + month + ' ' + year;
}

function padZero(number) {
    return (number < 10 ? '0' : '') + number;
}

function isPhoneNumberValid(phonenumber) {
    var pattern = /^\+[0-9\s\-\(\)]+$/;
    return phonenumber.search(pattern) !== -1;
}

    $(document).ready(function() {
        // Get references to the elements
        var $fileInput = $('#drop-zone-profile-file');
        var $imagePreview = $('#add_image');

        // Listen for changes in the file input
        $fileInput.on('change', function(e) {
            var file = e.target.files[0];

            if (file) {
                // Create a FileReader object
                var reader = new FileReader();

                // Set up a function to run when the image is loaded
                reader.onload = function(e) {
                    // Set the source of the image preview to the selected file
                    $imagePreview.attr('src', e.target.result);
                };

                // Read the selected file as a data URL (base64 encoded)
                reader.readAsDataURL(file);
            } else {
                // If no file is selected or an error occurs, set a default image
                $imagePreview.attr('src', 'assets/img/avatar/avatar-2.jpg');
            }
        });
    });

function addnewuser() {
   var phonenumber = $("#phonenumber").val();
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var password = $('#password').val();
    var email_id = $('#email').val();
    var dropprofilefile= $('#dropprofilefile')[0].files;
    var country_name=$('#country_name').val();

   var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    
    if (firstname == '') {
        toastr.warning("Kindly please fill the firstname");
        return false;
    }
    if (lastname == '') {
        toastr.warning("Kindly please fill the lastname");
        return false;
    }
    if (password == '') {
        toastr.warning("Kindly please fill the password");
        return false;
    }
    if (email_id == '') {
        toastr.warning("Kindly please fill the email_id");
        return false;
    }
    if (email_id == '') {
        toastr.warning("Kindly please fill the email_id");
        return false;
    }
    if (dropprofilefile == '') {
        swal("Warning!", "Kindly please select the profile", "warning");
        return false;
    }
    if (country_name == '') {
        swal("Warning!", "Kindly please fill the country", "warning");
        return false;
    }
    //Create User with Email and Password 
    firebase.auth().createUserWithEmailAndPassword(email_id, password).catch(function (error) {
        // Handle Errors here.      
        var errorCode = error.code;
        var errorMessage = error.message;
    });


    if (isPhoneNumberValid(phonenumber)) {
        if (email_id.match(validRegex)) {

            //
            firebase.database().ref('data/users/' + phonenumber).once("value", snapshot => {
                if (snapshot.exists()) {
                    toastr.warning("The number already exists");
                    setTimeout(function() {
                      window.location.reload();
                    }, 2000); // Adjust the delay as needed
                }
                else {
                    //check firstname
                    firebase.database().ref("data/users").orderByChild('firstname').equalTo(firstname).once('value', function (snapshot) {
                        if (!snapshot.exists()) {
                            //check email id
                            firebase.database().ref("data/users").orderByChild('email').equalTo(email_id).once('value', function (snapshot) {
                                if (!snapshot.exists()) {
                                    //
                                    var currentuser = phonenumber;
                                    var files = $('#dropprofilefile')[0].files;
                                 
                                    var reflag = true;
                                    if (files) {
                                        var valflag = validateFile1(files);
                                        if (valflag) {
                                            reflag = handleFileUpload1(files, phonenumber);
                                        } else {
                                            toastr.warning("Select Only Images!");
                                        }
                                    }
                                    if (reflag != false) {
                                       var d = new Date();
                                        var n = d.getTime();
                                        firebase.database().ref('data/users/' + currentuser).update({
                                            // "deviceToken": "",
                                            
                                            "id": phonenumber,
                                           "firstName": firstname,
                                           "lastName":lastname,
                                            "nameToDisplay": firstname,
                                            "online": false,
                                            "osType": "web",
                                            "profileName": phonenumber,
                                            "selected": true,
                                            "status": "DreamsChat",
                                            "timeStamp": n,
                                            // "typing": '',
                                            "email": email_id,
                                            "password": password,
                                            "image": files,
                                            "country_name": country_name
                                            
                                        });
                                        toastr.success("User Added Successfully");
                                        setTimeout(function() {
                                          window.location.reload();
                                        }, 2000); // Adjust the delay as needed
                                    }
                                }
                                else {
                                    toastr.warning("Email ID already exists");
                                    setTimeout(function() {
                                      window.location.reload();
                                    }, 2000); // Adjust the delay as needed
                                }
                            });
                        }
                        else {
                            toastr.warning("Name already exists");
                            setTimeout(function() {
                              window.location.reload();
                            }, 2000); // Adjust the delay as needed
                        }
                    });
                }
            });
            //
        }
        else {
            toastr.warning("Invalid email_id");
        }
    } else {
        toastr.warning("Invalid Mobile No");
    }
}


function addnewsystemsettings() {
    var gcaptcha = $("#gcaptcha").prop("checked") ? "Active" : "Inactive";
    var agorasettings = $('#agorasettings').prop("checked") ? "Active" : "Inactive";
    var fsettings = $('#fsettings').prop("checked") ? "Active" : "Inactive";
        
    var authenticationData = {
        "gcaptcha": gcaptcha,
        "agorasettings": agorasettings,
        "fsettings": fsettings,
       
    };

    // Update data in Firebase and handle errors
    firebase.database().ref('data/addnewsystemsettings/').update(authenticationData)
        .then(function () {
            toastr.success("Settings Saved Successfully");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        })
        .catch(function (error) {
            console.error("Error updating authentication data: ", error);
            toastr.error("An error occurred while updating authentication data");
        });
}

//profile settings
var domain = $('#admin_id').val();
firebase.database().ref('data/profileSettings/' + domain).once("value")

    .then(function (snapshot) {
        var profileData = snapshot.val();
        if (profileData) {
            // Display the 'firstName' value in the 'first_name' textbox
            $("#first_name").val(profileData.firstName);
            $("#last_name").val(profileData.lastName);
            $("#user_name").val(profileData.userName);
            $("#email_id").val(profileData.email);
            $("#address").val(profileData.address);
            $("#phone_number").val(profileData.phoneNumber);
            $("#country").val(profileData.country);
            $("#state").val(profileData.state);
            $("#city").val(profileData.city);
            $("#postal_code").val(profileData.postalcode);
            $("#profile_photo").val(profileData.profile_photo);
            } else {
            console.log("No data found in the database for the specified path.");
        }
    })
    .catch(function (error) {
        console.error("Error fetching data: " + error);
    });

function addprofiles() {
   var first_name = $('#first_name').val();
    // alert(first_name);
    var last_name = $('#last_name').val();
    var user_name = $('#user_name').val();
    var email_id = $('#email_id').val();
    var phone_number = $("#phone_number").val();
    var address = $("#address").val();
    var country = $("#country").val();
    var state = $('#state').val();
    var city = $('#city').val();
    var postal_code = $('#postal_code').val();
    var profile_photo = $('#profile_photo')[0].files[0];

   if (first_name == '') {
        toastr.warning("Kindly please fill the firstname");
        return false;
    }

    if (last_name == '') {
        toastr.warning("Kindly please fill the lastname");
        return false;
    }
    if (user_name == '') {
        toastr.warning("Kindly please fill the username");
        return false;
    }
    if (email_id == '') {
        toastr.warning("Kindly please fill the emailid");
        return false;
    }
    if (phone_number == '') {
        toastr.warning("Kindly please fill the phonenumber");
        return false;
    }
    if (address == '') {
        toastr.warning("Kindly please fill the address");
        return false;
    }
    if (country == '') {
        toastr.warning("Kindly please fill the country");
        return false;
    }
    if (state == '') {
        toastr.warning("Kindly please fill the state");
        return false;
    }
    if (city == '') {
        toastr.warning("Kindly please fill the city");
        return false;
    }
    if (postal_code == '') {
        toastr.warning("Kindly please fill the postalcode");
        return false;
    }

    if (profile_photo == '') {
        toastr.warning("Kindly please fill the profilephoto");
        return false;
    }
    var currentuser = phone_number;
       var reflag = true;
    var files = $('#profile_photo')[0].files;
    var reflag = true;
    if (files) {
        var valflag = validateFile1(files);
        if (valflag) {
            reflag = handleFileUpload(files, phone_number);
            //alert(reflag);
        } else {
            toastr.warning("Select Only Images!");
        }
    }
    var d = new Date();
    var n = d.getTime();
    var role = $('#admin_id').val();
    if (role == 'admin') {
        var id = 1;
    } else {
        var id = 2;
    }

    firebase.database().ref('data/profileSettings/' + role).update({
        "id": id,
        "role": role,
        "firstName": first_name,
        "lastName": last_name,
        "userName": user_name,
        "email": email_id,
        "address": address,
        "phoneNumber": phone_number,
        "country": country,
        "state": state,
        "city": city,
        "postalcode": postal_code,
        "profile_photo": profile_photo,
        "online": true,
        "osType": "web",
        "status": "DreamsChat",
        "timeStamp": n,
    });
    toastr.success("Profile Updated Successfully");
    setTimeout(function() {
      window.location.reload();
    }, 2000); // Adjust the delay as needed

}

$(document).ready(function() {
    // Listen for changes in the file input
    $('#profile_photo').change(function() {
      var input = this;
  
      if (input.files && input.files[0]) {
        var reader = new FileReader();
  
        reader.onload = function(e) {
          // Display the preview image
          $('#imagePreview').css('display', 'block');
          $('#previewImage').attr('src', e.target.result);
        };
  
        // Read the selected file as a data URL
        reader.readAsDataURL(input.files[0]);
      }
    });
  });



function addnewauthentication() {
    var registration = $("#registration").prop("checked") ? "Active" : "Inactive";
    var verification = $('#verification').prop("checked") ? "Active" : "Inactive";
    var verification_expired = $('#verification_expired').val();
    var referral_system = $('#referral_system').prop("checked") ? "Active" : "Inactive";
    var login_type = $('#login_type').val();
    var password = $('#password').prop("checked") ? "Active" : "Inactive";
    var otp_system = $('#otp_system').prop("checked") ? "Active" : "Inactive";
    var otp_type = $('#otp_type').val();

    // Ensure that values remain "Active" or "Inactive"
    var enforceActiveInactive = function(value) {
        return (value === "Active" || value === "Inactive") ? value : "Inactive"; 
    };

    // Validate that verification_expired, login_type, and otp_type have values
    if (!verification_expired || !login_type || !otp_type) {
        console.error("One or more required fields are empty or undefined.");
        return;
    }

    var authenticationData = {
        "registration": enforceActiveInactive(registration),
        "verification": enforceActiveInactive(verification),
        "verification_expired": verification_expired,
        "referral_system": enforceActiveInactive(referral_system),
        "login_type": login_type,
        "otp_system": enforceActiveInactive(otp_system),
        "otp_type": otp_type,
        "password": enforceActiveInactive(password)
    };

    // Update data in Firebase and handle errors
    var databaseRef = firebase.database().ref('data/authenticationSettings/');
    
    databaseRef.update(authenticationData)
        .then(function () {
            console.log("Authentication data updated successfully.");
            toastr.success("Authentication Added Successfully");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        })
        .catch(function (error) {
            console.error("Error updating authentication data: ", error);
            toastr.error("An error occurred while updating authentication data");
        });
}

function fetchAuthenticationSettings() {
    // Reference to the Firebase Realtime Database
    var databaseRef = firebase.database().ref('data/authenticationSettings/');

    // Fetch data from the database
    databaseRef.once('value')
        .then(function(snapshot) {
            var authenticationData = snapshot.val();
         
            $("#registration").prop("checked", authenticationData.registration === "Active");
            $("#verification").prop("checked", authenticationData.verification === "Active");
            $("#verification_expired").val(authenticationData.verification_expired);
            $("#referral_system").prop("checked", authenticationData.referral_system === "Active");
            $("#login_type").val(authenticationData.login_type);

            $("#password").prop("checked", authenticationData.password === "Active");
            $("#otp_system").prop("checked", authenticationData.otp_system === "Active");
            $("#otp_type").val(authenticationData.otp_type);
        })
        .catch(function(error) {
            console.error("Error fetching authentication data: ", error);
        });
}

$(document).ready(function() {
    fetchAuthenticationSettings();
});

 function toggleMode(mode) {
        if (mode === 'dark') {
            $('#stylesheet').attr('href', 'dark.css');
            $('#toggle-light-mode').removeClass('active');
            $('#toggle-dark-mode').addClass('active');
        } else {
            $('#stylesheet').attr('href', 'light.css');
            $('#toggle-light-mode').addClass('active');
            $('#toggle-dark-mode').removeClass('active');
        }
    }

    // Check if mode preference is stored and set it on page load
    $(document).ready(function() {
        const savedMode = localStorage.getItem('mode');
        if (savedMode === 'dark') {
            toggleMode('dark');
        }
    });

    // Toggle mode when light or dark mode buttons are clicked
    $('#toggle-light-mode').on('click', function() {
        toggleMode('light');
        localStorage.setItem('mode', 'light');
    });

    $('#toggle-dark-mode').on('click', function() {
        toggleMode('dark');
        localStorage.setItem('mode', 'dark');
    });

function edit_users(userkey) {
      var db = firebase.database();
      var ref = db.ref('data/users').orderByChild('id').equalTo(userkey);
      ref.once('value', snapshot => {
        if (snapshot.exists()) {
          var name = snapshot.val();
          name = Object.values(name);
          var id = name[0]['id'];
          var firstName = name[0]['firstName'];
          var lastName = name[0]['lastName'];
          var cname = name[0]['country_name'];
          var pemail = name[0]['email'];
          var phone = name[0]['id'];
          var image = name[0]['image'];
          $("#hid").val(id);
          $("#firstName").val(firstName);
          $("#lastName").val(lastName);
          $("#e_mail").val(pemail);
          $("#edit_country_name").val(cname);
          $("#edit_phone_no").val(phone);
          $("#himg").val(image);
          $("#edit_image").attr('src', image);
          if (image != '') {
            $("#view_pimg").css('display', 'block');
            $("#view_pimg").attr('href', image);
          }
          else {
            $("#view_pimg").css('display', 'none');
          }
    
        } else {
          //console.log('There is no user who has email like '+ email)
        }
      });
    }

    $(document).ready(function() {
        // Get references to the elements
        var $fileInput = $('#edit_profile_img');
        var $imagePreview = $('#edit_image');

        // Listen for changes in the file input
        $fileInput.on('change', function(e) {
            var file = e.target.files[0];

            if (file) {
                // Create a FileReader object
                var reader = new FileReader();

                // Set up a function to run when the image is loaded
                reader.onload = function(e) {
                    // Set the source of the image preview to the selected file
                    $imagePreview.attr('src', e.target.result);
                };

                // Read the selected file as a data URL (base64 encoded)
                reader.readAsDataURL(file);
            } else {
                // If no file is selected or an error occurs, set a default image
                $imagePreview.attr('src', 'assets/img/avatar/avatar-2.jpg');
            }
        });
    });

    function updateuser() {
          var hid = $("#hid").val();
          var himg = $("#himg").val();
          //
          var firstName = $('#firstName').val();
          var lastName = $('#lastName').val();
          var country_name = $('#edit_country_name').val();
          var phone_no = $('#edit_phone_no').val();
          var e_mail = $('#e_mail').val();
          var currentuser = hid;
          alert(currentuser);
          var files = $('#edit_profile_img')[0].files;
          var reflag = true;
          if(files) {
            var valflag = validateFile1(files);
            //alert(valflag);
            if (valflag) {
              reflag = handleFileUpload1(files, currentuser);
            } else {
                toastr.warning("Select Only Images!");
            }
          }
          if (reflag != false) {
            var d = new Date();
            var n = d.getTime();
            var name = firstName + lastName;
            firebase.database().ref('data/users/' + currentuser).update({
              "name": name,
              "firstName": firstName,
              "lastName": lastName,
              "nameToDisplay": name,
              "country_name": country_name,
              "id": phone_no,
              "email": e_mail
              /*"timeStamp": n*/
            });
            toastr.success("User Details Updated Successfully");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
            $('#modal-edituser').modal('hide');
          }
          //
        }

   function validateFile1(files) {
    var allowedExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
   // alert(allowedExtension);
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var fileExtension = file.name.split('.').pop().toLowerCase();
        if (jQuery.inArray(fileExtension, allowedExtension) === -1) {
            return false;
        }
    }
    return true;
}
function handleFileUpload1(files, phonenumber) {
    for (var i = 0; i < files.length; i++) {
        var fd = new FormData();
        fd.append('file', files[i]);
        fireBaseImageUpload1({
            'file': files[i],
            'path': '/Dreamchat',
            'phonenumber': phonenumber
        }, function (data) {
            if (!data.error) {
                if (data.progress) {
                    // progress update to view here
                   
                }
                if (data.downloadURL) {
                    // update done
                   
                    return data.downloadURL;
                }
            } else {
            }
        });
    }
};

function fireBaseImageUpload1(parameters, callBackData) {
    // expected parameters to start storage upload
    var file = parameters.file;
    var path = parameters.path;
    var phonenumber = parameters.phonenumber;
    var name;
    //just some error check
    if (!file) {
        callBackData({
            error: 'file required to interact with Firebase storage'
        });
    }
    if (!path) {
        callBackData({
            error: 'Node name required to interact with Firebase storage'
        });
    }
    var metaData = {
        'contentType': file.type
    };
    var arr = file.name.split('.');
    var fileSize = (file.size); // get clean file size (function below)
    var fileType = file.type;
    var n = (+new Date()) + '-' + file.name;
    // generate random string to identify each upload instance
    name = generateRandomString1(12); //(location function below)        
    var checktypeflag = getFileType1(fileType);
    var subpath = '';
    if (checktypeflag == 1) {
        subpath = '/Video';
    } else if (checktypeflag == 2) {
        subpath = '/Image';
    } else if (checktypeflag == 3) {
        subpath = '/Audio';
    } else if (checktypeflag == 5) {
        subpath = '/Document';
    } else if (checktypeflag == 8) {
        subpath = '/Recording';
    }
    var fullPath = path + subpath + '/' + n;
    var uploadFile = storageRef.child(fullPath).put(file, metaData);
    // first instance identifier
    callBackData({
        id: name,
        fileSize: fileSize,
        fileType: fileType,
        fileName: n
    });
    uploadFile.on('state_changed', function (snapshot) {
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        progress = Math.floor(progress);
        callBackData({
            progress: progress,
            element: name,
            fileSize: fileSize,
            fileType: fileType,
            fileName: n
        });
    }, function (error) {
        callBackData({
            error: error
        });
    }, function () {
        var downloadURL = uploadFile.snapshot.downloadURL;
        var checktypeflag = getFileType1(fileType);
        if (checktypeflag != 'other') {
            updateprofileimage(checktypeflag, downloadURL, n, fileSize, phonenumber);
        } else {
            toastr.warning("Select Only Images!");
        }
        callBackData({
            downloadURL: downloadURL,
            element: name,
            fileSize: fileSize,
            fileType: fileType,
            fileName: n
        });
    });
}

function handleFileUpload(files, phonenumber) {
    for (var i = 0; i < files.length; i++) {
        var fd = new FormData();
        fd.append('file', files[i]);
        fireBaseImageUpload({
            'file': files[i],
            'path': '/Dreamchat',
            'phonenumber': phonenumber
        }, function (data) {
            if (!data.error) {
                if (data.progress) {
                    // progress update to view here
                }
                if (data.downloadURL) {
                    // update done
                    return data.downloadURL;
                }
            } else {
            }
        });
    }
};

function fireBaseImageUpload(parameters, callBackData) {
    // expected parameters to start storage upload
    var file = parameters.file;
    var path = parameters.path;
    var phonenumber = parameters.phonenumber;
    var name;
    //just some error check
    if (!file) {
        callBackData({
            error: 'file required to interact with Firebase storage'
        });
    }
    if (!path) {
        callBackData({
            error: 'Node name required to interact with Firebase storage'
        });
    }
    var metaData = {
        'contentType': file.type
    };
    var arr = file.name.split('.');
    var fileSize = (file.size); // get clean file size (function below)
    var fileType = file.type;
    var n = (+new Date()) + '-' + file.name;
    // generate random string to identify each upload instance
    name = generateRandomString1(12); //(location function below)        
    var checktypeflag = getFileType1(fileType);
    var subpath = '';
    if (checktypeflag == 1) {
        subpath = '/Video';
    } else if (checktypeflag == 2) {
        subpath = '/Image';
    } else if (checktypeflag == 3) {
        subpath = '/Audio';
    } else if (checktypeflag == 5) {
        subpath = '/Document';
    } else if (checktypeflag == 8) {
        subpath = '/Recording';
    }
    var fullPath = path + subpath + '/' + n;
    var uploadFile = storageRef.child(fullPath).put(file, metaData);
    // first instance identifier
    callBackData({
        id: name,
        fileSize: fileSize,
        fileType: fileType,
        fileName: n
    });
    uploadFile.on('state_changed', function (snapshot) {
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        progress = Math.floor(progress);
        callBackData({
            progress: progress,
            element: name,
            fileSize: fileSize,
            fileType: fileType,
            fileName: n
        });
    }, function (error) {
        callBackData({
            error: error
        });
    }, function () {
        var downloadURL = uploadFile.snapshot.downloadURL;
        var checktypeflag = getFileType1(fileType);
        if (checktypeflag != 'other') {
            updateprofileimage1(checktypeflag, downloadURL, n, fileSize, phonenumber);
        } else {
            toastr.warning("Select Only Images!");
        }
        callBackData({
            downloadURL: downloadURL,
            element: name,
            fileSize: fileSize,
            fileType: fileType,
            fileName: n
        });
    });
}

function generateRandomString1(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function updateprofileimage(checktypeflag, downloadURL, name, fileSize, phonenumber) {
    var currentuser = phonenumber;
    // console.log(currentuser);
    firebase.database().ref('data/users/' + currentuser).update({
        image: downloadURL
    });
    $('#currentuser_display_image').html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + downloadURL + '" alt="">');
}

function updateprofileimage1(checktypeflag, downloadURL, name, fileSize, phonenumber) {
    var currentuser = phonenumber;
    var admin_id = $("#admin_id").val();
    firebase.database().ref('data/profileSettings/' + admin_id).update({
        image: downloadURL
    });
    /*$('#currentuser_display_image').html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + downloadURL + '" alt="">');*/
}

function getFileType1(fileType) {
    if (fileType.match('image.*'))
        return 2;
    return 'other';
}

function uploadcsv() {
    var csv_file = $('#csv_file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('csv_file', csv_file);
    $.ajax({
        url: baseUrl + 'admin/bulkupload', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            var json = $.parseJSON(response);
            if (json.error == false) {
                //call firebase
                var done = 0;
                $.each(json.msg, function (i, item) {

                    //check already exists
                    var phonenumber = "+" + item.country_code + item.mobile_no;
                    var username = item.username;
                    var password = item.password;
                    var email_id = item.email_id;
                    firebase.database().ref('data/users/' + phonenumber).once("value", snapshot => {
                        if (snapshot.exists()) {
                            toastr.warning("The number already exists");
                            setTimeout(function() {
                              window.location.reload();
                            }, 2000); // Adjust the delay as needed
                        }
                        else {
                            //check username
                            firebase.database().ref("data/users").orderByChild('username').equalTo(username).once('value', function (snapshot) {
                                if (!snapshot.exists()) {
                                    //check mail
                                    firebase.database().ref("data/users").orderByChild('email').equalTo(email_id).once('value', function (snapshot) {
                                        if (!snapshot.exists()) {
                                            //
                                            var currentuser = phonenumber;
                                            console.log(currentuser);
                                            var d = new Date();
                                            var n = d.getTime();
                                            firebase.database().ref('data/users/' + currentuser).update({
                                                "deviceToken": "",
                                                "id": phonenumber,
                                                "image": "",
                                                "name": username,
                                                "nameToDisplay": username,
                                                "online": false,
                                                "osType": "web",
                                                "profileName": phonenumber,
                                                "selected": true,
                                                "status": "DreamsChat",
                                                "timeStamp": n,
                                                "typing": '',
                                                "email": email_id,
                                                "username": username,
                                                "password": password
                                            });
                                            //
                                        }
                                        else {
                                            toastr.warning("Email ID already exists");
                                            setTimeout(function() {
                                              window.location.reload();
                                            }, 2000); // Adjust the delay as needed
                                        }
                                    });
                                }
                                else {
                                    toastr.warning("Username already exists");
                                    setTimeout(function() {
                                      window.location.reload();
                                    }, 2000); // Adjust the delay as needed
                                }
                            });

                        }
                    });
                });
                toastr.success("Number Added Successfully");
                setTimeout(function() {
                  window.location.reload();
                }, 2000); // Adjust the delay as needed
            }
            else {
                $("#err_file").html(json.msg);
            }
        }
    });
}

function togglePassword() {
    var passwordField = document.getElementById('password');
    var toggleIcon = document.querySelector('.toggle-password');

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
